<?php

namespace App\Http\Controllers;

use App\Models\Desconto;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        return view('pages.produtos.index')->with(['produtos' => Produto::paginate()]);
    }

    public function create() {
        return view('pages.produtos.create')->with([
            'descontos' => Desconto::all()
        ]);
    }
}
