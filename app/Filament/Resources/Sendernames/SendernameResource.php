<?php

namespace App\Filament\Resources\Sendernames;

use App\Filament\Resources\Sendernames\Pages\CreateSendername;
use App\Filament\Resources\Sendernames\Pages\EditSendername;
use App\Filament\Resources\Sendernames\Pages\ListSendernames;
use App\Filament\Resources\Sendernames\Pages\ViewSendername;
use App\Filament\Resources\Sendernames\Schemas\SendernameForm;
use App\Filament\Resources\Sendernames\Schemas\SendernameInfolist;
use App\Filament\Resources\Sendernames\Tables\SendernamesTable;
use App\Models\Sendername;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SendernameResource extends Resource
{
    protected static ?string $model = Sendername::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static string|UnitEnum|null $navigationGroup = 'Messaging';


    protected static ?string $recordTitleAttribute = 'SenderName';

    public static function form(Schema $schema): Schema
    {
        return SendernameForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SendernameInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SendernamesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSendernames::route('/'),
            'create' => CreateSendername::route('/create'),
            'view' => ViewSendername::route('/{record}'),
            'edit' => EditSendername::route('/{record}/edit'),
        ];
    }
}
