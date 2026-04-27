<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api;
use App\Models\Cargo;
use Illuminate\Support\Facades\DB;

class CargoController extends Controller
{

    public function __construct()
    {        
    }

    public function index()
    {
        return view('cargo.index');
    }

    public function load()
    {
        $query = Cargo::orderByDesc('id');
     
        $cargos = $query->paginate(10);

        return view('cargo.partials.load', compact('cargos'));
    }

    public function create()
    {        
        return view('cargo.modals.create');
    }

    public function store(Request $request)
    {
        //$data = $request->only(['nombre']); ->No hay reglas (required, max, etc.), No hay errores, No hay mensajes personalizados
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
        ],
        [
            'nombre.required' => 'Debe ingresar un nombre',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres',
        ]);
        Cargo::create($data);

        return response()->json(true);

       /*DB::transaction(function () use ($request) {

            $cargo = Cargo::create($request->validated());

            $cargo->detalle()->create([
                'info' => 'algo'
            ]);

        });*/
    }

    public function edit(Request $request, Cargo $cargo)
    {
        return view('cargo.modals.edit', compact('cargo'));
    }

    public function update(Request $request, Cargo $cargo)
    {
        $data = $request->only(['nombre']);
        $cargo->update($data);

        return response()->json(true);

         /*DB::transaction(function () use ($request, $cargo) {

            $cargo->update($request->validated());

            // otra tabla
            $cargo->logs()->create([
                'accion' => 'ACTUALIZADO'
            ]);

        });*/
    }

    /*Con manejo de errores */
    /*public function update(Request $request, Cargo $cargo)
    {
        try {
            $cargo->update($request->validated());

            return response()->json(true);

        } catch (\Exception $e) {
            \Log::error($e);

            return response()->json([
                'error' => 'No se pudo actualizar'
            ], 500);
        }
    }*/


    public function show(Cargo $cargo)
    {
        return view('cargo.modals.show', compact('cargo'));
    }

    public function destroy(Cargo $cargo)
    {
        $cargo->delete();

        return response()->json(true);
    }
}
