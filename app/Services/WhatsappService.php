<?php

namespace App\Services;


use App\Models\Instance;
use Illuminate\Support\Facades\Http;

class WhatsappService
{
    private string $wppApiUrl;
    private string $token;
    public function __construct()
    {
        $this->wppApiUrl = env('EVOLUTION_URL','http://evolution-api:8080');
        $this->token = env('EVOLUTION_TOKEN',null);
    }

    public function createInstance($name) : object{
        try{
            $webhookConfig = [
                'url' => 'http://laravel.test/api/wpp/webhook',
                'events' => [
                    'QRCODE_UPDATED','MESSAGES_UPSERT','MESSAGES_UPDATE','NEW_JWT_TOKEN'
                ]
            ];
            $data = [
                'instanceName' => $name,
                'integration' => 'WHATSAPP-BAILEYS',
                'webhook' => $webhookConfig,
                'qrcode' => true
            ];
            $response = Http::withHeaders(['apiKey' => $this->token])
            ->post($this->wppApiUrl."/instance/create",$data);

            if($response->failed()){
                return (object) [
                    'error' => true,
                    'message' => 'Ocorreu um erro ao criar sua instância!',
                    'data' => $response->json('response')['message'][0]
                ];
            }
            return (object) [
                'error' => false,
                'message' => 'Instância criada com sucesso!',
                'data' => $response->json()
            ];
        }catch(\Exception $error){
            return (object) [
                'error' => true,
                'message' => $error->getMessage()
            ];
        }
    }

    public function connectInstance(int $id){
        $instance = Instance::find($id);
        if(!isset($instance)){
            return (object) [
                'error' => true,
                'message' => 'A instância não foi encontrada!'
            ];
        }

        if(!isset($instance->instance_id)){
            return (object) [
                'error' => true,
                'message' => 'A instância não possui id'
            ];
        }

        $response = Http::withHeaders(['apiKey' => $this->token])
            ->get($this->wppApiUrl."/instance/connect/$instance->instance_id");

        if($response->failed()){
            return (object) [
                'error' => true,
                'message' => 'Ocorreu um erro ao conectar a sua instancia!',
                'data' => $response->json('response')['message'][0]
            ];
        }
        return (object) [
            'error' => false,
            'message' => 'Qr code buscado com sucesso!',
            'data' => $response->json()
        ];
    }
}
