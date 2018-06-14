<?php
namespace App\Modules\Cms\Entities\Model;

use Illuminate\Database\Eloquent\Model;

class GameTag extends Model
{
    protected $table = 'h5_game_tag';

    protected $fillable = ['game_id', 'tag_id'];

    protected $hidden = [];

    public function game()
    {
        return $this->hasOne('App\Modules\Cms\Entities\Model\Game');
    }

    public function tag()
    {
        return $this->hasOne('App\Modules\Cms\Entities\Model\Tag');
    }

}
