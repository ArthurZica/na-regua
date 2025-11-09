<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendMessageRequest;
use App\Services\WhatsappEventsService;
use App\Services\WhatsappService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WhatsappController extends Controller
{
    public function webhook(Request $request)
    {
        Log::info('Webhook recebido:', $request->all());
        dump($request->all());
        $service = new WhatsappEventsService();
        switch($request->input("event")){
            case 'logout.instance':
                $service->logoutInstance($request->input("instance"));
            break;
            default:
                $service->sendWebhookToWorkFlow($request);
            break;
        }
        return response()->json(['status' => 'ok']);
    }

    public function sendMessage(SendMessageRequest $request): \Illuminate\Http\JsonResponse
    {
        $service = new WhatsappService();
        $messageSent = $service->sendMessage($request->phone, $request->text, $request->instance);

        if($messageSent->error){
            return response()->json(['error' => $messageSent->message],500);
        }
        return response()->json($messageSent);
    }

}
