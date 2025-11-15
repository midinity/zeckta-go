<?php
// database/migrations/2025_11_14_002000_create_messages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            // UUID for external tracking
            $table->uuid('uuid')->default(DB::raw('gen_random_uuid()'))->unique();

            // Workspace
            $table->foreignId('workspace_id')->constrained('workspaces')->cascadeOnDelete();

            // Who created it on dashboard
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            // Campaign linkage
            $table->foreignId('campaign_id')->nullable()->constrained('campaigns')->nullOnDelete();

            // SRC and DEST
            $table->string('src');      // senderName
            $table->string('dest');     // recipient

            // Core message body
            $table->text('message');

            // Message type
            $table->string('type')->default('plain');

            // Priority
            $table->enum('priority', ['normal', 'medium', 'high'])->default('normal');

            // Encoding & segment breakdown
            $table->enum('encoding', ['GSM-7', 'UCS2', 'AUTO'])->default('GSM-7');
            $table->integer('segments')->default(1);
            $table->integer('message_length')->default(0);

            // Gateway details
            $table->string('gateway_message_id')->nullable();

            // Status tracking
            $table->enum('status', [
                'queued',
                'accepted',
                'sending',
                'sent',
                'delivered',
                'failed',
                'bounced'
            ])->default('queued');

            // Financials
            $table->decimal('balance_before', 12, 2)->nullable();
            $table->decimal('balance_after', 12, 2)->nullable();
            $table->decimal('cost', 12, 4)->nullable();
            $table->integer('units_used')->default(0);

            // Channels
            $table->string('channel')->default('dashboard');   // dashboard/api/etc
            $table->string('sms_channel')->default('bulk');     // bulk/transactional/etc

            // Metadata
            $table->string('currency_code', 10)->default('GHS');
            $table->string('direction', 5)->default('mt');      // mt / mo
            $table->string('delivery_type', 5)->nullable();     // "i" etc.
            $table->string('country', 5)->nullable();

            // Attempts & timestamps
            $table->integer('attempts')->default(0);
            $table->timestampTz('scheduled_at')->nullable();
            $table->timestampTz('sent_at')->nullable();
            $table->timestampTz('delivered_at')->nullable();

            $table->timestamps();

            // Indexes for speed
            $table->index(['workspace_id', 'status']);
            $table->index('user_id');
            $table->index('gateway_message_id');
            $table->index('dest');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
