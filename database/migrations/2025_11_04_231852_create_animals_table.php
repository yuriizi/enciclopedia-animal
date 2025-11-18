<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cientifico');
            $table->string('nome_comum');
            $table->string('nome_ingles')->nullable();
            $table->string('slug')->unique();
            $table->string('reino');
            $table->string('filo');
            $table->string('classe');
            $table->string('ordem');
            $table->string('familia');
            $table->string('genero');
            $table->string('especie');
            $table->enum('categoria_ameaca', ['EX','EW','CR','EN','VU','NT','LC','DD','NE']);
            $table->string('criterios_ameaca')->nullable();
            $table->year('ano_avaliacao')->nullable();
            $table->json('paises_ocorrencia')->nullable();
            $table->text('regiao_biogeografica')->nullable();
            $table->text('habitat')->nullable();
            $table->text('descricao_morfologica')->nullable();
            $table->text('biologia_reproducao')->nullable();
            $table->text('dieta')->nullable();
            $table->string('longevidade')->nullable();
            $table->string('tamanho_populacao')->nullable();
            $table->text('tendencia_populacao')->nullable();
            $table->json('principais_ameacas')->nullable();
            $table->text('medidas_conservacao')->nullable();
            $table->string('numero_cop15')->nullable();
            $table->text('justificativa_inclusao')->nullable();
            $table->json('documentos_referencia')->nullable();
            $table->string('imagem_principal')->nullable();
            $table->json('galeria_imagens')->nullable();
            $table->string('som_animal')->nullable();
            $table->string('video_animal')->nullable();
            $table->boolean('publicado')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('animals');
    }
};