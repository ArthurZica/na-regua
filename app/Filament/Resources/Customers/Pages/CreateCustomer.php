<?php

namespace App\Filament\Resources\Customers\Pages;

use App\Filament\Resources\Customers\CustomerResource;
use App\Models\Instance;
use App\Services\WhatsappService;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['empresa_id'] = Filament::getTenant()->id;

        $whatsappService = new WhatsappService();
        $instance = Instance::where('empresa_id',Filament::getTenant()->id)->where('connected',1)->first();
        $wppId = $whatsappService->getWhatsappId($data['phone'],$instance->instance_id);

        if(!$wppId->error && isset($wppId->data)){
            $data['id_wpp'] = $wppId->data;
        }

        return $data;
    }
}
