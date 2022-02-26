<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'CLIENTES';
    protected $primaryKey = 'ID_CLIEN';
    protected $fillable = [
        'IP_PUBLICA',
        'NOMBRE_CLIENTE',
        'NOM_BASE_DATOS',
        'RUC_CLIEN',
        'DIRECCION_CLIEN',
        'CORREO_CLIEN',
    ];
    /*Se agrega el created y update para la tabla de titulodocumento*/
    const CREATED_AT = 'CREATED_CLIENTES';
    const UPDATED_AT = 'UPDATED_CLIENTES';
}
