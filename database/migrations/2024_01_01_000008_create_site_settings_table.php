<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // copyright_text, site_title, etc.
            $table->text('value')->nullable(); // Valor de la configuración (ahora permite nulos)
            $table->string('type')->default('text'); // text, textarea, image, boolean
            $table->string('group')->default('general'); // general, footer, seo, etc.
            $table->text('description')->nullable(); // Descripción del campo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
}; 