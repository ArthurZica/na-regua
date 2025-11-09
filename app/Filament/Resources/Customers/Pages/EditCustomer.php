<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use App\Models\Instance;
use App\Services\WhatsappService;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Facades\Filament;
use Filament\Resources\Pages\EditRecord;

class EditCustomer extends EditRecord
{
    protected static string $resource = CustomerResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $whatsappService = new WhatsappService();
        $instance = Instance::where('empresa_id',Filament::getTenant()->id)->where('connected',1)->first();
        $wppId = $whatsappService->getWhatsappId($data['phone'],$instance->instance_id);

        if(!$wppId->error && isset($wppId->data)){
            $data['id_wpp'] = $wppId->data;
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
