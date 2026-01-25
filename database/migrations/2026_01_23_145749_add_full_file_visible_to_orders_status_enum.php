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
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', [
                'pending',
                'half_payment_uploaded',
                'approved',
                'assigned_to_writer',
                'researching',
                'writing',
                'reviewing',
                'half_file_uploaded',
                'full_file_uploaded',
                'full_file_visible',
                'completed',
                'half_file_visible',
                'full_payment_uploaded',
                'full_payment_verified',
                'revision_requested',
                'cancelled'
            ])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
             $table->enum('status', [
                'pending',
                'half_payment_uploaded',
                'approved',
                'assigned_to_writer',
                'researching',
                'writing',
                'reviewing',
                'half_file_uploaded',
                'full_file_uploaded',
                'completed',
                'half_file_visible',
                'full_payment_uploaded',
                'full_payment_verified',
                'revision_requested',
                'cancelled'
            ])->default('pending')->change();
        });
    }
};
