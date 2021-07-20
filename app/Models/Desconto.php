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
            case 7:
                $forma_pagamento->id = $value;
                $forma_pagamento->label = 'Acadêmico';

                return $forma_pagamento;
            break;
        }
    }

    public function getPorcentagemLabelAttribute()
    {
        return $this->attributes['porcentagem'] . '%';
    }

    public static function formas_pagamento()
    {
        $array = [
            [
                'id' => 1, 'label' => 'Dinheiro', 'desconto' => Desconto::select('porcentagem')->where('forma_pagamento', 1)->first()
            ],
            [
                'id' => 2, 'label' => 'Débito', 'desconto' => Desconto::select('porcentagem')->where('forma_pagamento', 2)->first()
            ],
            [
                'id' => 3, 'label' => 'Crédito', 'desconto' => Desconto::select('porcentagem')->where('forma_pagamento', 3)->first()
            ],
            [
                'id' => 4, 'label' => 'Crédito parcelado', 'desconto' => Desconto::select('porcentagem')->where('forma_pagamento', 4)->first()
            ],
            [
                'id' => 5, 'label' => 'Transferência bancária', 'desconto' => Desconto::select('porcentagem')->where('forma_pagamento', 5)->first()
            ],
            [
                'id' => 6, 'label' => 'Pix', 'desconto' => Desconto::select('porcentagem')->where('forma_pagamento', 6)->first()
            ],
            [
                'id' => 7, 'label' => 'Acadêmico', 'desconto' => Desconto::select('porcentagem')->where('forma_pagamento', 7)->first()
            ]
        ];
        $formas_pagamentos = json_decode(json_encode($array), FALSE);
        return $formas_pagamentos;
    }
}
