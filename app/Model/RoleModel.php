<?php

namespace Emporio\Model;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $table='role_user';

    protected $primaryKey='id';

    protected $fillable = [
        'role_id', 'user_id'
    ];


    public function Role()
    {
        return $this->belongsTo('Caffeinated\Shinobi\Models\Role', 'role_id', 'id');
    }
}
