<?php

namespace App\Modules\Cms\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class GameConfigTurn extends Model
{
    protected $table = 'h5_game_config_turn';

    protected $fillable = ['user_id', 'game_id', 'turn'];

    protected $hidden = [];

    public function game()
    {
        return $this->belongsTo('App\Modules\Cms\Entities\Model\Game');
    }

    public function user()
    {
        return $this->belongsTo('App\Modules\Cms\Entities\Model\User');
    }
}
