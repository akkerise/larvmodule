<?php

namespace App\Modules\Cms\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{

    protected $table = 'h5_users_roles';

    protected $fillable = ['user_id', 'role_id'];

    protected $hidden = [];

}
