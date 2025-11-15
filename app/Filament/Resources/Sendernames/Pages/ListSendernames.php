<?php

namespace App\Filament\Resources\Sendernames\Pages;

use App\Filament\Resources\Sendernames\SendernameResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSendernames extends ListRecords
{
    protected static string $resource = SendernameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
