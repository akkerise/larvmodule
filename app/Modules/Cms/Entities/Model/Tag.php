<?php

namespace App\Modules\Cms\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'h5_tags';

    protected $fillable = ['name'];

    protected $hidden = [];
}
