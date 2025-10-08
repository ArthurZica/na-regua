<?php

namespace App\Filament\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->translateLabel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->translateLabel()
                    ->email(),
                PhoneInput::make('phone')
                    ->translateLabel()
                    ->required(),
            ]);
    }
}
