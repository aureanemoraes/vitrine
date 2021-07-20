<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImagensController extends Controller
{
    public function destroy_imagens_produtos($produto_id, $nome_imagem) {
        $produto = Produto::findOrFail($produto_id);
        if(in_array($nome_imagem, $produto->imagens)) {
            $imagens = $produto->imagens;
            $index = array_search($nome_imagem, $imagens);
            unset($imagens[$index]);
            $imagens = array_values($imagens);
            $produto->imagens = $imagens;
            $produto->save();
        }

        if(File::exists(public_path("produtos-imagens/$nome_imagem"))){
            File::delete(public_path("produtos-imagens/$nome_imagem"));
        }

        return true;
    }
}
