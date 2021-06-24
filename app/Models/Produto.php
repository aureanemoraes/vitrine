<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'produtos';

    protected $fillable = [
        'nome',
        'descricao',
        'valor',
        'disponibilidade',
        'imagens',
        'desconto'
    ];

    protected $casts = [
        'imagens' => 'array',
    ];

    // Criar vários acessors com os valores de parcelamento e descontos

    public function descontos() {
        return $this->belongsToMany(Desconto::class);
    }
}
