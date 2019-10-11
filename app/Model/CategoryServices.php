<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;
use Emporio\Model\Services;

class CategoryServices extends Model
{
    protected $table='category_services';

    protected $primaryKey='id';

    protected $guarded = [];

    public function services()
    {
    	return $this->hasMany(Services::class, 'id_category', 'id');
    }

    public function getPathAttribute()
    {
        return "/categoria/$this->slug";
    }
}
