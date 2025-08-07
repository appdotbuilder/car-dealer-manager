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
        Schema::create('spare_part_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spare_part_id')->constrained()->onDelete('restrict');
            $table->foreignId('customer_id')->constrained()->onDelete('restrict');
            $table->foreignId('sales_person_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('service_id')->nullable()->constrained()->onDelete('set null');
            $table->string('invoice_number')->unique();
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->date('sale_date');
            $table->enum('status', ['pending', 'completed', 'returned'])->default('completed');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index('invoice_number');
            $table->index('spare_part_id');
            $table->index('customer_id');
            $table->index('sales_person_id');
            $table->index('sale_date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spare_part_sales');
    }
};