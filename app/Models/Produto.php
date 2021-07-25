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
        'desconto',
        'relevante',
        'categoria_id',
        'subcategoria_id',
        'empresa_parceira_id'
    ];

    protected $casts = [
        'imagens' => 'array',
        'disponibilidade' => 'boolean',
        'relevante' => 'boolean'
    ];

    protected $appends = [
        'valor_com_desconto',
        'valor_com_desconto_formatado',
        'valor_formatado'
    ];

    // Accessors e Mutators
    public function getValorComDescontoAttribute() {
        $desconto = $this->attributes['desconto'];
        $preco = $this->attributes['valor'];

        if(isset($desconto)) {
            $valor = $preco - ($preco * ($desconto/100));
            return $valor;
        }
    }

    public function getValorComDescontoFormatadoAttribute() {
        $desconto = $this->attributes['desconto'];
        $preco = $this->attributes['valor'];

        if(isset($desconto)) {
            $valor = $preco - ($preco * ($desconto/100));
            return 'R$ ' . number_format($valor, 2, ',', '.');
        }
    }

    public function getValorFormatadoAttribute() {
        $valor = $this->attributes['valor'];
        return 'R$ ' . number_format($valor, 2, ',', '.');
    }

    // Métodos
    public static function possuiParcelamento($valor) {
        $parcelamentos = Parcelamento::orderBy('valor_minimo', 'asc')->get();
        if(count($parcelamentos) > 0) {
            foreach($parcelamentos as $parcelamento) {
                if($valor > $parcelamento->valor_minimo) {
                    return true;
                }
            }
        } else {
            return false;
        }
    }

    public static function parcelasProduto($valor) {
        $parcelamentos = Parcelamento::orderBy('valor_minimo', 'desc')->get();
        if(count($parcelamentos) > 0) {
            foreach($parcelamentos as $parcelamento) {
                if($valor > $parcelamento->valor_minimo) {
                    $info['parcelas'] = $parcelamento->parcelas;
                    $info['valor_parcela'] = floatval($valor)/floatval($parcelamento->parcelas);
                    $info['valor_parcela_formatado'] = 'R$ ' . number_format($info['valor_parcela'], 2, ',', '.');
                    $info['valor_total'] = $valor;
                    $info['valor_total_formatado'] = 'R$ ' . number_format($info['valor_total'], 2, ',', '.');
                    return $info;
                }
            }
        } else {
            return false;
        }
    }

    public static function getProdutosRelevantes() {
        $produtos_relevantes = Produto::whereNotNull('desconto')->orWhere('relevante')->limit(8)->get();
        return $produtos_relevantes;
    }

    public static function produtoInfo($produto_id) {
        return Produto::find($produto_id);
    }

    // Relacionamentos
    public function descontos() {
        return $this->belongsToMany(Desconto::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    public function subcategoria() {
        return $this->belongsTo(SubCategoria::class);
    }

    public function empresa_parceira() {
        return $this->belongsTo(EmpresaParceira::class);
    }
}
