<?php

namespace App\Filament\Resources\Appointments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AppointmentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('service_id')
                    ->relationship('service', 'name')
                    ->translateLabel()
                    ->required(),
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->translateLabel()
                    ->required(),
                Select::make('customer_id')
                    ->relationship('customer', 'name')
                    ->translateLabel()
                    ->required(),
                DateTimePicker::make('scheduled_at')
                    ->translateLabel()
                    ->required(),
            ]);
    }
}
