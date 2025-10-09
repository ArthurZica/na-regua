<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\Models\Customer;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Ysfkaya\FilamentPhoneInput\Infolists\PhoneEntry;
use Ysfkaya\FilamentPhoneInput\PhoneInputNumberType;

class CustomerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('email')
                    ->label('Email address')
                    ->translateLabel(),
                TextEntry::make('name')->translateLabel(),
                PhoneEntry::make('phone')->displayFormat(PhoneInputNumberType::INTERNATIONAL)->translateLabel(),
            ]);
    }
}
