<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('animal_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_id')->constrained()->onDelete('cascade');
            $table->string('caminho_imagem');
            $table->string('legenda')->nullable();
            $table->boolean('destaque')->default(false);
            $table->string('credito_autor')->nullable();
            $table->string('fonte_imagem')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('animal_images');
    }
};