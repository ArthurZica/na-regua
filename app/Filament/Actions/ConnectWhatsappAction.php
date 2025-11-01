<?php

namespace App\Filament\Actions;

use App\Services\WhatsappService;
use Filament\Actions\Action;

class ConnectWhatsappAction
{
    public static function make(): Action
    {
        return Action::make('conectar')
            ->label('Conectar')
            ->icon('heroicon-o-qr-code')
            ->modalHeading('Conectar ao WhatsApp')
            ->modalDescription('Escaneie o QR Code abaixo para conectar sua conta.')
            ->modalContent(function ($record) {
                $result = (new WhatsappService())->connectInstance($record->id);

                if (!empty($result->error)) {
                    return view('filament.instances.error-modal', [
                        'message' => $result->message ?? 'Erro desconhecido ao conectar.',
                    ]);
                }

                return view('filament.instances.qr-modal', [
                    'qr' => $result->data['base64'] ?? null,
                ]);
            })
            ->modalWidth('sm')
            ->requiresConfirmation(false)
            ->modalSubmitAction(false);
    }
}
