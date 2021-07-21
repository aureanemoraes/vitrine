<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parcelamento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'parcelamentos';

    protected $fillable = [
        'nome',
        'parcelas',
        'valor_minimo'
    ];

    public static function getParcelamentos() {
        return Parcelamento::orderBy('valor_minimo', 'desc')->get();
    }
}
