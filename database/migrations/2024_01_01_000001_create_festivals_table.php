<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('festivals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('location');
            $table->string('location_coordinates')->nullable(); // Para Google Maps
            $table->string('status')->default('active'); // active, inactive, draft
            $table->string('featured_image')->nullable();
            $table->json('social_links')->nullable(); // Facebook, Instagram, etc.
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('festivals');
    }
}; 