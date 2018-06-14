<?php

namespace App\Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use App\Common\Repos\Repo;
use App\Modules\Client\Repositories\User\UserRepositoryInterface;
use App\Modules\Client\Http\Controllers\ClientController;
use App\Common\Gamota\RequestApi;
use Illuminate\Support\Facades\DB;
class CategoryController extends ClientController
{
    protected $table = "h5_games as game";
    public function __construct()
    {
        
    }

    public function index(Request $request){
        $categoryId = null;
        if($request->id){
            $categoryId = $request->id;
        }
        $detailCategory = $this->getDetailCategory($categoryId);
        
        return view('client::category.index', [
            'data' => $this->getList(0, 50,$categoryId),
            'detailCategory' => $detailCategory
        ]);
    }
    
    public function getDetailCategory($categoryId = null){
        $data = DB::table('h5_categories')->where('id',$categoryId)->first();
        return (array) $data;
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
