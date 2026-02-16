<?php

namespace App\Http\Controllers;

use App\Models\RegistroUso;
use App\Models\Licencia;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsoController extends Controller
{
    public function index(Request $request): View
    {
        $query = RegistroUso::with(['licencia.cliente', 'licencia.producto']);

        if ($request->filled('busqueda')) {
            $busqueda = $request->input('busqueda');
            $query->where(function($q) use ($busqueda) {
                $q->where('usuario_nombre', 'like', "%{$busqueda}%")
                  ->orWhere('usuario_email', 'like', "%{$busqueda}%")
                  ->orWhere('dispositivo', 'like', "%{$busqueda}%")
                  ->orWhereHas('licencia.cliente', function($qc) use ($busqueda) {
                      $qc->where('nombre', 'like', "%{$busqueda}%");
                  })
                  ->orWhereHas('licencia.producto', function($qp) use ($busqueda) {
                      $qp->where('nombre', 'like', "%{$busqueda}%");
                  });
            });
        }

        if ($request->filled('accion') && $request->input('accion') !== 'todas') {
            $query->where('accion', $request->input('accion'));
        }

        if ($request->filled('estado') && $request->input('estado') !== 'todos') {
            $query->where('estado', $request->input('estado'));
        }

        $registros = $query->orderBy('fecha_acceso', 'desc')->paginate(20);
        
        $acciones = RegistroUso::getAcciones();
        $estados = RegistroUso::getEstados();

        // Estadísticas
        $stats = [
            'total_registros' => RegistroUso::count(),
            'activos_hoy' => RegistroUso::hoy()->porAccion('login')->count(),
            'sesiones_activas' => RegistroUso::where('accion', 'login')->where('estado', 'activo')->count() - 
                                  RegistroUso::where('accion', 'logout')->count(),
            'bloqueos' => RegistroUso::porAccion('bloqueo')->count()
        ];

        // Uso por licencia
        $usoPorLicencia = Licencia::activas()
            ->withCount('registrosUso')
            ->with(['cliente', 'producto'])
            ->get()
            ->map(function($licencia) {
                $ultimoAcceso = $licencia->registrosUso()->orderBy('fecha_acceso', 'desc')->first();
                return [
                    'licencia' => $licencia,
                    'total_accesos' => $licencia->registros_uso_count,
                    'usuarios_activos' => $licencia->registrosUso()->distinct('usuario_email')->count(),
                    'ultimo_acceso' => $ultimoAcceso?->fecha_acceso
                ];
            });

        return view('uso.index', compact('registros', 'acciones', 'estados', 'stats', 'usoPorLicencia'));
    }
}
