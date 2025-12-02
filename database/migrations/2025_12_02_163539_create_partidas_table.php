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
        Schema::create('partidas', function (Blueprint $table) {
            $table->id('id_partida');
            $table->foreignId('id_usuario')->constrained('users', 'id')->onDelete('cascade');
            $table->unsignedBigInteger('id_juego');
            $table->foreign('id_juego')->references('id_juego')->on('juegos')->onDelete('cascade');
            $table->date('fecha');
            $table->foreign('fecha')->references('fecha')->on('fechas')->onDelete('cascade');
            $table->unsignedBigInteger('id_sesion');
            $table->foreign('id_sesion')->references('id_sesion')->on('sesiones')->onDelete('cascade')->unique();
            $table->integer('puntuacion')->default(0);
            $table->integer('tiempo_seg')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidas');
    }
};
