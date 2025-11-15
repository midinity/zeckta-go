<?php
// database/migrations/2025_11_14_000000_enable_pgcrypto_extension.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('CREATE EXTENSION IF NOT EXISTS "pgcrypto";');
    }

    public function down(): void
    {
        DB::statement('DROP EXTENSION IF EXISTS "pgcrypto";');
    }
};
