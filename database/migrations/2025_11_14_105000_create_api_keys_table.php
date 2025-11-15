<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('api_keys', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->comment('FK: api_keys_user_id_foreign');

            $table->foreignId('workspace_id')
                ->constrained('workspaces')
                ->cascadeOnDelete()
                ->comment('FK: api_keys_workspace_id_foreign');

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('key', 64)->unique();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('api_keys');
    }
};
