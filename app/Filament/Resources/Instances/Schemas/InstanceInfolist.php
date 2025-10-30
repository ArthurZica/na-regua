<?php

namespace App\Filament\Resources\Instances\Schemas;

use App\Models\Instance;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InstanceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                    ->translateLabel(),
                IconEntry::make('connected')
                    ->translateLabel()
                    ->boolean(),
                TextEntry::make('empresa.name')
                    ->label('Empresa'),
                TextEntry::make('created_at')
                    ->translateLabel()
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->translateLabel()
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->translateLabel()
                    ->dateTime()
                    ->visible(fn (Instance $record): bool => $record->trashed()),
            ]);
    }
}
