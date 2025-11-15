<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Workspace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'user_id',  // owner
        'slug',
        'balance_units',
        'bill_type', // prepaid or postpaid
        'plan_id',
        'status', // active, banned
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot('role');
    }

    // Owner of the workspace
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Optional: child workspaces
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    // Optional: parent workspace
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    // Workspace's plan
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    // Many-to-many with users
    public function members(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'workspace_user')
            ->withPivot('role')
            ->withTimestamps();
    }
}
