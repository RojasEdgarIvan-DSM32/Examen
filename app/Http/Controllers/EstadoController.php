<?php
// app/Http/Controllers/EstadoController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadoController extends Controller
{
    public function index()
    {
        $estados = DB::table('estados')->get();
        return view('estados.index', compact('estados'));
    }

    public function create()
    {
        return view('estados.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        DB::table('estados')->insert($request->only('nombre'));

        return redirect()->route('estados.index')->with('success', 'Estado creado correctamente.');
    }

    public function show($id)
    {
        $estado = DB::table('estados')->where('id', $id)->first();
        return view('estados.show', compact('estado'));
    }

    public function edit($id)
    {
        $estado = DB::table('estados')->where('id', $id)->first();
        return view('estados.edit', compact('estado'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        DB::table('estados')->where('id', $id)->update($request->only('nombre'));

        return redirect()->route('estados.index')->with('success', 'Estado actualizado correctamente.');
    }

    public function destroy($id)
    {
        DB::table('estados')->where('id', $id)->delete();

        return redirect()->route('estados.index')->with('success', 'Estado eliminado correctamente.');
    }
}