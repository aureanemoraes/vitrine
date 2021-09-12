<?php

namespace App\Http\Controllers;

use App\Models\EmpresaParceira;
use App\Models\Produto;
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
        if($this->validaDados($request)) return $this->validaDados($request);

        $nomeImagem = time().'.'.$request->imagem->extension();
        $request->imagem->move(public_path('logos-empresas'), $nomeImagem);
        $dados = $request->all();
        $dados['logo'] = $nomeImagem;
        $empresa_parceira = EmpresaParceira::create($dados);

        return view('pages.empresas_parceiras.show')->with([
            'empresa_parceira' => $empresa_parceira,
            'produtos' => Produto::where('empresa_parceira_id', $empresa_parceira->id)->paginate()
        ]);
    }

    public function show($id)
    {
        $produtos = Produto::where('empresa_parceira_id', $id)
            ->orderBy('desconto', 'desc')
            ->orderBy('relevante', 'desc')
            ->orderBy('valor', 'asc')
            ->orderBy('disponibilidade', 'desc')
            ->paginate();

        return view('pages.empresas_parceiras.show')->with([
            'empresa_parceira' => EmpresaParceira::findOrFail($id),
            'produtos' => $produtos
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
        if($this->validaDados($request)) return $this->validaDados($request);

        $empresa_parceira = EmpresaParceira::findOrFail($id);
        $dados = $request->all();

        if(isset($request->imagem)) {
            if(File::exists(public_path("logos-empresas/$empresa_parceira->logo"))){
                File::delete(public_path("logos-empresas/$empresa_parceira->logo"));
            }
            $nomeImagem = time().'.'.$request->imagem->extension();
            $request->imagem->move(public_path('logos-empresas'), $nomeImagem);
            $dados['logo'] = $nomeImagem;
        }

        $empresa_parceira->fill($dados);
        $empresa_parceira->save();

        return view('pages.empresas_parceiras.show')->with([
            'empresa_parceira' => $empresa_parceira,
            'produtos' => Produto::where('empresa_parceira_id', $empresa_parceira->id)->paginate()
        ]);
    }

    public function destroy($id)
    {
        $empresa_parceira = EmpresaParceira::findOrFail($id);
        if(File::exists(public_path("logos-empresas/$empresa_parceira->logo"))){
            File::delete(public_path("logos-empresas/$empresa_parceira->logo"));
        }
        $empresa_parceira->delete();

        return true;
    }

    public function validaDados($request) {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validação de imagem
            'descricao' => 'nullable|string',
            'site' => 'nullable|string',
            'relevante' => [
                'nullable',
                function ($attribute, $value, $fail) {
                    $total_ep_relevantes = EmpresaParceira::where('relevante', 1)->count();
                    if($value == 1 && $total_ep_relevantes <= 8) {
                        return true;
                    } else {
                        $fail('Quantidade máxima de categorias relevantes antigida. (Limite: 8)');
                    }
                },
            ]
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
    }
}
