<?php
// database/migrations/2025_11_14_001000_create_sender_names_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sender_names', function (Blueprint $table) {
            $table->id();

            // Workspace reference
            $table->foreignId('workspace_id')->constrained('workspaces')->cascadeOnDelete();

            // Who requested/owns or submitted this sender name (dashboard user)
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('name');          // not unique per your request
            $table->text('description')->nullable();
            $table->string('country')->nullable();

            // status: approved, rejected, declined, banned
            $table->enum('status', ['pending', 'approved', 'rejected', 'declined', 'banned'])->default('pending');

            $table->timestamps();

            // Indexes
            $table->index(['workspace_id']);
            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sender_names');
    }
};
