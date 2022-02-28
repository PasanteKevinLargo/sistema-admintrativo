<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contratos extends Model
{
    protected $table = 'CONTRATOS';
    protected $primaryKey = 'ID_CONTRATOS';
    protected $fillable = [
        'ID_clientes',
        'ID_servicios',
        'FECHA_DESDE',
        'FECHA_HASTA',
        'HORA_DESDE',
        'HORA_HASTA',
        'TARIFA_CONTRATOS',
        'TIPO_PAGO',
        'VALOR_TARIFA',
    ];
    /*Se agrega el created y update para la tabla de titulodocumento*/
    const CREATED_AT = 'CREATED_CONTRATOS';
    const UPDATED_AT = 'UPDATED_CONTRATOS';
}
