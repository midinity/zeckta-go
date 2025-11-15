<?php

namespace App\Filament\Resources\Sendernames\Pages;

use App\Filament\Resources\Sendernames\SendernameResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSendername extends CreateRecord
{
    protected static string $resource = SendernameResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['country'] = 'GH';
        return $data;
    }
}
