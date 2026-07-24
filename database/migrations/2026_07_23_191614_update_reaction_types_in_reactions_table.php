<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change existing values first
        DB::table('reactions')
            ->where('type', 'love')
            ->update(['type' => 'heart']);

        DB::table('reactions')
            ->where('type', 'laugh')
            ->update(['type' => 'happy']);

        DB::table('reactions')
            ->where('type', 'angry')
            ->update(['type' => 'fire']);

        // Change the ENUM values
        DB::statement("
            ALTER TABLE reactions
            MODIFY type ENUM('like', 'heart', 'happy', 'sad', 'fire')
            NOT NULL DEFAULT 'like'
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Temporarily add the old ENUM values back
        DB::statement("
            ALTER TABLE reactions
            MODIFY type ENUM(
                'like',
                'love',
                'laugh',
                'sad',
                'angry',
                'happy'
            )
            NOT NULL DEFAULT 'like'
        ");

        // Restore the old values
        DB::table('reactions')
            ->where('type', 'heart')
            ->update(['type' => 'love']);

        DB::table('reactions')
            ->where('type', 'fire')
            ->update(['type' => 'angry']);

        // WARNING:
        // 'happy' cannot be automatically reverted to 'laugh'
        // because 'happy' was already an original valid value.
    }
};
