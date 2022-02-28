<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contratos;
use Illuminate\Support\Facades\DB;

class ContratosController extends Controller
{
    public function selectContratos(Request $request)
    {
        $filtro = $request->filtro;
        $contratos= DB::table('CONTRATOS AS A')
            ->select('ID_CONTRATOS', 'TARIFA_CONTRATOS')
            ->where([
                ['A.TARIFA_CONTRATOS', 'like', '%' . $filtro . '%'],
            ])
            ->orderBy('TARIFA_CONTRATOS', 'asc')->get();

        return ['contratos' => $contratos];
    }

    /*Se esta agregando la funcion index*/
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $registros = DB::table('CONTRATOS AS A')
            ->select('A.ID_CONTRATOS',
                'A.ID_clientes',
                'A.ID_servicios',
                'A.FECHA_DESDE',
                'A.FECHA_HASTA',
                'A.HORA_DESDE',
                'A.HORA_HASTA',
                'A.TARIFA_CONTRATOS',
                'A.TIPO_PAGO',
                'A.VALOR_TARIFA',);

        if ($buscar != '') {
            $registros = $registros->whereRaw('(A.TARIFA_CONTRATOS LIKE "%' . $buscar . '%"
                        OR A.TIPO_PAGO LIKE "%' . $buscar . '%"
                        OR A.VALOR_TARIFA LIKE "%' . $buscar . '%")');
        }
        $registros = $registros->orderBy('A.TARIFA_CONTRATOS', 'asc')->paginate(10);
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

        $registronuevo = new Contratos();
        $registronuevo->ID_clientes= $request-> ID_clientes;
        $registronuevo->ID_servicios= $request-> ID_servicios;
        $registronuevo->FECHA_DESDE= $request-> FECHA_DESDE;
        $registronuevo->FECHA_HASTA= $request-> FECHA_HASTA;
        $registronuevo->HORA_DESDE= $request-> HORA_DESDE;
        $registronuevo->HORA_HASTA= $request-> HORA_HASTA;
        $registronuevo->TARIFA_CONTRATOS= $request-> TARIFA_CONTRATOS;
        $registronuevo->TIPO_PAGO= $request-> TIPO_PAGO;
        $registronuevo->VALOR_TARIFA= $request-> VALOR_TARIFA;
        $registronuevo->save();
        return true;   
    }

     /*Se esta agregando la funcion update*/
    public function update(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }
        $actualizar = Contratos::findOrFail($request->id);
        $actualizar->ID_clientes= $request-> ID_clientes;
        $actualizar->ID_servicios= $request-> ID_servicios;
        $actualizar->FECHA_DESDE= $request-> FECHA_DESDE;
        $actualizar->FECHA_HASTA= $request-> FECHA_HASTA;
        $actualizar->HORA_DESDE= $request-> HORA_DESDE;
        $actualizar->HORA_HASTA= $request-> HORA_HASTA;
        $actualizar->TARIFA_CONTRATOS= $request-> TARIFA_CONTRATOS;
        $actualizar->TIPO_PAGO= $request-> TIPO_PAGO;
        $actualizar->VALOR_TARIFA= $request-> VALOR_TARIFA;
        $actualizar->save();
        return true;
    }

    /*Se esta agregando la funcion destroy*/
    public function destroy(Request $request)
    {
        $registro = Contratos::findOrFail($request->id);
        $ok=$registro->delete();
        return ['borrado' => $ok];
    }
}
