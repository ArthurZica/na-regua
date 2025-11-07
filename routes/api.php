<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\WhatsappController;

Route::post('/wpp/webhook', [WhatsappController::class, 'webhook']);
Route::post('/wpp/sendMessage', [WhatsappController::class, 'sendMessage']);
Route::post('/customer', [CustomerController::class, 'createByInstance']);
