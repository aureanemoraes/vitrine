<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategoria extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nome',
        'descricao',
        'categoria_id'
    ];

    protected $table = 'subcategorias';

    public static function getSubcategorias() {
        return Subcategoria::all();
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id', 'id');
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class, 'subcategoria_id', 'id');
    }
}
