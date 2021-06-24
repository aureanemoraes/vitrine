<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use stdClass;

class Desconto extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'descontos';

    protected $fillable = [
        'nome',
        'forma_pagamento',
        'porcentagem'
    ];

    protected $appends = ['porcentagem_label'];

    public function getFormaPagamentoAttribute($value)
    {
        $forma_pagamento = new stdClass();
        switch($value) {
            case 1:
                $forma_pagamento->id = $value;
                $forma_pagamento->label = 'Dinheiro';

                return $forma_pagamento;
            break;
            case 2:
                $forma_pagamento->id = $value;
                $forma_pagamento->label = 'Débito';

                return $forma_pagamento;
            break;
            case 3:
                $forma_pagamento->id = $value;
                $forma_pagamento->label = 'Crédito';

                return $forma_pagamento;
            break;
            case 4:
                $forma_pagamento->id = $value;
                $forma_pagamento->label = 'Crédito parcelado';

                return $forma_pagamento;
            break;
            case 5:
                $forma_pagamento->id = $value;
                $forma_pagamento->label = 'Transferência bancária';

                return $forma_pagamento;
            break;
            case 6:
                $forma_pagamento->id = $value;
                $forma_pagamento->label = 'Pix';

                return $forma_pagamento;
            break;
        }
    }

    public function getPorcentagemLabelAttribute()
    {
        return $this->attributes['porcentagem'] . '%';
    }
}
