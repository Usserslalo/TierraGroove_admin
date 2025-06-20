<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->integer('quantity_available');
            $table->integer('quantity_sold')->default(0);
            $table->date('sale_start_date')->nullable();
            $table->date('sale_end_date')->nullable();
            $table->json('benefits')->nullable(); // Beneficios incluidos
            $table->string('status')->default('active'); // active, inactive, sold_out
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
}; 