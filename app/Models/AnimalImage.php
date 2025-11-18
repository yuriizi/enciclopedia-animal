<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnimalImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'caminho_imagem',
        'legenda',
        'destaque',
        'credito_autor',
        'fonte_imagem',
    ];

    protected $casts = [
        'destaque' => 'boolean',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class);
    }
}