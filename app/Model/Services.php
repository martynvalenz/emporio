<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table='services';

    protected $primaryKey='id';

    protected $guarded = [];

    public function category()
    {
    	return $this->belongsTo('Emporio\Model\CategoryServices', 'id', 'id_category');
    }

    public function getPathAttribute()
    {
        return "/servicio/$this->slug";
    }
}
