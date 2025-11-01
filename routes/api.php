<?php

use App\Http\Controllers\WhatsappController;

Route::post('/wpp/webhook', [WhatsappController::class, 'webhook']);
