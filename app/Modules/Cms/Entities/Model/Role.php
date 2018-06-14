<?php

namespace App\Modules\Cms\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'h5_roles';

    protected $fillable = ['name'];

    protected $hidden = [];

    public function users(){
        return $this->belongsToMany('App\Modules\Cms\Entities\Model\User');
    }
}
