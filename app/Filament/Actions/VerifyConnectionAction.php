<?php

namespace App\Filament\Actions;

use App\Services\WhatsappService;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;

class VerifyConnectionAction
{
    public static function make(): Action
    {
        return Action::make('verifyConnection')
            ->label('Verificar Conexão')
            ->icon('heroicon-o-check-circle')
            ->action(function ($record) {
                $result = (new \App\Services\WhatsappService())->verifyConnection($record->id);

                if($result->error){
                    Notification::make()
                        ->danger()
                        ->title($result->message)
                        ->send();
                    return;
                }
                if(!$result->connected){
                    Notification::make()
                        ->danger()
                        ->title($result->message)
                        ->send();
                    return;
                }

                Notification::make()
                    ->success()
                    ->title($result->message)
                    ->send();
                return;
            });
    }
}
