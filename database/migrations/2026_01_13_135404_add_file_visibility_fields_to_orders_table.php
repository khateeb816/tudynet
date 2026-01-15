<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('half_file_visible')->default(false)->after('is_visible_to_client');
            $table->boolean('full_file_visible')->default(false)->after('half_file_visible');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['half_file_visible', 'full_file_visible']);
        });
    }
};
