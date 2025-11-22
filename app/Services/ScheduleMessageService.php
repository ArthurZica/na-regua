<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Instance;
use App\Models\ScheduledMessage;

class ScheduleMessageService
{
    public function __construct()
    {
    }

    public function createAppointmentConfirmationMessage(Appointment $appointment)
    {

        ScheduledMessage::create([
            'type' => 'text',
            'category' => 'appointment_confirmation',
            'text' => "Olá {$appointment->customer->name}, você tem um horário agendado para o dia {$appointment->scheduled_at->format('d/m/Y')} às {$appointment->scheduled_at->format('H:i')}. Por favor, confirme sua presença.",
            'customer_id' => $appointment->customer_id,
            'scheduled_at' => $appointment->scheduled_at->subMinutes(30),
            'empresa_id' => $appointment->empresa_id,
        ]);
    }

    public function sendScheduledMessages()
    {
        $now = now();

        $messages = ScheduledMessage::where('scheduled_at', '<=', $now)
            ->get();

        $whatsappService = new WhatsappService();

        foreach ($messages as $message) {
            $instanceId = Instance::where('empresa_id', $message->empresa_id)->where('connected',true)->first()->instance_id;
            if(!$instanceId){
                continue;
            }
            $whatsappService->sendMessage($message->customer->id_wpp,$message->text,$instanceId);
            $message->delete();
        }
    }
}
