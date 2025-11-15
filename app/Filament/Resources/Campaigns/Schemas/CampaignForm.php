<?php

namespace App\Filament\Resources\Campaigns\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CampaignForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('workspace_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->numeric(),
                TextInput::make('name')
                    ->required(),
                Textarea::make('content')
                    ->columnSpanFull(),
                TextInput::make('src'),
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
                DateTimePicker::make('scheduled_at'),
                DateTimePicker::make('completed_at'),
                TextInput::make('total_messages')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('total_units_used')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
