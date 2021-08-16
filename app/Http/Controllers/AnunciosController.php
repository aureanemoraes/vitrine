<?php

namespace App\Http\Controllers;

use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class AnunciosController extends Controller
{
    public function index() {
        return view('pages.anuncios.index')->with([
            'anuncios' => Anuncio::all()
        ]);
    }

    public function create() {
        return view('pages.anuncios.create');
    }

    public function store(Request $request)
    {
        if($this->validaDados($request)) return $this->validaDados($request);
        $dados = $request->all();

        if(isset($request->imagem)) {
            if($request->hasFile('imagem')) {
                $imagem = $request->file('imagem');
                $nomeImagem = $imagem->getClientOriginalName().'-'.time().'.'.$imagem->getClientOriginalExtension();
                $imagem->move(public_path('anuncios-imagens'), $nomeImagem);
                $dados['imagem'] = $nomeImagem;
            }
        }

        Anuncio::create($dados);

        return view('pages.anuncios.index')->with([
            'anuncios' => Anuncio::all()
        ]);

    }

    public function edit($id)
    {
        return view('pages.anuncios.edit')->with([
            'anuncio' => Anuncio::findOrFail($id)
        ]);
    }

    public function destroy($id)
    {
        $anuncio = Anuncio::findOrFail($id);
        if(File::exists(public_path("anuncios-imagens/$anuncio->imagem"))){
            File::delete(public_path("anuncios-imagens/$anuncio->imagem"));
        }
        $anuncio->delete();

        return true;
    }

    public function validaDados($request) {
        $validator = Validator::make($request->all(), [
            'nome' => 'nullable|string',
            'descricao' => 'nullable|string',
            'imagem' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validação de imagem
            'ativo' => 'nullable|integer',
            'url' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
    }
}
