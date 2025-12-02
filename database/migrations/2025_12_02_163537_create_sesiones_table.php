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
        Schema::create('sesiones', function (Blueprint $table) {
            $table->id('id_sesion');
            $table->foreignId('id_usuario')->constrained('users', 'id')->onDelete('cascade');
            $table->integer('level_reached')->default(1);
            $table->integer('n_attemps')->default(0);
            $table->integer('errors')->default(0);
            $table->integer('helps_clicks')->default(0);
            $table->integer('operaciones_resueltas')->default(0);
            $table->dateTime('date_time');
            $table->time('hora');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesiones');
    }
};
