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
                    'QRCODE_UPDATED','MESSAGES_UPSERT','MESSAGES_UPDATE','NEW_JWT_TOKEN','LOGOUT_INSTANCE'
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

    public function verifyConnection(int $id){
        $instance = Instance::find($id);
        $response = Http::withHeaders(['apiKey' => $this->token])
            ->get($this->wppApiUrl."/instance/connectionState/$instance->instance_id");

        if($response->failed()){
            return (object) [
                'error' => true,
                'message' => 'Ocorreu um erro ao conectar a sua instancia! Tente novamente!',
                'data' => $response->json('response')['message'][0]
            ];
        }

        $connected = $response->json('instance')['state'] === 'open';
        $instance->connected = $connected;
        $instance->save();

        return (object) [
            'connected' => $connected,
            'error' => false,
            'message' => $connected ? 'O dispositivo está conectado!' : 'O dispositivo está desconectado!'
        ];
    }

    public function sendMessage(string $phone, string $text,string $instanceId): object
    {
        $data = [
            "number" => $phone,
            "text" => $text,
        ];

        $response = Http::withHeaders(['apiKey' => $this->token])
            ->post($this->wppApiUrl."/message/sendText/$instanceId",$data);

        if($response->failed()){
            return (object) [
                'error' => true,
                'message' => 'Ocorreu um erro ao conectar a sua instancia! Tente novamente!',
                'data' => $response->json('response')['message'][0]
            ];
        }

        //salva na tabela de mensagens
        return (object) [
            'error' => false,
            'message' => 'Mensagem enviada com sucesso!',
            'data' => $response->json()
        ];
    }
}
