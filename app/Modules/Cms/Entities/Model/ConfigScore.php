<?php

namespace App\Modules\Cms\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class ConfigScore extends Model
{
    protected $table = 'h5_config_score';

    protected $fillable = ['game_id', 'score'];

    protected $hidden = [];

    public function game(){
        return $this->belongsTo('App\Modules\Cms\Entities\Model\Game');
    }
}
