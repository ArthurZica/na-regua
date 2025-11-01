<?php

namespace App\Filament\Resources\Instances\Pages;

use App\Filament\Resources\Instances\InstanceResource;
use App\Models\Instance;
use App\Services\WhatsappService;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Support\Exceptions\Halt;

class CreateInstance extends CreateRecord
{
    protected static string $resource = InstanceResource::class;

    /**
     * @throws Halt
     */
    protected function beforeCreate(): void
    {
        $empresa_id = Filament::getTenant()->id;
        $exists = Instance::where('name', $this->data['name'])->where('empresa_id','=',$empresa_id)->exists();

        if ($exists) {
            \Filament\Notifications\Notification::make()
                ->danger()
                ->title('Nome duplicado')
                ->body('Já existe uma instância com esse nome.')
                ->send();

            $this->halt(true); // impede o processo de criação
            return;
        }
    }
    protected function afterCreate(): void
    {
        $record = $this->record;

        $service = new WhatsappService();
        $result = $service->createInstance($record->empresa->id .'_'.$record->name);

        if (!empty($result->error)) {
            Notification::make()
                ->danger()
                ->title('Erro ao conectar com o WhatsApp')
                ->body($result->message ?? 'Erro desconhecido ao criar instância')
                ->send();

            $record->update([
                'connected' => false,
                'error_message' => $result->message ?? 'Erro desconhecido',
            ]);
        } else {
            $record->update([
                'connected' => false,
                'instance_id' => $result->data['instance']['instanceName']
            ]);
        }
    }
}
