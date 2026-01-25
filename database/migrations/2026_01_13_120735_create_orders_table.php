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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('expiry_date');
            $table->integer('words'); // 250, 500, 750, 1000...
            $table->text('description');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('restrict');
            $table->decimal('total_amount', 10, 2);
            $table->json('attachments')->nullable(); // PDF, Word, Image, Video paths
            $table->string('half_payment_image')->nullable();
            $table->string('full_payment_image')->nullable();
            $table->string('half_file')->nullable();
            $table->string('full_file')->nullable();
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
            ])->default('pending');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->boolean('is_visible_to_client')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
