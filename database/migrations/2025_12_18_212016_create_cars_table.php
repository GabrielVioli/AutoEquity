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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();
            $table->string('fipe_codigo');
            $table->string('marca');
            $table->string('modelo');
            $table->integer('ano_modelo');
            $table->string('combustivel');
            $table->string('valor');
            $table->string('mes_referencia');
            $table->string('sigla_combustivel')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
