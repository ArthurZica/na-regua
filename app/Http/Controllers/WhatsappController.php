<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WhatsappController extends Controller
{
    public function webhook(Request $request)
    {
        Log::info('Webhook recebido:', $request->all());
        return response()->json(['status' => 'ok']);
    }
}
