<?php

namespace App\Filament\Resources\Sendernames\Pages;

use App\Filament\Resources\Sendernames\SendernameResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSendername extends ViewRecord
{
    protected static string $resource = SendernameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
