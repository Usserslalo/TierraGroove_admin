<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('social_links', function (Blueprint $table) {
            $table->id();
            $table->string('platform'); // facebook, instagram, twitter, etc.
            $table->string('name'); // Nombre de la plataforma
            $table->string('url'); // URL del perfil
            $table->string('icon'); // Clase del icono (fab fa-facebook, etc.)
            $table->string('color')->nullable(); // Color personalizado
            $table->integer('order')->default(0); // Orden en el footer
            $table->boolean('is_active')->default(true); // Si está visible
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('social_links');
    }
}; 