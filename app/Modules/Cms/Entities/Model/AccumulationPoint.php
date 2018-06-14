<?php

namespace App\Modules\Cms\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class AccumulationPoint extends Model
{
    protected $table = 'h5_accumulation_point';

    protected $fillable = ['user_id', 'point'];

    protected $hidden = [];

    public function user(){
        return $this->belongsTo('App\Modules\Cms\Entities\Model\User');
    }
}
