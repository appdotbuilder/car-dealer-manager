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
        Schema::create('customer_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('vin')->unique();
            $table->string('make');
            $table->string('model');
            $table->integer('year');
            $table->string('color');
            $table->decimal('mileage', 10, 2);
            $table->string('license_plate')->nullable();
            $table->date('purchase_date')->nullable();
            $table->enum('status', ['active', 'sold', 'traded'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('customer_id');
            $table->index('vin');
            $table->index(['make', 'model']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_vehicles');
    }
};