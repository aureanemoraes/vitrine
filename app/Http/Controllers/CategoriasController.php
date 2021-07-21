<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Rules\Max8Categorias;
use Illuminate\Support\Facades\Validator;

class CategoriasController extends Controller
{
    public function index()
    {
        return view('pages.categorias.index')->with(['categorias' => Categoria::paginate()]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        if($this->validaDados($request)) return $this->validaDados($request);

        return Categoria::create($request->all())->toJson();
    }

    public function show($id)
    {
        $categorias = Categoria::select('id', 'nome')->get();
        $categoria = Categoria::findOrFail($id);
        $subcategorias = $categoria->subcategorias()->paginate();

        return view('pages.categorias.show')
                ->with([
                    'subcategorias' => $subcategorias,
                    'categoria' => $categoria,
                    'categorias' => $categorias
                ]);
    }

    public function update(Request $request, $id)
    {
        if($this->validaDados($request)) return $this->validaDados($request);

        $categoria = Categoria::findOrFail($id);
        $categoria->fill($request->all());
        $categoria->save();

        return Categoria::findOrFail($id)->fill($request->all())->toJson();
    }

    public function destroy($id)
    {
        Categoria::findOrFail($id)->delete();

        return response()->json(['data' => 'Item deleted.'], 200);
    }

    public function validaDados($request) {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'descricao' => 'nullable',
            'relevante' => [
            'nullable',
            function ($attribute, $value, $fail) {
                $total_categorias_relevantes = Categoria::where('relevante', true)->count();
                if($value == 1 && $total_categorias_relevantes <= 8) {
                    return true;
                } else {
                    $fail('Quantidade máxima de categorias relevantes antigida. (Limite: 8)');
                }
            },
            ]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 406);
        };
    }
}
