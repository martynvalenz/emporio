<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Clientes;
use Emporio\User;

class Control extends Model
{
    protected $table='control';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'nombre', 'logo_url', 'fecha_registrada', 'registrada', 'folio_estatus', 'numero_expediente', 'numero_registro', 'numero_tramite', 'patente', 'marca', 'pc', 'estatus_status', 'tipo_tramite', 'carpeta', 'carpeta_url', 'codigo_barras', 'representante', 'fecha_inicio', 'fecha_vencimiento', 'fecha_anualidad', 'fecha_comprobacion_uso', 'fecha_entrega_certificado', 'observaciones', 'id_cliente', 'id_admin', 'id_razon_social', 'id_bitacoras_estatus'
    ];

    protected $guarded =[

    ];

    public function Clientes()
    {
        return $this->belongsTo('Emporio\Model\Clientes', 'id_cliente', 'id');
    }

    public function Admin()
    {
        return $this->hasOne('Emporio\User', 'id', 'id_admin');
    }

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = strtoupper($value);
    }
}
