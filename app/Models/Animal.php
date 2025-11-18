<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome_cientifico',
        'nome_comum',
        'nome_ingles',
        'slug',
        'reino',
        'filo',
        'classe',
        'ordem',
        'familia',
        'genero',
        'especie',
        'categoria_ameaca',
        'criterios_ameaca',
        'ano_avaliacao',
        'paises_ocorrencia',
        'regiao_biogeografica',
        'habitat',
        'descricao_morfologica',
        'biologia_reproducao',
        'dieta',
        'longevidade',
        'tamanho_populacao',
        'tendencia_populacao',
        'principais_ameacas',
        'medidas_conservacao',
        'numero_cop15',
        'justificativa_inclusao',
        'documentos_referencia',
        'imagem_principal',
        'galeria_imagens',
        'som_animal',
        'video_animal',
        'publicado',
    ];

    protected $casts = [
        'paises_ocorrencia' => 'array',
        'principais_ameacas' => 'array',
        'documentos_referencia' => 'array',
        'galeria_imagens' => 'array',
        'publicado' => 'boolean',
        'ano_avaliacao' => 'integer',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(AnimalImage::class);
    }

    public function featuredImage()
    {
        return $this->images()->where('destaque', true)->first();
    }
}