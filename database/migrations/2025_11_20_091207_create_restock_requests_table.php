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
        Schema::create('restock_requests', function (Blueprint $table) {
            $table->id();
            // Link sa Product at User (Parehong UUID)
            $table->foreignUuid('product_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade'); // User who requested
            
            $table->integer('quantity')->default(0); // Suggested quantity (optional)
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('notes')->nullable(); // Reason for restock
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restock_requests');
    }
};
