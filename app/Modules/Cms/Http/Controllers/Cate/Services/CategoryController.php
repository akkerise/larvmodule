<?php

namespace App\Modules\Cms\Http\Controllers\Cate\Services;

use App\Modules\Cms\Http\Controllers\ServiceController;
use App\Modules\Cms\Entities\Service\CategoryService;
use App\Modules\Cms\Entities\Service\GameService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CategoryController extends ServiceController
{
    protected $cate;

    public function __construct(CategoryService $cate)
    {
        parent::__construct();
        $this->cate = $cate;
    }

    public function detail($cateid)
    {
        if (empty($cateid)) {
            return $this->response(false, 'Category id : ' . $cateid . ' not found!', [], ['status' => 404]);
        }
        $cate = $this->cate->findId($cateid);
        if (!empty($cate)) {
            return $this->response(true, 'Success', $this->buildDetail($cate), ['status' => 201]);
        }
        return $this->response(false, 'Game id : ' . $cateid . ' not data!', $cate, ['status' => 404]);
    }

    public function list()
    {
        $list = $this->cate->listGamesUsers();
        $cates = $this->buildListGame($list);
        $temp = (string)view('cms::appui.pages.game.comp.__tbody', [
            'games' => $cates
        ]);
        if (!empty($list)) {
            return $this->response(true, 'Success', $temp, ['status' => 201]);
        } else {
            return $this->response(false, 'Data not found!', [], ['status' => 404]);
        }
    }

    private function buildListCate($cates)
    {
        $raw = [];
        foreach ($cates as $k => $v) {
            $raw[$k] = [
                'name' => $v->name,
                'slug' => $v->slug,
                'order' => $v->order,
                'status' => $v->status,
                'parent_id' => $v->parent_id,
                'parent_slug' => $v->parent_slug,
                'description' => $v->description,
                'cover' => $v->cover,
                'icon' => $v->icon,
            ];
        }
        return array_slice($raw, 0, 10);
    }

    public function edit($id, CmsEditGameRequest $request)
    {
        if ($request->ajax()) {
            echo "<pre>";
            print_r(1);
            die();
        }
        if (isset($data['Simpan'])) {
            $cate = $this->cate->find($id);

            $validator = Validator::make($data, Artikel::$rules);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $artikel->update($data);

            return Redirect::route('admin.artikels.index');
        } elseif (isset($data['Batal'])) {
            $this->index();
        }

        if (!$this->cate->update($request->all(), $id)) {
            return $this->response(false, 'Error Update Game Id : ' . $id, [], ['status' => 400]);
        } else {
            return $this->response(true, 'Update Game Id : ' . $id . ' Successfully! ', $request->all(), ['status' => 201]);
        }
        //Display File Name
        // echo 'File Name: '.$file->getClientOriginalName();
        // return $this->response(true, '', null, ['logo_name' => $logo->getClientOriginalName()]);
        //Display File Extension
        // echo 'File Extension: '.$file->getClientOriginalExtension();
        //Display File Real Path
        // echo 'File Real Path: '.$file->getRealPath();
        //Display File Size
        // echo 'File Size: '.$file->getSize();
        //Display File Mime Type
        // echo 'File Mime Type: '.$file->getMimeType();
        //Move Uploaded File
        // $destinationPath = 'appui/uploads/';

        // $file->move($destinationPath,$file->getClientOriginalName());
        // try{
        // 	$this->cateCms->update($request->all());
        // 	$this->cateCms->save();
        // }catch (PDOException $e) {
        // 	return $e->getMessage();
        // }
    }

    public function del($id)
    {
        if (empty($id)) {
            return $this->response(false, 'Game id : ' . $id . ' not found!', [], ['status' => 404]);
        }
        $res = $this->cate->findOrFail($id);
        if ($this->cate->del($res)) {
            return $this->response(true, 'Delete game id : ' . $id . ' success!', $res, ['status' => 200]);
        } else {
            return $this->response(false, 'Delete game id : ' . $id . ' failed!', $res, ['status' => 304]);
        }
    }

    public function getone($cateid)
    {
        if (empty($cateid)) {
            return $this->response(false, 'Game id : ' . $cateid . ' not found!', $this->cateCms->find($cateid), ['status' => 404]);
        }
        if (!empty($this->cateCms->find($cateid))) {
            return $this->response(true, 'Success', $this->buildDetail($this->cateCms->find($cateid)), ['status' => 201]);
        }
        return $this->response(false, 'Game id : ' . $gameid . ' not data!', $this->cateCms->find($gameid), ['status' => 404]);
    }

    private function buildDetail($game)
    {
        return [
            'id' => $game->id,
            'name' => $game->name,
            'slug' => $game->slug,
            'order' => $game->order,
            'status' => $game->status,
            'parent_id' => $game->parent_id,
            'parent_slug' => $game->parent_slug,
            'description' => $game->description,
            'cover' => $game->cover,
            'icon' => $game->icon,
        ];
    }
}
