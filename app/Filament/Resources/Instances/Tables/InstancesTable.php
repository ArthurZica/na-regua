<?php

namespace App\Filament\Resources\Instances\Tables;

use App\Filament\Actions\ConnectWhatsappAction;
use App\Filament\Actions\VerifyConnectionAction;
use App\Services\WhatsappService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class InstancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->translateLabel()
                    ->searchable(),
                IconColumn::make('connected')
                    ->translateLabel()
                    ->boolean(),
                TextColumn::make('created_at')
                    ->translateLabel()
                    ->dateTime(),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                VerifyConnectionAction::make(),
                ConnectWhatsappAction::make()
                    ->visible(fn ($record) => !$record->connected),
                ViewAction::make(),
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
