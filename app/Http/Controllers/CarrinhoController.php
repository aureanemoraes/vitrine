<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CarrinhoController extends Controller
{
    public function index() {
        if(isset($_COOKIE['produtos_carrinho'])) {
            $produtos_carrinho =  (array) json_decode($_COOKIE['produtos_carrinho']);
            unset($_COOKIE['produtos_carrinho']);

            session(['produtos' => $produtos_carrinho]);
            session()->save();
            unset($produtos_carrinho);
        }

        return view('pages.carrinho.index');
    }

    public function adicionar_item(Request $request) {
        $quantidade = intval($request->quantidade);
        $produto_id = $request->produto_id;

        if ($request->session()->has('produtos')) {
            $produtos_carrinho = session('produtos');
            if(Arr::exists($produtos_carrinho, $produto_id)) {
                $quantidade_atual = Arr::get($produtos_carrinho, $produto_id);
                $nova_quantidade = $quantidade + $quantidade_atual;
                Arr::set($produtos_carrinho, $produto_id, $nova_quantidade);
            } else {
                Arr::set($produtos_carrinho, $produto_id, $quantidade);
            }
            session(['produtos' => $produtos_carrinho]);
            session()->save();
        } else {
            Arr::set($produtos_carrinho, $produto_id, $quantidade);
            session(['produtos' => $produtos_carrinho]);
            session()->save();
        }

        return redirect(url()->previous());
    }

    public function alterar_quantidade(Request $request) {
        $produtos = $request->produtos;

        session(['produtos' => $produtos]);
        session()->save();


        return redirect()->route('carrinho.index');
    }

    public function remover_item ($produto_id) {
        $produtos_carrinho = session('produtos');
        unset($produtos_carrinho[$produto_id]);
        session(['produtos' => $produtos_carrinho]);
        session()->save();
        return redirect()->route('carrinho.index');
    }

    public function limpar_carrinho() {
        session()->flush();
        return redirect('/');
    }
}
