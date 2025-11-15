<?php

namespace App\Filament\Resources\Sendernames\Pages;

use App\Filament\Resources\Sendernames\SendernameResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSendername extends EditRecord
{
    protected static string $resource = SendernameResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
