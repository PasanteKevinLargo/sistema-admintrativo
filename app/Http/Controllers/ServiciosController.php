<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servicios;
use Illuminate\Support\Facades\DB;

class ServiciosController extends Controller
{
    public function selectServicios(Request $request)
    {
        $filtro = $request->filtro;
        $servicios= DB::table('SERVICIOS AS A')
            ->select('ID_SERVICIOS', 'NOMBRE_SERVICIOS')
            ->where([
                ['A.NOMBRE_SERVICIOS', 'like', '%' . $filtro . '%'],
            ])
            ->orderBy('NOMBRE_SERVICIOS', 'asc')->get();

        return ['servicios' => $servicios];
    }

    /*Se esta agregando la funcion index*/
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $registros = DB::table('SERVICIOS AS A')
            ->select('A.ID_SERVICIOS',
                'A.NOMBRE_SERVICIOS',
                'A.TARIFA_SERVICIOS',
                'A.TIPO_PERIODO',);

        if ($buscar != '') {
            $registros = $registros->whereRaw('(A.NOMBRE_SERVICIOS LIKE "%' . $buscar . '%"
                        OR A.TARIFA_SERVICIOS LIKE "%' . $buscar . '%"
                        OR A.TIPO_PERIODO LIKE "%' . $buscar . '%")');
        }
        $registros = $registros->orderBy('A.NOMBRE_SERVICIOS', 'asc')->paginate(10);
        return [
            'pagination' => [
                'total' => $registros->total(),
                'current_page' => $registros->currentPage(),
                'per_page' => $registros->perPage(),
                'last_page' => $registros->lastPage(),
                'from' => $registros->firstItem(),
                'to' => $registros->lastItem(),
            ],
            'registros' => $registros,
        ];

    }

    /*Se esta agregando la funcion store*/
    public function store(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }

        $registronuevo = new Servicios();
        $registronuevo->NOMBRE_SERVICIOS= $request-> NOMBRE_SERVICIOS;
        $registronuevo->TARIFA_SERVICIOS= $request-> TARIFA_SERVICIOS;
        $registronuevo->TIPO_PERIODO= $request-> TIPO_PERIODO;
        $registronuevo->save();
        return true;   
    }

     /*Se esta agregando la funcion update*/
    public function update(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }
        $actualizar = Servicios::findOrFail($request->id);
        $actualizar->NOMBRE_SERVICIOS= $request-> NOMBRE_SERVICIOS;
        $actualizar->TARIFA_SERVICIOS= $request-> TARIFA_SERVICIOS;
        $actualizar->TIPO_PERIODO= $request-> TIPO_PERIODO;
        $actualizar->save();
        return true;
    }

    /*Se esta agregando la funcion destroy*/
    public function destroy(Request $request)
    {
        $registro = Servicios::findOrFail($request->id);
        $ok=$registro->delete();
        return ['borrado' => $ok];
    }
}
