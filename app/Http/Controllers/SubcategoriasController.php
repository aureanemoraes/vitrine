<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubcategoriaCollection;
use App\Models\Subcategoria;
use Illuminate\Http\Request;

class SubcategoriasController extends Controller
{
    public function index()
    {
        return new SubcategoriaCollection(Subcategoria::paginate());
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
