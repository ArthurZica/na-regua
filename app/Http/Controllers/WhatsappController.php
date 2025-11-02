<?php

namespace App\Http\Controllers;

use App\Services\WhatsappEventsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WhatsappController extends Controller
{
    public function webhook(Request $request)
    {
        Log::info('Webhook recebido:', $request->all());
        $service = new WhatsappEventsService();
        switch($request->input("event")){
            case 'logout.instance':
                $service->logoutInstance($request->input("instance"));
            break;
        }
        return response()->json(['status' => 'ok']);
    }
}
