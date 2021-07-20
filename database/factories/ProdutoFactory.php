<?php

namespace Database\Factories;

use App\Models\Produto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProdutoFactory extends Factory
{
    protected $model = Produto::class;

    public function definition()
    {
        return [
            'nome' => Str::random(10),
            'descricao' => Str::random(30),
            'valor' => Str::randomFloat(2),
            'disponibilidade' => Str::boolean(),
            'imagens' => ['teste.jpg'],
            'desconto' => Str::randomFloat(2)
        ];
    }
}
