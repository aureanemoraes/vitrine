<?php

namespace App\Http\Controllers;

use App\Models\EmpresaParceira;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class EmpresasParceirasController extends Controller
{
    public function index()
    {
        return view('pages.empresas_parceiras.index')->with([
            'empresas_parceiras' => EmpresaParceira::paginate()
        ]);
    }

    public function create()
    {
        return view('pages.empresas_parceiras.create');
    }

    public function store(Request $request)
    {
        $this->validaDados($request);

        $nomeImagem = time().'.'.$request->imagem->extension();
        $request->imagem->move(public_path('logos'), $nomeImagem);
        $dados = $request->all();
        $dados['logo'] = $nomeImagem;

        return view('pages.empresas_parceiras.show')->with([
            'empresa_parceira' => EmpresaParceira::create($dados)
        ]);
    }

    public function show($id)
    {
        return view('pages.empresas_parceiras.show')->with([
            'empresa_parceira' => EmpresaParceira::findOrFail($id)
        ]);
    }

    public function edit($id)
    {
        return view('pages.empresas_parceiras.edit')->with([
            'empresa_parceira' => EmpresaParceira::findOrFail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->validaDados($request);
        $empresa_parceira = EmpresaParceira::findOrFail($id);
        $dados = $request->all();

        if(isset($request->imagem)) {
            if(File::exists(public_path("logos/$empresa_parceira->logo"))){
                File::delete(public_path("logos/$empresa_parceira->logo"));
            }
            $nomeImagem = time().'.'.$request->imagem->extension();
            $request->imagem->move(public_path('logos'), $nomeImagem);
            $dados['logo'] = $nomeImagem;
        }

        $empresa_parceira->fill($dados);
        $empresa_parceira->save();

        return view('pages.empresas_parceiras.show')->with([
            'empresa_parceira' => $empresa_parceira
        ]);
    }

    public function destroy($id)
    {
        $empresa_parceira = EmpresaParceira::findOrFail($id);
        if(File::exists(public_path("logos/$empresa_parceira->logo"))){
            File::delete(public_path("logos/$empresa_parceira->logo"));
        }
        $empresa_parceira->delete();

        return true;
    }

    public function validaDados($request) {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validação de imagem
            'descricao' => 'nullable|string',
            'site' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 406);
        };
    }
}
