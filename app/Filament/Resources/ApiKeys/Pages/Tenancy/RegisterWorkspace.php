<?php

namespace App\Filament\Pages\Tenancy;

use App\Models\Account;
use App\Models\Workspace;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Tenancy\RegisterTenant;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;


class RegisterWorkspace extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Create a new workspace';
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->label('Workspace Name'),
                TextInput::make('slug')->required()->label('Workspace Slug')->unique(Workspace::class, 'slug'),
                // ...
            ]);
    }

    protected function handleRegistration(array $data): Workspace
    {
        $workspace = Workspace::create($data);

        // $workspace->members()->attach(Auth::user());
        // Attach the current user as the owner
        $workspace->members()->attach(Auth::id(), ['role' => 'owner']);


        return $workspace;
    }
}
