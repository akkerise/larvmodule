<?php

namespace App\Modules\Cms\Entities\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Auth;

class User extends Auth
{

    protected $table = 'h5_users';

    protected $fillable = ['appota_user_id', 'role_id', 'username', 'password', 'email', 'fullname', 'birthday', 'mobile', 'address', 'avatar', 'gender', 'register_date', 'register_ip', 'last_activity', 'is_moderator', 'is_admin', 'is_banned', 'status', 'access_token', 'refresh_token', 'remember_token', 'expired_at'];

    protected $hidden = ['password', 'access_token', 'register_ip'];

    public function role()
    {
        return $this->belongsToMany('App\Modules\Cms\Entities\Model\Role');
    }

    public function games()
    {
        return $this->hasMany('App\Modules\Cms\Entities\Model\Game', 'id');
    }

    public function categories()
    {
        return $this->hasMany('App\Modules\Cms\Entities\Model\Categories');
    }
}
