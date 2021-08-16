<?php

namespace App\Http\Controllers;

use App\Models\Entidade;
use Illuminate\Http\Request;

class EntidadesController extends Controller
{
    public function formulario()
    {
        return view('pages.entidades.form')->with([
            'entidade' => Entidade::all()
        ]);
    }

    public function enviar_formulario(Request $request)
    {
        return view('pages.entidades.show')->with([
            'entidade' => Entidade::create($request->all())
        ]);
    }

    public function atualizar_formulario($id, Request $request)
    {
        $entidade = Entidade::find($id);
        $entidade->fill($request->all());
        $entidade->save();

        return view('pages.entidades.show')->with([
            'entidade' => $entidade
        ]);
    }

    public function show($id)
    {
        return view('pages.entidades.show')->with([
            'entidade' => Entidade::findOrFail($id)
        ]);
    }
}
