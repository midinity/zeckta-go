<?php
// database/migrations/2025_11_14_004000_create_campaigns_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();

            $table->foreignId('workspace_id')->constrained('workspaces')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('name');
            $table->text('content')->nullable();
            $table->string('src')->nullable();

            $table->enum('status', ['draft', 'scheduled', 'sending', 'completed', 'failed'])->default('draft');

            $table->timestampTz('scheduled_at')->nullable();
            $table->timestampTz('completed_at')->nullable();

            $table->integer('total_messages')->default(0);
            $table->integer('total_units_used')->default(0);

            $table->timestamps();

            $table->index(['workspace_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
