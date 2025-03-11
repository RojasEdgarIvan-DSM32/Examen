<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = DB::table('personas')
            ->join('municipios', 'personas.municipio_id', '=', 'municipios.id')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->select('personas.*', 'municipios.nombre as municipio_nombre', 'estados.nombre as estado_nombre')
            ->get();

        return view('personas.index', compact('personas'));
    }

    public function create()
    {
        $municipios = DB::table('municipios')->get();
        return view('personas.create', compact('municipios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'municipio_id' => 'required|exists:municipios,id',
        ]);

        $municipio = DB::table('municipios')->where('id', $request->municipio_id)->first();

        if (!$municipio) {
            return redirect()->route('personas.create')->with('error', 'Municipio no encontrado.');
        }

        $data = $request->only('nombre', 'direccion', 'municipio_id');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('personas', 'public');
        } else {
            $data['foto'] = null;
        }

        DB::table('personas')->insert($data);

        return redirect()->route('personas.index')->with('success', 'Persona creada correctamente.');
    }

    public function show($id)
    {
        $persona = DB::table('personas')
            ->join('municipios', 'personas.municipio_id', '=', 'municipios.id')
            ->join('estados', 'municipios.estado_id', '=', 'estados.id')
            ->select(
                'personas.*',
                'municipios.nombre as municipio_nombre', // Selecciona el nombre del municipio
                'estados.nombre as estado_nombre' // Selecciona el nombre del estado
            )
            ->where('personas.id', $id)
            ->first();
    
        if (!$persona) {
            return redirect()->route('personas.index')->with('error', 'Persona no encontrada.');
        }
    
        return view('personas.show', compact('persona'));
    }

    public function edit($id)
    {
        $persona = DB::table('personas')->where('id', $id)->first();

        if (!$persona) {
            return redirect()->route('personas.index')->with('error', 'Persona no encontrada.');
        }

        $municipios = DB::table('municipios')->get();

        return view('personas.edit', compact('persona', 'municipios'));
    }

    public function update(Request $request, $id)
    {
        $persona = DB::table('personas')->where('id', $id)->first();

        if (!$persona) {
            return redirect()->route('personas.index')->with('error', 'Persona no encontrada.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'municipio_id' => 'required|exists:municipios,id',
        ]);

        $data = $request->only('nombre', 'direccion', 'municipio_id');

        if ($request->hasFile('foto')) {
            // Eliminar la foto anterior si existe
            if ($persona->foto) {
                Storage::disk('public')->delete($persona->foto);
            }

            $data['foto'] = $request->file('foto')->store('personas', 'public');
        } else {
            // Mantener la foto anterior si no se sube una nueva
            $data['foto'] = $persona->foto;
        }

        DB::table('personas')->where('id', $id)->update($data);

        return redirect()->route('personas.index')->with('success', 'Persona actualizada correctamente.');
    }

    public function destroy($id)
    {
        $persona = DB::table('personas')->where('id', $id)->first();

        if (!$persona) {
            return redirect()->route('personas.index')->with('error', 'Persona no encontrada.');
        }

        if ($persona->foto) {
            Storage::disk('public')->delete($persona->foto);
        }

        DB::table('personas')->where('id', $id)->delete();

        return redirect()->route('personas.index')->with('success', 'Persona eliminada correctamente.');
    }
}