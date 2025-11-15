<?php

namespace App\Filament\Resources\Messages\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MessageInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('uuid')
                    ->label('UUID'),
                TextEntry::make('workspace_id')
                    ->numeric(),
                TextEntry::make('user_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('campaign_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('src'),
                TextEntry::make('dest'),
                TextEntry::make('message')
                    ->columnSpanFull(),
                TextEntry::make('type')
                    ->placeholder('-'),
                TextEntry::make('priority')
                    ->placeholder('-'),
                TextEntry::make('encoding')
                    ->placeholder('-'),
                TextEntry::make('segments')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('message_length')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('gateway_message_id')
                    ->placeholder('-'),
                TextEntry::make('status')
                    ->placeholder('-'),
                TextEntry::make('balance_before')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('balance_after')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('cost')
                    ->money()
                    ->placeholder('-'),
                TextEntry::make('units_used')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('channel')
                    ->placeholder('-'),
                TextEntry::make('sms_channel')
                    ->placeholder('-'),
                TextEntry::make('currency_code')
                    ->placeholder('-'),
                TextEntry::make('direction')
                    ->placeholder('-'),
                TextEntry::make('delivery_type')
                    ->placeholder('-'),
                TextEntry::make('country')
                    ->placeholder('-'),
                TextEntry::make('attempts')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('scheduled_at')
                    ->dateTime(),
                TextEntry::make('sent_at')
                    ->dateTime(),
                TextEntry::make('delivered_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
