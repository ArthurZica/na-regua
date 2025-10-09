<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->translateLabel()
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->prefix('R$')
                    ->currencyMask(thousandSeparator: '.',decimalSeparator: ',',precision: 2)
                    ->dehydrateStateUsing(fn ($state) => (int) round($state * 100))
                    ->formatStateUsing(fn ($state) => $state / 100)
                    ->translateLabel(),
                Grid::make()
                    ->schema([
                        TextInput::make('duration_hours')
                            ->label('Horas')
                            ->numeric()
                            ->default(0),
                        TextInput::make('duration_mins')
                            ->label('Minutos')
                            ->numeric()
                            ->default(0),
                    ])
                    ->afterStateHydrated(function ($state, callable $set) {
                        $total = $state['duration_minutes'] ?? 0;
                        $set('duration_hours', floor($total / 60));
                        $set('duration_mins', $total % 60);
                    })
                    ->dehydrated(false), // Evita salvar diretamente esses campos
                Hidden::make('duration_minutes')
                    ->label('Duração total (oculto)')
                    ->dehydrateStateUsing(function ($state, callable $get) {
                        return ((int) $get('duration_hours') * 60) + (int) $get('duration_mins');
                    })
                    ->afterStateHydrated(function (callable $get, callable $set) {
                        // Quando for editar um registro existente, extrai horas e minutos
                        $total = $get('duration_minutes') ?? 0;
                        $set('duration_hours', floor($total / 60));
                        $set('duration_mins', $total % 60);
                    }),
            ]);
    }
}
