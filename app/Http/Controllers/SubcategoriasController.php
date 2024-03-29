<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubcategoriaCollection;
use App\Http\Resources\SubcategoriaResource;
use App\Models\Subcategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubcategoriasController extends Controller
{
    public function index()
    {
        return Subcategoria::paginate();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
            'categoria_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 406);
        }

        return Subcategoria::create($request->all())->toJson();
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
            'categoria_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 406);
        }

        $subcategoria = SubCategoria::findOrFail($id);
        $subcategoria->fill($request->all());
        $subcategoria->save();

        return SubCategoria::findOrFail($id)->fill($request->all())->toJson();
    }

    public function destroy($id)
    {
        $subcategoria = SubCategoria::findOrFail($id);

        if(count($subcategoria->produtos) > 0) {
            return response()->json(['data' => 'Item can not be deleted.'], 405);
        } else {
            $subcategoria->delete();
            return response()->json(['data' => 'Item deleted.'], 200);
        }

    }

    public function find($categoria_id)
    {
        return response()->json([
            'data' => SubCategoria::select('id', 'nome AS text')->where('categoria_id', $categoria_id)->get()
        ],
        200);
    }
}
