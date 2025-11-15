<?php

namespace App\Filament\Resources\Messages\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class MessageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('uuid')
                    ->label('UUID')
                    ->required()
                    ->default('gen_random_uuid()'),
                TextInput::make('workspace_id')
                    ->required()
                    ->numeric(),
                TextInput::make('user_id')
                    ->numeric(),
                TextInput::make('campaign_id')
                    ->numeric(),
                TextInput::make('src')
                    ->required(),
                TextInput::make('dest')
                    ->required(),
                Textarea::make('message')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('type')
                    ->default('plain'),
                TextInput::make('priority')
                    ->default('normal'),
                TextInput::make('encoding')
                    ->default('GSM-7'),
                TextInput::make('segments')
                    ->numeric()
                    ->default(1),
                TextInput::make('message_length')
                    ->numeric()
                    ->default(0),
                TextInput::make('gateway_message_id'),
                TextInput::make('status')
                    ->default('queued'),
                TextInput::make('balance_before')
                    ->numeric(),
                TextInput::make('balance_after')
                    ->numeric(),
                TextInput::make('cost')
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('units_used')
                    ->numeric()
                    ->default(0),
                TextInput::make('channel')
                    ->default('dashboard'),
                TextInput::make('sms_channel')
                    ->default('bulk'),
                TextInput::make('currency_code')
                    ->default('GHS'),
                TextInput::make('direction')
                    ->default('mt'),
                TextInput::make('delivery_type')
                    ->default('i'),
                TextInput::make('country'),
                TextInput::make('attempts')
                    ->numeric()
                    ->default(0),
                DateTimePicker::make('scheduled_at')
                    ->required(),
                DateTimePicker::make('sent_at')
                    ->required(),
                DateTimePicker::make('delivered_at')
                    ->required(),
            ]);
    }
}
