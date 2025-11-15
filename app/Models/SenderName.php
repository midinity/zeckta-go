<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenderName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status', // approved, rejected, declined, banned
        'workspace_id',
        'user_id',
        'country',
    ];

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
