<?php

namespace App\Services;


use App\Models\Instance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        $contentType = $request->header('Content-Type', 'application/json');
        $response = Http::withHeaders([
            'Content-Type' => $contentType,
        ])->withBody($body, $contentType)
            ->post($this->workFlowUrl);

        return;
    }


}
