<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Subcategoria;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Categorias
            DB::table('categorias')->insert([
                'nome' => 'Ortodontia',
                'descricao' => 'Produtos odontológicos',
                'relevante' => 1
            ]);

            DB::table('categorias')->insert([
                'nome' => 'Implantodontia',
            ]);

            DB::table('categorias')->insert([
                'nome' => 'Equipamentos e periféricos',
            ]);

        // Subcategorias
            DB::table('subcategorias')->insert([
                'nome' => 'Bráquete Cerâmico',
                'descricao' => 'Bráquete Cerâmico',
                'categoria_id' => 1
            ]);

            DB::table('subcategorias')->insert([
                'nome' => 'Bráquete de Policarbonato',
                'descricao' => 'Bráquete de Policarbonato',
                'categoria_id' => 1
            ]);

            DB::table('subcategorias')->insert([
                'nome' => 'Bráquete Metálico',
                'descricao' => 'Bráquete Metálico',
                'categoria_id' => 1
            ]);

            DB::table('subcategorias')->insert([
                'nome' => 'Componente p/ CAD/CAM',
                'descricao' => 'Componente p/ CAD/CAM',
                'categoria_id' => 2
            ]);

            DB::table('subcategorias')->insert([
                'nome' => 'Implante',
                'descricao' => 'Implante',
                'categoria_id' => 2
            ]);

            DB::table('subcategorias')->insert([
                'nome' => 'Componente',
                'descricao' => 'Componente',
                'categoria_id' => 2
            ]);

            DB::table('subcategorias')->insert([
                'nome' => 'Autoclave',
                'descricao' => 'Autoclave',
                'categoria_id' => 3
            ]);

            DB::table('subcategorias')->insert([
                'nome' => 'Fotopolimerizador',
                'descricao' => 'Fotopolimerizador',
                'categoria_id' => 3
            ]);

            DB::table('subcategorias')->insert([
                'nome' => 'Peças de Mão',
                'descricao' => 'Peças de Mão',
                'categoria_id' => 3
            ]);

        // Empresas parceiras
            DB::table('empresas_parceiras')->insert([
                'nome' => 'Orthometric',
                'logo' => 'teste.jpg',
                'descricao' => 'Orthometric',
                'site' => 'https://www.orthometric.com.br/',
                'relevante' => 1
            ]);

            DB::table('empresas_parceiras')->insert([
                'nome' => 'Morelli',
                'logo' => 'teste.jpg',
                'descricao' => 'Morelli',
                'site' => 'https://www.morelli.com.br/',
                'relevante' => 1
            ]);

            DB::table('empresas_parceiras')->insert([
                'nome' => 'Singular',
                'logo' => 'teste.jpg',
                'descricao' => 'Singular',
            ]);

            DB::table('empresas_parceiras')->insert([
                'nome' => 'Microdont',
                'logo' => 'teste.jpg',
                'descricao' => 'Microdont',
                'site' => 'https://microdont.com.br/'
            ]);

            DB::table('empresas_parceiras')->insert([
                'nome' => 'Saevo',
                'logo' => 'teste.jpg',
                'descricao' => 'Saevo',
            ]);
        // Produtos
            DB::table('produtos')->insert([
                'nome' => "Bráquete Cerâmico Iceram Conjunto 5x5 - Roth 0,022''",
                'valor' => 298.71,
                'disponibilidade' => 1,
                'imagens' => json_encode(['teste.jpg', 'teste.jpg', 'teste.jpg']),
                'relevante' => 1,
                'categoria_id' => 1,
                'subcategoria_id' => 1,
                'empresa_parceira_id' => 1
            ]);

            DB::table('produtos')->insert([
                'nome' => "Bráquete Policarbonato Roth Composite 0,022'' - Reposição",
                'descricao' => "Bráquete Policarbonato Roth Composite 0,022'' - Reposição",
                'valor' => 17.50,
                'disponibilidade' => 1,
                'imagens' => json_encode(['teste.jpg']),
                'relevante' => 0,
                'categoria_id' => 1,
                'subcategoria_id' => 2,
                'empresa_parceira_id' => 2
            ]);

            DB::table('produtos')->insert([
                'nome' => "Kit Bráquete de Aço Advanced Series Roth 0,022 100 Casos + Almofada Dentásticos",
                'valor' => 1.899,
                'disponibilidade' => 1,
                'imagens' => json_encode(['teste.jpg', 'teste.jpg']),
                'relevante' => 1,
                'categoria_id' => 1,
                'desconto' => 20,
                'subcategoria_id' => 3,
                'empresa_parceira_id' => 2
            ]);

            DB::table('produtos')->insert([
                'nome' => "Base Tibase4 p/ Cerec",
                'descricao' => "Base Tibase4 p/ Cerec",
                'valor' => 54.07,
                'disponibilidade' => 1,
                'imagens' => json_encode(['teste.jpg']),
                'relevante' => 1,
                'categoria_id' => 2,
                'subcategoria_id' => 4,
                'empresa_parceira_id' => 3
            ]);

            DB::table('produtos')->insert([
                'nome' => "Mini Pilar HE",
                'descricao' => "Mini Pilar HE",
                'valor' => 44.29,
                'disponibilidade' => 1,
                'imagens' => json_encode(['teste.jpg', 'teste.jpg']),
                'relevante' => 1,
                'desconto' => 5,
                'categoria_id' => 2,
                'subcategoria_id' => 5,
                'empresa_parceira_id' => 3
            ]);
        // Descontos
            DB::table('descontos')->insert([
                'nome' => 'Dinheiro',
                'forma_pagamento' => 1,
                'porcentagem' => 10
            ]);

            DB::table('descontos')->insert([
                'nome' => 'Débito',
                'forma_pagamento' => 2,
                'porcentagem' => 10
            ]);

            DB::table('descontos')->insert([
                'nome' => 'Crédito à vista',
                'forma_pagamento' => 3,
                'porcentagem' => 10
            ]);

            DB::table('descontos')->insert([
                'nome' => 'Transferência bancária',
                'forma_pagamento' => 5,
                'porcentagem' => 10
            ]);

            DB::table('descontos')->insert([
                'nome' => 'Pix',
                'forma_pagamento' => 6,
                'porcentagem' => 10
            ]);

            DB::table('descontos')->insert([
                'nome' => 'Crédito parcelado',
                'forma_pagamento' => 4,
                'porcentagem' => 5
            ]);

            DB::table('descontos')->insert([
                'nome' => 'Acadêmico',
                'forma_pagamento' => 7,
                'porcentagem' => 10
            ]);
        // Parcelamentos
            DB::table('parcelamentos')->insert([
                'nome' => 'valor acima de R$100,00',
                'parcelas' => 2,
                'valor_minimo' => 100
            ]);
            DB::table('parcelamentos')->insert([
                'nome' => 'valor acima de R$200,00',
                'parcelas' => 3,
                'valor_minimo' => 200
            ]);
            DB::table('parcelamentos')->insert([
                'nome' => 'valor acima de R$300,00',
                'parcelas' => 4,
                'valor_minimo' => 300
            ]);
            DB::table('parcelamentos')->insert([
                'nome' => 'valor acima de R$400,00',
                'parcelas' => 5,
                'valor_minimo' => 400
            ]);
            DB::table('parcelamentos')->insert([
                'nome' => 'valor acima de R$500,00',
                'parcelas' => 6,
                'valor_minimo' => 500
            ]);
            DB::table('parcelamentos')->insert([
                'nome' => 'valor acima de R$600,00',
                'parcelas' => 7,
                'valor_minimo' => 600
            ]);
            DB::table('parcelamentos')->insert([
                'nome' => 'valor acima de R$700,00',
                'parcelas' => 8,
                'valor_minimo' => 700
            ]);
            DB::table('parcelamentos')->insert([
                'nome' => 'valor acima de R$800,00',
                'parcelas' => 9,
                'valor_minimo' => 800
            ]);
            DB::table('parcelamentos')->insert([
                'nome' => 'valor acima de R$900,00',
                'parcelas' => 10,
                'valor_minimo' => 900
            ]);
            DB::table('parcelamentos')->insert([
                'nome' => 'valor acima de R$1000,00',
                'parcelas' => 12,
                'valor_minimo' => 1000
            ]);
    }
}
