<?php

namespace App\Services;


use App\Models\Customer;
use App\Models\Empresa;
use App\Models\Instance;
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
        $body = $request->getContent();
        $newBody = $this->modifyBodyAddingData($request->json()->all());
        $contentType = $request->header('Content-Type', 'application/json');
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->withBody(json_encode($newBody), 'application/json')
            ->post($this->workFlowUrl);

        return;
    }

    private function modifyBodyAddingData(array $body){
        Log::info('aaaa',[$body['instance']]);
        $instance = Instance::where('instance_id',$body['instance'])->first();
        $empresa = Empresa::find($instance->empresa_id);
        $phone =  explode('@',$body['data']['key']['remoteJid'])[0];
        $customer = Customer::where('id_wpp',$phone)->where('empresa_id',$empresa->id)->first();

        $body['empresa'] = $empresa;
        $body['customer'] = $customer;
        return $body;
    }


}
