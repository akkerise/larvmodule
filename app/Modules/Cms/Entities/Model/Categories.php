<?php

namespace App\Modules\Cms\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'h5_categories';

    protected $fillable = ['name', 'slug', 'order', 'status', 'parent_id', 'parent_slug', 'description', 'cover', 'icon'];

    protected $hidden = [];

    public function games() {
        return $this->hasOne('App\Modules\Cms\Entities\Model\Game');
    }
}
