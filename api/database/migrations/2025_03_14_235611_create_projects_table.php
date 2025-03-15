<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                $table->string('name'); // Nombre del proyecto
                $table->text('description')->nullable(); // Descripción (opcional)
                $table->timestamps(); // created_at y updated_at
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
