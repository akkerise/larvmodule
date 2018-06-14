<?php

namespace App\Modules\Cms\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class GameTrackScore extends Model
{
    protected $table = 'h5_game_track_score';

    protected $fillable = ['game_id', 'user_id', 'score', 'device_os', 'os_version', 'model_name'];

    protected $hidden = ['ip_address', 'device_name'];

    public function game()
    {
        return $this->belongsToMany('App\Modules\Cms\Entities\Model\Game');
    }

    public function user()
    {
        return $this->belongsToMany('App\Modules\Cms\Entities\Model\User');
    }
}
