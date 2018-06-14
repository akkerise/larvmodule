<?php
namespace App\Modules\Api\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $table = "h5_categories as category";
    
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
        return $data;
    }

}
