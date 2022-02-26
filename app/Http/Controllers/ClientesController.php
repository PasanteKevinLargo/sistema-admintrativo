<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function selectClientes(Request $request)
    {
        $filtro = $request->filtro;
        $clientes= DB::table('CLIENTES AS A')
            ->select('ID_CLIEN', 'NOMBRE_CLIENTE')
            ->where([
                ['A.NOMBRE_CLIENTE', 'like', '%' . $filtro . '%'],
            ])
            ->orderBy('NOMBRE_CLIENTE', 'asc')->get();

        return ['clientes' => $clientes];
    }

    /*Se esta agregando la funcion index*/
    public function index(Request $request)
    {
        $buscar = $request->buscar;
        $registros = DB::table('CLIENTES AS A')
            ->select('A.ID_CLIEN',
                'A.IP_PUBLICA',
                'A.NOMBRE_CLIENTE',
                'A.NOM_BASE_DATOS',
                'A.RUC_CLIEN',
                'A.DIRECCION_CLIEN',
                'A.CORREO_CLIEN',);

        if ($buscar != '') {
            $registros = $registros->whereRaw('(A.NOMBRE_CLIENTE LIKE "%' . $buscar . '%"
                        OR A.IP_PUBLICA LIKE "%' . $buscar . '%"
                        OR A.NOM_BASE_DATOS LIKE "%' . $buscar . '%")');
        }
        $registros = $registros->orderBy('A.NOMBRE_CLIENTE', 'asc')->paginate(10);
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

        $registronuevo = new Clientes();
        $registronuevo->IP_PUBLICA= $request-> IP_PUBLICA;
        $registronuevo->NOMBRE_CLIENTE= $request-> NOMBRE_CLIENTE;
        $registronuevo->NOM_BASE_DATOS= $request-> NOM_BASE_DATOS;
        $registronuevo->RUC_CLIEN= $request-> RUC_CLIEN;
        $registronuevo->DIRECCION_CLIEN= $request-> DIRECCION_CLIEN;
        $registronuevo->CORREO_CLIEN= $request-> CORREO_CLIEN;
        $registronuevo->save();
        return true;   
    }

     /*Se esta agregando la funcion update*/
    public function update(Request $request)
    {
        if (!$request->ajax()) {
            return redirect('/');
        }
        $actualizar = Clientes::findOrFail($request->id);
        $actualizar->IP_PUBLICA= $request-> IP_PUBLICA;
        $actualizar->NOMBRE_CLIENTE= $request-> NOMBRE_CLIENTE;
        $actualizar->NOM_BASE_DATOS= $request-> NOM_BASE_DATOS;
        $actualizar->RUC_CLIEN= $request-> RUC_CLIEN;
        $actualizar->DIRECCION_CLIEN= $request-> DIRECCION_CLIEN;
        $actualizar->CORREO_CLIEN= $request-> CORREO_CLIEN;
        $actualizar->save();
        return true;
    }

    /*Se esta agregando la funcion destroy*/
    public function destroy(Request $request)
    {
        $registro = Clientes::findOrFail($request->id);
        $ok=$registro->delete();
        return ['borrado' => $ok];
    }
}
