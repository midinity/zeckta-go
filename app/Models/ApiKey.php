<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ApiKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_active',
        'user_id',
        'workspace_id',
        'key',
    ];

    protected static function booted(): void
    {
        static::creating(function (ApiKey $apiKey) {
            // Assign logged-in user if not already set
            if (! $apiKey->user_id) {
                $apiKey->user_id = Auth::id();
            }

            // Assign workspace if not set
            if (! $apiKey->workspace_id && Auth::user()) {
                $apiKey->workspace_id = Auth::user()->workspaces()->first()?->id;
            }

            // Generate unique key
            if (! $apiKey->key) {
                $apiKey->key = self::generateKey();
            }
        });
    }

    public static function generateKey(): string
    {
        do {
            $key = bin2hex(random_bytes(32));
        } while (self::where('key', $key)->exists());

        return $key;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
