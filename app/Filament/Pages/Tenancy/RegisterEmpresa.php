<?php
namespace App\Filament\Pages\Tenancy;

use App\Models\Empresa;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;
use Filament\Schemas\Schema;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class RegisterEmpresa extends RegisterTenant
{
public static function getLabel(): string
{
return 'Cadastrar Barbearia';
}

public function form(Schema $schema): Schema
{
return $schema
->components([
TextInput::make('name')->required()->translateLabel(),
TextInput::make('cnpj')->label('CNPJ'),
TextInput::make('endereco')->label('Endereço'),
PhoneInput::make('telefone'),
]);
}

protected function handleRegistration(array $data): Empresa
    {
//        dd($data);
        $team = Empresa::create($data);

        $team->users()->attach(auth()->user());
        return $team;
    }
}
