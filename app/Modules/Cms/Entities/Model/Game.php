<?php

namespace App\Modules\Cms\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'h5_games';

    protected $fillable = ['name', 'slug', 'logo', 'cover', 'thumb_share', 'description', 'publish_at', 'status', 'viewed', 'played', 'is_trending', 'is_ghim', 'tags', 'link', 'user_id', 'category_id', 'order'];

    protected $hidden = [];

    public $timestamps = true;

    public function category() {
        return $this->hasOne('App\Modules\Cms\Entities\Model\Categories');
    }

    public function user() {
        return $this->belongsTo('App\Modules\Cms\Entities\Model\User', 'user_id');
    }

    public function configScore() {
        return $this->hasMany('App\Modules\Cms\Entities\Model\ConfigScore');
    }

}
