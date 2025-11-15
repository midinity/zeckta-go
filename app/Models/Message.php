<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'workspace_id',
        'user_id',
        'campaign_id',
        'src',
        'dest',
        'message',
        'type',
        'priority',
        'encoding',
        'segments',
        'message_length',
        'gateway_message_id',
        'units_used',
        'channel',
        'sms_channel',
        'currency_code',
        'direction',
        'delivery_type',
        'country',
        'attempts',
        'scheduled_at',
        'sent_at',
        'delivered_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'sent_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
