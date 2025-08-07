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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('vin')->unique()->comment('Vehicle Identification Number');
            $table->string('make');
            $table->string('model');
            $table->integer('year');
            $table->string('color');
            $table->enum('condition', ['new', 'used'])->default('new');
            $table->decimal('mileage', 10, 2)->default(0);
            $table->enum('fuel_type', ['gasoline', 'diesel', 'electric', 'hybrid'])->default('gasoline');
            $table->enum('transmission', ['manual', 'automatic'])->default('automatic');
            $table->integer('doors')->default(4);
            $table->string('engine_size')->nullable();
            $table->decimal('purchase_price', 12, 2);
            $table->decimal('selling_price', 12, 2);
            $table->date('purchase_date');
            $table->date('sale_date')->nullable();
            $table->enum('status', ['available', 'reserved', 'sold', 'maintenance'])->default('available');
            $table->text('description')->nullable();
            $table->text('features')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('make');
            $table->index('model');
            $table->index('year');
            $table->index('condition');
            $table->index('status');
            $table->index(['make', 'model']);
            $table->index(['status', 'condition']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};