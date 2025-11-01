<?php

namespace App\Filament\Resources\Instances\Tables;

use App\Filament\Actions\ConnectWhatsappAction;
use App\Services\WhatsappService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class InstancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->translateLabel()
                    ->searchable(),
                IconColumn::make('connected')
                    ->translateLabel()
                    ->boolean(),
                TextColumn::make('created_at')
                    ->translateLabel()
                    ->dateTime(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
//                Action::make('conectar')
//                    ->label('Conectar')
//                    ->icon('heroicon-o-qr-code')
//                    ->modalHeading('Conectar ao WhatsApp')
//                    ->modalDescription('Escaneie o QR Code abaixo para conectar sua conta.')
//                    ->modalContent(function ($record) {
//                        $result = (new WhatsappService())->connectInstance($record->id);
//                        if (!empty($result->error)) {
//                            return view('filament.instances.error-modal', [
//                                'message' => $result->data,
//                            ]);
//                        }
//
//                        return view('filament.instances.qr-modal', [
//                            'qr' => $result->data['base64'],
//                        ]);
//                    })
//                    ->modalWidth('sm')
//                    ->requiresConfirmation(false)
//                    ->modalSubmitAction(false),
                ConnectWhatsappAction::make(),
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }

}
