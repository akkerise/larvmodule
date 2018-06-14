<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Illuminate\Support\Facades\DB;

class HomeCategory extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];
    protected $table = "h5_categories as category";
    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        
        $data = $this->getList(0, 10);
        return view('widgets.home_category', [
            'config' => $this->config,
            'data' => $data
        ]);
    }
    
    public function getList($offset, $limit){
        $data = DB::table($this->table)->skip($offset)->take($limit)->get([
            'id as category_id',
            'name',
            'order',
            'order',
            'status',
            'parent_id',
            'parent_slug',
            'description',
            'cover',
            'icon'
            ]);
        return json_decode($data, true);
        //return $data;
    }
}
