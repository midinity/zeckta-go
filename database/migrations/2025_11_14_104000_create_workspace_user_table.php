<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('workspace_user', function (Blueprint $table) {
            $table->id();

            $table->foreignId('workspace_id')
                ->constrained('workspaces')
                ->cascadeOnDelete()
                ->comment('FK: user_workspace_workspace_id_foreign');

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->comment('FK: user_workspace_user_id_foreign');

            $table->string('role')->nullable()->comment('Role of the user in the workspace (admin, member, etc.)');

            $table->timestamps();

            $table->unique(['workspace_id', 'user_id']);
        });

        // Optional: explicitly set foreign key names (avoids duplicate constraint errors in PostgreSQL)
        Schema::table('workspace_user', function (Blueprint $table) {
            $table->dropForeign(['workspace_id']);
            $table->dropForeign(['user_id']);

            $table->foreign('workspace_id', 'workspace_user_workspace_id_foreign')
                ->references('id')
                ->on('workspaces')
                ->cascadeOnDelete();

            $table->foreign('user_id', 'uworkspace_user_id_foreign')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workspace_user', function (Blueprint $table) {
            $table->dropForeign('workspace_user_workspace_id_foreign');
            $table->dropForeign('workspace_user_user_id_foreign');
        });

        Schema::dropIfExists('workspace_user');
    }
};
