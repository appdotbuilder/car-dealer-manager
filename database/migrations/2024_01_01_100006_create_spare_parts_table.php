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
        Schema::create('spare_parts', function (Blueprint $table) {
            $table->id();
            $table->string('part_number')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('category');
            $table->string('brand');
            $table->decimal('cost_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->integer('quantity_in_stock')->default(0);
            $table->integer('minimum_stock_level')->default(5);
            $table->string('supplier')->nullable();
            $table->string('location')->nullable();
            $table->enum('status', ['active', 'discontinued'])->default('active');
            $table->timestamps();
            
            // Indexes
            $table->index('part_number');
            $table->index('name');
            $table->index('category');
            $table->index('brand');
            $table->index('status');
            $table->index('quantity_in_stock');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spare_parts');
    }
};