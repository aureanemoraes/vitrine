<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnunciosController extends Controller
{
    public function create() {
        return view('pages.anuncios.create');
    }

    public function store(Request $request) {
        return redirect()->route('home');
    }
}
