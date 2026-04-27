<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Api;
use App\Models\Proyecto;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{

    public function __construct()
    {        
    }

    public function index()
    {
        return view('proyecto.index');
    }

    public function load()
    {
        $query = Proyecto::orderByDesc('id');
     
        $proyectos = $query->paginate(10);

            
        return view('proyecto.partials.load', compact('proyectos'));
    }

    public function create()
    {        
        return view('proyecto.modals.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
        ],
        [
            'nombre.required' => 'Debe ingresar un nombre',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres',
        ]);
        Proyecto::create($data);

        return response()->json(true);

        /*DB::transaction(function () use ($request) {

            $cargo = Cargo::create($request->validated());

            $cargo->detalle()->create([
                'info' => 'algo'
            ]);

        });*/
    }


    public function edit(Proyecto $proyecto)
    {
        return view('proyecto.modals.edit', compact('proyecto'));
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $data = $request->only(['nombre']);
        $proyecto->update($data);
        
        return response()->json(true);

        /*DB::transaction(function () use ($request, $proyecto) {

            $proyecto->update($request->validated());

            // otra tabla
            $proyecto->logs()->create([
                'accion' => 'ACTUALIZADO'
            ]);

        });*/
    }

    /*Con manejo de errores */
    /*public function update(ProyectoRequest $request, Proyecto $proyecto)
    {
        try {
            $proyecto->update($request->validated());

            return response()->json(true);

        } catch (\Exception $e) {
            \Log::error($e);

            return response()->json([
                'error' => 'No se pudo actualizar'
            ], 500);
        }
    }*/

    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        return response()->json(true);
    }
}
