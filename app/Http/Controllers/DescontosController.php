<?php

namespace App\Http\Controllers;

use App\Models\Desconto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DescontosController extends Controller
{
    public function index()
    {
        return view('pages.descontos.index')->with(['descontos' => Desconto::paginate()]);
    }

    public function store(Request $request)
    {
        if($this->validaDados($request)) return $this->validaDados($request);

        Desconto::create($request->all())->toJson();
        return;
    }

    public function show($id)
    {
        return Desconto::findOrFail($id)->toJson();
    }

    public function update(Request $request, $id)
    {
        if($this->validaDados($request)) return $this->validaDados($request);

        $desconto = Desconto::findOrFail($id);
        $desconto->fill($request->all());
        $desconto->save();

        return Desconto::findOrFail($id)->fill($request->all())->toJson();
    }

    public function destroy($id)
    {
        Desconto::findOrFail($id)->delete();

        return response()->json(['data' => 'Item deleted.'], 200);
    }

    public function validaDados($request) {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'forma_pagamento' => 'required|integer',
            'porcentagem' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 406);
        };
    }
}
