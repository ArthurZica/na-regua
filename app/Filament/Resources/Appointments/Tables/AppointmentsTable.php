<?php

namespace App\Filament\Resources\Appointments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class AppointmentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('service.name')
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('user.name')
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('customer.name')
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('empresa.name')
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('scheduled_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('createdBy.name')
                    ->numeric()
                    ->translateLabel()
                    ->sortable(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
