<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MunicipioController extends Controller
{
    public function index()
    {
        $municipios = DB::table('municipios')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->select('municipios.*', 'estados.nombre as estado_nombre')
            ->get();

        return view('municipios.index', compact('municipios'));
    }

    public function create()
    {
        $estados = DB::table('estados')->get();
        return view('municipios.create', compact('estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cp' => 'required|string|max:10',
            'estado_id' => 'required|exists:estados,id',
        ]);

        DB::table('municipios')->insert($request->only('nombre', 'cp', 'estado_id'));

        return redirect()->route('municipios.index')->with('success', 'Municipio creado correctamente.');
    }

    public function show($id)
    {
        $municipio = DB::table('municipios')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->select('municipios.*', 'estados.nombre as estado_nombre')
            ->where('municipios.id', $id)
            ->first();

        return view('municipios.show', compact('municipio'));
    }

    public function edit($id)
    {
        $municipio = DB::table('municipios')->where('id', $id)->first();
        $estados = DB::table('estados')->get();

        return view('municipios.edit', compact('municipio', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cp' => 'required|string|max:10',
            'estado_id' => 'required|exists:estados,id',
        ]);

        DB::table('municipios')->where('id', $id)->update($request->only('nombre', 'cp', 'estado_id'));

        return redirect()->route('municipios.index')->with('success', 'Municipio actualizado correctamente.');
    }

    public function destroy($id)
    {
        DB::table('municipios')->where('id', $id)->delete();

        return redirect()->route('municipios.index')->with('success', 'Municipio eliminado correctamente.');
    }
}