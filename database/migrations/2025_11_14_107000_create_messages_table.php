<?php
// database/migrations/2025_11_15_000000_create_partitioned_messages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Parent table with RANGE partitioning
        DB::statement(
            <<<SQL
CREATE TABLE IF NOT EXISTS messages (
    id BIGSERIAL NOT NULL,
    created_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    uuid UUID NOT NULL DEFAULT gen_random_uuid(),
    workspace_id BIGINT NOT NULL,
    user_id BIGINT,
    campaign_id BIGINT,
    src VARCHAR(255) NOT NULL,
    dest VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    type VARCHAR(50) DEFAULT 'plain',
    priority VARCHAR(10) DEFAULT 'normal',
    encoding VARCHAR(10) DEFAULT 'GSM-7',
    segments INT DEFAULT 1,
    message_length INT DEFAULT 0,
    gateway_message_id VARCHAR(255),
    status VARCHAR(20) DEFAULT 'queued',
    balance_before BIGINT,
    balance_after BIGINT,
    cost BIGINT,
    units_used BIGINT DEFAULT 0,
    channel VARCHAR(50) DEFAULT 'dashboard',
    sms_channel VARCHAR(50) DEFAULT 'bulk',
    currency_code VARCHAR(10) DEFAULT 'GHS',
    direction VARCHAR(5) DEFAULT 'mt',
    delivery_type VARCHAR(5) DEFAULT 'i',
    country VARCHAR(5),
    attempts INT DEFAULT 0,
    scheduled_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    sent_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    delivered_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMPTZ NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id, created_at)
) PARTITION BY RANGE (created_at);

SQL
        );

        // Optional: create initial partition for today
        $today = now()->format('Y_m_d');
        $tomorrow = now()->addDay()->format('Y-m-d');
        DB::statement(
            <<<SQL
CREATE TABLE IF NOT EXISTS messages_{$today} PARTITION OF messages
    FOR VALUES FROM ('{$today} 00:00:00') TO ('{$tomorrow} 00:00:00');
SQL
        );

        // Indexes on parent table (propagates to partitions)
        DB::statement("CREATE INDEX IF NOT EXISTS idx_messages_status_workspace ON messages (workspace_id, status);");
        DB::statement("CREATE INDEX IF NOT EXISTS idx_messages_user_id ON messages (user_id);");
        DB::statement("CREATE INDEX IF NOT EXISTS idx_messages_dest ON messages (dest);");
    }

    public function down(): void
    {
        DB::statement("DROP TABLE IF EXISTS messages CASCADE;");
    }
};
