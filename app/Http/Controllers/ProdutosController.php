<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{
    public function index()
    {
        return view('pages.produtos.index')->with(['produtos' => Produto::paginate()]);
    }
}
