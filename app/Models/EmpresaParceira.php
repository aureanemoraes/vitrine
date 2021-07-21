<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmpresaParceira extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'empresas_parceiras';

    protected $fillable = [
        'id',
        'nome',
        'logo',
        'descricao',
        'site',
        'relevante'
    ];

    protected $casts = [
        'relevante' => 'boolean',
    ];

    public static function getEmpresasParceiras() {
        return EmpresaParceira::all();
    }

    // Relacionamentos
    public function produtos() {
        return $this->hasMany(Produto::class);
    }
}
