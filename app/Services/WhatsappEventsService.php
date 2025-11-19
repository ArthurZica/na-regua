<?php

namespace App\Services;


use App\Models\Customer;
use App\Models\Empresa;
use App\Models\Instance;
use App\Models\Message;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappEventsService
{

    private string $workFlowUrl;
    public function __construct()
    {
        $this->workFlowUrl = env('N8N_WEBHOOK_URL');
    }

    public function logoutInstance(string $instance_id){
        Instance::where('instance_id',$instance_id)->update(['connected' => false]);
        return response()->json(['status' => 'instância desconectada']);
    }

    public function sendWebhookToWorkFlow(Request $request): void
    {
        $newBody = $this->modifyBodyAddingData($request->json()->all());
        $this->createInboundingMessage((object) $newBody);

        $contentType = $request->header('Content-Type', 'application/json');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->withBody(json_encode($newBody), 'application/json')
            ->timeout(120)
            ->post($this->workFlowUrl);

        return;
    }

    private function createInboundingMessage(object $body){

        $content = $body->data['message']['conversation'] ?? null;
        $type = $body->data['messageType'];
        if($type !== 'conversation' && $type !== 'audioMessage'){
            $content = $body->data['message'][$type]['caption'];
        }

        Message::create([
            "msg_id_wpp" => $body->data['key']['id'],
            "direction" => "inbound",
            "message" => $content,
            "instance_id" => $body->instance_data->id,
            "phone_id_wpp" => $body->data['key']['remoteJid'],
            "status" => 0,
            "type" => $body->data['messageType'],
            "media_url" => null,
            "empresa_id" => $body->empresa->id,
        ]);
    }
    private function modifyBodyAddingData(array $body){
        $instance = Instance::where('instance_id',$body['instance'])->first();
        $empresa = Empresa::find($instance->empresa_id);
        $services = Service::where('empresa_id',$empresa->id)->get();
        $jid = $body['data']['key']['remoteJid'];
        $phone = explode('@',$jid)[0];
        $customer = Customer::where('id_wpp',$jid)->where('empresa_id',$empresa->id)->first();

        if(!isset($customer)){
           $customer = Customer::byPhone($phone)->where('empresa_id',$empresa->id)->first();
           if($customer){
               $customer->id_wpp = $jid;
               $customer->save();
           }
        }

        $body['empresa'] = $empresa;
        $body['instance_data'] = $instance;
        $body['customer'] = $customer;
        $body['services'] = $services;
        return $body;
    }


}
