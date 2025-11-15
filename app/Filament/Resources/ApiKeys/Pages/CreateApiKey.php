<?php

namespace App\Filament\Resources\ApiKeys\Pages;

use App\Filament\Resources\ApiKeys\ApiKeyResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;


class CreateApiKey extends CreateRecord
{
    protected static string $resource = ApiKeyResource::class;

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $data['user_id'] = Auth::id();
    //     $data['key'] = bin2hex(string: random_bytes(32));
    //     return $data;
    // }
}
