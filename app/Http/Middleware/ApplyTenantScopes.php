<?php

namespace App\Http\Middleware;

use App\Models\ApiKey;
use App\Models\Campaign;
use App\Models\Message;
use App\Models\SenderName;
use App\Models\User;
use App\Models\Workspace;
use App\Models\WorkspaceUser;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ApplyTenantScopes
{
    public function handle(Request $request, Closure $next)
    {
        ApiKey::addGlobalScope(
            'tenant',
            fn(Builder $query) => $query->whereBelongsTo(Filament::getTenant()),
        );

        Campaign::addGlobalScope(
            'tenant',
            fn(Builder $query) => $query->whereBelongsTo(Filament::getTenant()),
        );
        Message::addGlobalScope(
            'tenant',
            fn(Builder $query) => $query->whereBelongsTo(Filament::getTenant()),
        );

        SenderName::addGlobalScope(
            'tenant',
            fn(Builder $query) => $query->whereBelongsTo(Filament::getTenant()),
        );


        User::addGlobalScope(
            'tenant',
            fn(Builder $query) => $query->whereBelongsTo(Filament::getTenant()),
        );


        WorkspaceUser::addGlobalScope(
            'tenant',
            fn(Builder $query) => $query->whereBelongsTo(Filament::getTenant()),
        );


        return $next($request);
    }
}
