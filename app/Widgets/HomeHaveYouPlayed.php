<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\DB;
class HomeHaveYouPlayed extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];
    protected $table = "h5_games as game";
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        
        $data = $this->getList(0, 6);
        return view('widgets.home_have_you_played', [
            'config' => $this->config,
            'data' => $data
        ]);
    }
    public function getList($offset, $limit, $categoryId = null){
        $query = DB::table($this->table)
                ->join('h5_categories as category', 'game.category_id', '=', 'category.id')
                ->skip($offset)
                ->take($limit);
        if(!empty($categoryId)){
            $query->where('game.category_id',$categoryId);
        }
        $data = $query->get([
                    'game.id as game_id',
                    'game.name',
                    'game.link',
                    'game.slug',
                    'game.logo',
                    'game.cover',
                    'game.thumb_share',
                    'game.description',
                    'game.publish_at as publishdate',
                    'game.created_at',
                    'game.updated_at',
                    'game.status',
                    'game.viewed',
                    'game.played',
                    'game.is_trending',
                    'game.is_ghim',
                    'game.tags',
                    'category.id as category_id',
                    'category.name as category_name',
                    'category.slug as category_slug',
                    'category.parent_slug as category_parent_slug',
                    'category.description as category_description',
                    'category.cover as category_cover',
                    'category.icon as category_icon'
                    ]);
        return json_decode($data, true);
    }
}
