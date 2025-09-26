<?php
namespace App\Filament\Pages\Tenancy;

use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\EditTenantProfile;
use Filament\Schemas\Schema;

class EditEmpresaProfile extends EditTenantProfile
{
    public static function getLabel(): string
    {
        return 'Perfil da barbearia';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->translateLabel(),
                TextInput::make('cnpj')->label('CNPJ'),
                TextInput::make('endereco')->label('Endereço'),
                TextInput::make('telefone')->tel()->mask('(99) 99999-9999'),
            ]);
    }
}
