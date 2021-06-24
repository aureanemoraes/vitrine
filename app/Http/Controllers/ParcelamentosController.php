<?php

namespace App\Http\Controllers;

use App\Models\Parcelamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParcelamentosController extends Controller
{
    public function index()
    {
        return view('pages.parcelamentos.index')->with(['parcelamentos' => Parcelamento::paginate()]);
    }

    public function store(Request $request)
    {
        $this->validaDados($request);
        Parcelamento::create($request->all())->toJson();
        return;
    }

    public function show($id)
    {
        return Parcelamento::findOrFail($id)->toJson();
    }

    public function update(Request $request, $id)
    {
        $this->validaDados($request);

        $parcelamento = Parcelamento::findOrFail($id);
        $parcelamento->fill($request->all());
        $parcelamento->save();

        return Parcelamento::findOrFail($id)->fill($request->all())->toJson();
    }

    public function destroy($id)
    {
        Parcelamento::findOrFail($id)->delete();

        return response()->json(['data' => 'Item deleted.'], 200);
    }

    public function validaDados($request) {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'parcelas' => 'required|integer',
            'valor_minimo' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 406);
        };
    }
}
