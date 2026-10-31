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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('title', 120);
            $table->text('description');
            $table->string('category', 32);
            $table->string('type', 32);
            $table->decimal('price', 8, 2)->nullable()->default(0);
            $table->string('quantity', 50);
            $table->date('expiry_date');
            $table->text('pickup_instructions');
            $table->string('status', 32)->default('available');
            $table->timestamps();

            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
