<?php

namespace App\Http\Controllers;

use App\Models\ListaLectura;
use App\Models\Libro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultaAvanzadaController extends Controller
{
    // Eager loading con filtrado en la tabla Pivote
    public function librosLeidos()
    {
        $usuarios = User::with(['listasLectura.libros' => function ($query) {
            $query->wherePivot('estado', 'completado')
                ->wherePivot('puntaje', '>=', 5);
        }])->get();

        return response()->json($usuarios);
    }

    // Filtro basado en la existencia de relaciones
    public function usuariosLeyendo()
    {
        $usuarios = User::whereHas('listasLectura.libros', function ($query) {
            $query->where('libro_lista_lectura.estado', 'leyendo');
        })->get();

        return response()->json($usuarios);
    }

    // Subconsultas con agregacion
    public function estadisticasListas()
    {
        $listas = ListaLectura::withCount('libros')
            ->withAvg('libros as puntaje_promedio', 'libro_lista_lectura.puntaje')
            ->having('libros_count', '>', 0)
            ->get();

        return response()->json($listas);
    }

    // Subconsulta SELECT
    public function ultimaListaUsuario()
    {
        $usuarios = User::addSelect([
            'ultima_lista_nombre' => ListaLectura::select('nombre')
                ->whereColumn('user_id', 'users.id')
                ->latest()
                ->limit(1)
        ])->get();

        return response()->json($usuarios);
    }

    // Filtros dinamicos
    public function busquedaDinamica(Request $request)
    {
        $autor = $request->input('autor');
        $estado = $request->input('estado');

        $libros = Libro::query()
            ->when($autor, fn ($q) => $q->where('autor', 'like', "%{$autor}%"))
            ->when($estado, function ($q) use ($estado) {
                $q->whereHas('listasLectura', function ($pivotQuery) use ($estado) {
                    $pivotQuery->where('libro_lista_lectura.estado', $estado);
                });
            })
            ->paginate(10);

        return response()->json($libros);
    }

    // Uso de consultas crudas (RAW) para reportes agregados
    public function reporteAutores()
    {
        $reporte = DB::table('libros')
            ->join('libro_lista_lectura', 'libros.id', '=', 'libro_lista_lectura.libro_id')
            ->select(
                'libros.autor',
                DB::raw('COUNT(libro_lista_lectura.libro_id) as total_lecturas'),
                DB::raw('ROUND(AVG(libro_lista_lectura.puntaje), 2) as calificacion_promedio')
            )
            ->where('libro_lista_lectura.estado', 'completado')
            ->groupBy('libros.autor')
            ->orderByDesc('total_lecturas')
            ->get();

        return response()->json($reporte);
    }
}
