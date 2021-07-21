<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'nome',
        'descricao',
        'relevante'
    ];

    protected $casts = [
        'relevante' => 'boolean',
    ];

    protected $table = 'categorias';

    public static function getCategorias() {
        return Categoria::all();
    }

    public static function getCategoriasPrincipais() {
        return Categoria::where('relevante', true)->get();
    }

    public static function getCategoriasSecundarias() {
        return Categoria::where('relevante', false)->get();
    }

    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class,'categoria_id', 'id');
    }
}
