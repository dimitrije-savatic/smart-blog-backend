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
        Schema::table('views', function (Blueprint $table) {
            $table->index(['post_id', 'user_id']);
            $table->index(['post_id', 'visitor_token']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('views', function (Blueprint $table) {
            $table->dropIndex(['post_id', 'user_id']);
            $table->dropIndex(['post_id', 'visitor_token']);
            $table->dropIndex(['created_at']);
        });
    }
};
