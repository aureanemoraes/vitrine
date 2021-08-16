<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    use HasFactory;

    protected $table = 'anuncios';

    protected $fillable = [
        'nome',
        'imagem',
        'descricao',
        'url',
        'ativo'
    ];

    protected $casts = [
        'ativo' => 'boolean'
    ];
}
