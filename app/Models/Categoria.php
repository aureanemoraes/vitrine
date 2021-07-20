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
        'descricao'
    ];

    protected $table = 'categorias';

    public static function getCategorias() {
        return Categoria::all();
    }

    public function subcategorias()
    {
        return $this->hasMany(Subcategoria::class,'categoria_id', 'id');
    }
}
