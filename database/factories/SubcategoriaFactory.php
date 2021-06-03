<?php

namespace Database\Factories;

use App\Models\Subcategoria;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubcategoriaFactory extends Factory
{
    protected $model = Subcategoria::class;

    public function definition()
    {
        return [
            'nome' => Str::random(10),
            'descricao' => Str::random(30),
        ];
    }
}
