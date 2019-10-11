<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class LoginImagenes extends Model
{
    protected $table='login_images';

    protected $primaryKey='id';

    protected $fillable =
    [
    	'imagen', 'principal', 'estatus'
    ];
}
