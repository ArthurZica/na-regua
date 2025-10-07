<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Filament\Tables\Components\DurationDisplay;
use App\Models\Service;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ServiceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                ->translateLabel(),
                TextEntry::make('price')
                    ->translateLabel()
                    ->money('BRL', divideBy: 100),
                TextEntry::make('duration_minutes')
                    ->formatStateUsing(fn($state) => DurationDisplay::format($state))
                    ->label('Duration')
                    ->translateLabel(),
            ]);
    }
}
