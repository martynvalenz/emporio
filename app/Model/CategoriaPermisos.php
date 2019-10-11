<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class CategoriaPermisos extends Model
{
    protected $table='categoria_permisos';

    protected $primaryKey='id';

    protected $fillable = [
        'categoria', 'slug', 'descripcion'
    ];
}
