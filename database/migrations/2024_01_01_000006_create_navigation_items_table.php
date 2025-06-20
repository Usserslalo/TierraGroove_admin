<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('navigation_items', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre visible en el menú
            $table->string('slug'); // URL slug (inicio, lineup, etc.)
            $table->string('route')->nullable(); // Ruta Laravel
            $table->string('url')->nullable(); // URL externa
            $table->integer('order')->default(0); // Orden en el menú
            $table->boolean('is_active')->default(true); // Si está visible
            $table->boolean('is_external')->default(false); // Si es enlace externo
            $table->string('icon')->nullable(); // Icono (opcional)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigation_items');
    }
}; 