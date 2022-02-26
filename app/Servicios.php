<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    protected $table = 'SERVICIOS';
    protected $primaryKey = 'ID_SERVICIOS';
    protected $fillable = [
        'NOMBRE_SERVICIOS',
        'TARIFA_SERVICIOS',
        'TIPO_PERIODO',
    ];
    /*Se agrega el created y update para la tabla de titulodocumento*/
    const CREATED_AT = 'CREATED_SERVICIOS';
    const UPDATED_AT = 'UPDATE_SERVICIOS';
}
