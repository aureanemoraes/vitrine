<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
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
        $this->validaDados($request);

        return Categoria::create($request->all())->toJson();
    }

    public function show($id)
    {
        $categorias = Categoria::select('id', 'nome')->get();
        return view('pages.categorias.show-subcategorias')
                ->with([
                    'categoria' => Categoria::findOrFail($id),
                    'categorias' => $categorias
                ]);
    }

    public function update(Request $request, $id)
    {
        $this->validaDados($request);

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
            'descricao' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 406);
        };
    }
}
