<?php

use App\Http\Controllers\AppointmentApiController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WhatsappController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[LoginController::class,'login']);
Route::post('/wpp/webhook', [WhatsappController::class, 'webhook']);
Route::post('/wpp/sendMessage', [WhatsappController::class, 'sendMessage']);
Route::post('/customer', [CustomerController::class, 'createByInstance']);
Route::post('/appointments/disponiveis', [AppointmentController::class, 'getAvailableSlots']);


