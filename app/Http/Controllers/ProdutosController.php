<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Desconto;
use App\Models\EmpresaParceira;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produto::orderBy('desconto', 'desc')
        ->orderBy('relevante', 'desc')
        ->orderBy('valor', 'asc')
        ->orderBy('disponibilidade', 'desc')
        ->paginate();

        return view('pages.produtos.index')->with([
            'produtos' => $produtos,
            'filtro_promocao' => null,
            'filtro_categorias' => null,
            'filtro_subcategorias' => null,
            'filtro_empresas_parceiras' => null
        ]);
    }

    public function index_promocoes()
    {
        $produtos = Produto::where('desconto', '!=', null)->paginate();

        return view('pages.produtos.index_promocoes')->with([
            'produtos' => $produtos,
        ]);
    }

    public function create() {
        $categorias = Categoria::select('id', 'nome')->get();
        $empresas_parceiras = EmpresaParceira::select('id', 'nome')->get();

        return view('pages.produtos.create')->with([
            'categorias' => $categorias,
            'empresas_parceiras' => $empresas_parceiras
        ]);
    }

    public function store(Request $request)
    {
        if($this->validaDados($request)) return $this->validaDados($request);
        $dados = $request->all();

        if(isset($request->imagens) && count($request->imagens) > 0) {
            if($request->hasFile('imagens')) {
                foreach($request->imagens as $imagem) {
                    $nomeImagem = $imagem->getClientOriginalName().'-'.time().'.'.$imagem->getClientOriginalExtension();
                    $imagem->move(public_path('produtos-imagens'), $nomeImagem);
                    $dados_imagens[] = $nomeImagem;
                }
            }
        $dados['imagens'] = $dados_imagens;

        }

        return view('pages.produtos.show')->with([
            'produto' => Produto::create($dados)
        ]);

    }

    public function show($id) {
        return view('pages.produtos.show')->with([
            'produto' => Produto::findOrFail($id)
        ]);
    }

    public function edit($id) {
        $categorias = Categoria::select('id', 'nome')->get();

        return view('pages.produtos.edit')->with([
            'produto' => Produto::findOrFail($id),
            'categorias' => $categorias

        ]);
    }

    public function update($id, Request $request)
    {
        $produto = Produto::findOrFail($id);

        if($this->validaDados($request)) return $this->validaDados($request);
        $dados = $request->all();

        if(!isset($request->desconto)) {
            $dados['desconto'] = null;
        }


        if(isset($request->imagens) && count($request->imagens) > 0) {
            $dados_imagens = $produto->imagens;
            if($request->hasFile('imagens')) {
                foreach($request->imagens as $imagem) {
                    $nomeImagem = $imagem->getClientOriginalName().'-'.time().'.'.$imagem->getClientOriginalExtension();
                    $imagem->move(public_path('produtos-imagens'), $nomeImagem);
                    $dados_imagens[] = $nomeImagem;
                }
            }
            $dados['imagens'] = $dados_imagens;
        }


        if(!isset($dados['disponibilidade'])) $dados['disponibilidade'] = 0;
        if(!isset($dados['relevante'])) $dados['relevante'] = 0;


        $produto->fill($dados)->save();


        return view('pages.produtos.show')->with([
            'produto' => $produto
        ]);

    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);

        if(isset($produto->imagens) && count($produto->imagens) > 0) {
            foreach($produto->imagens as $imagem) {
                if(File::exists(public_path("produtos-imagens/$imagem"))){
                    File::delete(public_path("produtos-imagens/$imagem"));
                }
            }
        }

        $produto->delete();

        return true;
    }

    public function validaDados($request) {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
            'valor' => 'required|numeric',
            'disponibilidade' => 'nullable|integer',
            'imagens.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validação de imagem
            'desconto' => 'nullable|numeric',
            'relevante' => 'nullable|integer',
            'categoria_id' => 'required|integer',
            'subcategoria_id' => 'required|integer',
            'empresa_parceira_id' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return redirect(url()->previous())
                        ->withErrors($validator)
                        ->withInput();
        }
    }

    // Filtros
    public function encontrar_por_pesquisa(Request $request) {
        $nome = $request->query('nome');
        if(isset($nome)) {
            $resultados = Produto::where('nome', 'like', "%$nome%")
                ->orderBy('desconto', 'desc')
                ->orderBy('relevante', 'desc')
                ->orderBy('valor', 'asc')
                ->orderBy('disponibilidade', 'desc')
                ->paginate();
        }

        $url_origem = url()->previous();

        return view('pages.produtos.index')->with([
            'produtos' => $resultados,
            'filtro_promocao' => null,
            'filtro_categorias' => null,
            'filtro_subcategorias' => null,
            'filtro_empresas_parceiras' => null
        ]);
    }

    public function encontrar_por_filtro(Request $request) {
        $promocao = $request->query('promocao');
        $categorias = $request->query('categorias');
        $subcategorias = $request->query('subcategorias');
        $empresas_parceiras = $request->query('empresas_parceiras');
        $ordenacao =  $request->query('ordenacao');

        if(isset($promocao)) {
            $resultados = Produto::where('desconto', '!=', null)->where('desconto', '>', 0);
        }

        if(isset($categorias) && count($categorias) > 0) {
            if(isset($resultados))
                $resultados = $resultados->whereIn('categoria_id', $categorias);
            else
                $resultados = Produto::whereIn('categoria_id', $categorias);
        }

        if(isset($subcategorias) && count($subcategorias) > 0) {
            if(isset($resultados))
                $resultados = $resultados->whereIn('subcategoria_id', $subcategorias);
            else
                $resultados = Produto::whereIn('subcategoria_id', $subcategorias);
        }

        if(isset($empresas_parceiras) && count($empresas_parceiras) > 0) {
            if(isset($resultados))
                $resultados = $resultados->whereIn('empresa_parceira_id', $empresas_parceiras);
            else
                $resultados = Produto::whereIn('empresa_parceira_id', $empresas_parceiras);
        }

        if(isset($ordenacao)) {
            if(isset($resultados)) {
                switch($ordenacao) {
                    case 1: // Relevantes
                        $resultados = $resultados->orderBy('relevante', 'desc');
                        break;
                    case 2: // A-Z
                        $resultados = $resultados->orderBy('nome', 'asc');
                        break;
                    case 3: // Z-A
                        $resultados = $resultados->orderBy('nome', 'desc');
                        break;
                    case 4: // Maior preço - Menor preço
                        $resultados = $resultados->orderBy('valor', 'desc');
                        break;
                    case 5: // Menor preço - Maior preço
                        $resultados = $resultados->orderBy('valor', 'asc');
                        break;
                }

                $resultados = $resultados->orderBy('desconto', 'desc')
                    ->orderBy('valor', 'asc')
                    ->orderBy('disponibilidade', 'desc')
                    ->paginate();
            }
        } else {
            $resultados = $resultados->orderBy('desconto', 'desc')
                ->orderBy('relevante', 'desc')
                ->orderBy('valor', 'asc')
                ->orderBy('disponibilidade', 'desc')
                ->paginate();
        }

        return view('pages.produtos.index')->with([
            'produtos' => $resultados,
            'filtro_promocao' => $promocao,
            'filtro_categorias' => $categorias,
            'filtro_subcategorias' => $subcategorias,
            'filtro_empresas_parceiras' => $empresas_parceiras
        ]);
    }

    public function ordenacao($tipo) {
        $rota_atual = url()->previous() . "&ordenacao=$tipo";
        return redirect($rota_atual);

    }
}
