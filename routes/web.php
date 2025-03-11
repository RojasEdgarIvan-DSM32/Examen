<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\EstadoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas web para tu aplicación. Estas
| rutas son cargadas por el RouteServiceProvider y todas ellas serán
| asignadas al grupo de middleware "web". ¡Ahora crea algo grandioso!
|
*/

// Ruta de inicio (puedes cambiarla según tus necesidades)
Route::get('/', function () {
    return redirect()->route('personas.index');
});

// Rutas para Personas
Route::prefix('personas')->group(function () {
    Route::get('/', [PersonaController::class, 'index'])->name('personas.index'); // Listar personas
    Route::get('/crear', [PersonaController::class, 'create'])->name('personas.create'); // Mostrar formulario de creación
    Route::post('/', [PersonaController::class, 'store'])->name('personas.store'); // Guardar nueva persona
    Route::get('/{id}', [PersonaController::class, 'show'])->name('personas.show'); // Mostrar detalles de una persona
    Route::get('/{id}/editar', [PersonaController::class, 'edit'])->name('personas.edit'); // Mostrar formulario de edición
    Route::put('/{id}', [PersonaController::class, 'update'])->name('personas.update'); // Actualizar una persona
    Route::delete('/{id}', [PersonaController::class, 'destroy'])->name('personas.destroy'); // Eliminar una persona
});

// Rutas para Municipios
Route::prefix('municipios')->group(function () {
    Route::get('/', [MunicipioController::class, 'index'])->name('municipios.index'); // Listar municipios
    Route::get('/crear', [MunicipioController::class, 'create'])->name('municipios.create'); // Mostrar formulario de creación
    Route::post('/', [MunicipioController::class, 'store'])->name('municipios.store'); // Guardar nuevo municipio
    Route::get('/{id}', [MunicipioController::class, 'show'])->name('municipios.show'); // Mostrar detalles de un municipio
    Route::get('/{id}/editar', [MunicipioController::class, 'edit'])->name('municipios.edit'); // Mostrar formulario de edición
    Route::put('/{id}', [MunicipioController::class, 'update'])->name('municipios.update'); // Actualizar un municipio
    Route::delete('/{id}', [MunicipioController::class, 'destroy'])->name('municipios.destroy'); // Eliminar un municipio
});

// Rutas para Estados
Route::prefix('estados')->group(function () {
    Route::get('/', [EstadoController::class, 'index'])->name('estados.index'); // Listar estados
    Route::get('/crear', [EstadoController::class, 'create'])->name('estados.create'); // Mostrar formulario de creación
    Route::post('/', [EstadoController::class, 'store'])->name('estados.store'); // Guardar nuevo estado
    Route::get('/{id}', [EstadoController::class, 'show'])->name('estados.show'); // Mostrar detalles de un estado
    Route::get('/{id}/editar', [EstadoController::class, 'edit'])->name('estados.edit'); // Mostrar formulario de edición
    Route::put('/{id}', [EstadoController::class, 'update'])->name('estados.update'); // Actualizar un estado
    Route::delete('/{id}', [EstadoController::class, 'destroy'])->name('estados.destroy'); // Eliminar un estado
});
