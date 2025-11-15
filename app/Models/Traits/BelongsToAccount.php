<?php
// app/Models/Traits/BelongsToAccount.php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

trait BelongsToAccount
{
    /**
     * Boot the trait and add a global scope to filter by user's accounts.
     */
    protected static function bootBelongsToAccount()
    {
        static::addGlobalScope('account', function (Builder $builder) {
            // Only apply scope if a user is logged in
            if (Auth::check()) {
                // Filter by all accounts the user belongs to
                $accountIds = Auth::user()->accounts->pluck('id');
                $builder->whereIn('account_id', $accountIds);
            }
        });
    }

    /**
     * Optional helper relationship to the account model.
     */
    public function account()
    {
        return $this->belongsTo(\App\Models\Account::class);
    }
}
