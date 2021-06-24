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
}
