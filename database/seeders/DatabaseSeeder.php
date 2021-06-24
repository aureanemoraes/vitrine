<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Categoria::factory(3)
            ->has(Subcategoria::factory()->count(20))
            ->create();


    }
}
