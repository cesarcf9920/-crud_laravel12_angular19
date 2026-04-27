<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TrabajadorRequest;
use App\Models\Trabajador;
use App\Models\Cargo;
use App\Models\Proyecto;
use App\Models\TipoCambio;
use App\Models\TipoPago;
use Illuminate\Support\Facades\DB;

class TrabajadorController extends Controller
{

    public function __construct()
    {
    }

    public function index(Request $request)
    {   
        $perPage = 10;
        $trabajadores = Trabajador::with(['cargo', 'proyecto'])
            ->activo()
            ->search($request->search)
            ->cargo($request->cargo_id)
            ->estado($request->estado)
            ->orderByDesc('id') 
            ->whereNull('deleted_at')
            ->paginate($perPage);

        return response()->json($trabajadores);
    }

    public function store(TrabajadorRequest $request)
    {
        $trabajador = Trabajador::create($request->validated());

        return response()->json($trabajador, 201);
    }

    public function update(TrabajadorRequest $request, Trabajador $trabajador)
    {
        $trabajador->update($request->validated());
        
        return response()->json($trabajador);
    }

    public function show($id)
    {
        $trabajador = Trabajador::with(['cargo', 'proyecto', 'tipo_pago', 'tipo_cambio'])->findOrFail($id);

        return response()->json($trabajador);
    }

    public function destroy(Trabajador $trabajador)
    {
        $trabajador->delete();

        return response()->json(true);
    }

    // ========================
    // COMBOS
    // ========================

    public function proyectos()
    {
        return response()->json(
            Proyecto::orderBy('nombre')->get()
        );
    }

    public function cargos()
    {
        return response()->json(
            Cargo::orderBy('nombre')->get()
        );
    }

        public function tiposPagos()
    {
        return response()->json(
            TipoPago::orderBy('nombre')->get()
        );
    }

    public function tiposCambios(Request $request)
    {
        return response()->json(
            TipoCambio::where('tipo_pago_id', $request->tipo_pago_id)
                ->orderBy('nombre')
                ->get()
        );
    }

}
