<?php

namespace App\Filament\Resources\Instances\Pages;

use App\Filament\Actions\ConnectWhatsappAction;
use App\Filament\Actions\VerifyConnectionAction;
use App\Filament\Resources\Instances\InstanceResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewInstance extends ViewRecord
{
    protected static string $resource = InstanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            VerifyConnectionAction::make(),
            ConnectWhatsappAction::make()
                ->visible(fn ($record) => !$record->connected),
        ];
    }
}
