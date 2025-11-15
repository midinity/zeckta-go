<?php

namespace App\Filament\Resources\ApiKeys\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ApiKeyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
            
                TextInput::make('name')
                    ->required(),
                TextInput::make('description')
                    ->required(),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
