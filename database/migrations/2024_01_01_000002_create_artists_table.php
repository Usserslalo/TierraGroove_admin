<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('bio')->nullable();
            $table->string('genre');
            $table->string('country');
            $table->string('image')->nullable();
            $table->string('social_links')->nullable(); // Instagram, Spotify, etc.
            $table->integer('order')->default(0); // Para ordenar en el lineup
            $table->boolean('is_featured')->default(false);
            $table->string('status')->default('active'); // active, inactive
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
}; 