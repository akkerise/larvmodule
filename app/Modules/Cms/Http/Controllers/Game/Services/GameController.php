<?php

namespace App\Modules\Cms\Http\Controllers\Game\Services;

use App\Modules\Cms\Http\Controllers\ServiceController;
use App\Modules\Cms\Entities\Service\GameService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class GameController extends ServiceController
{
    protected $game;

    public function __construct(GameService $game)
    {
        parent::__construct();
        $this->game = $game;
    }

    public function detail($gameid)
    {
        if (empty($gameid)) {
            return $this->response(false, 'Game id : ' . $gameid . ' not found!', [], ['status' => 404]);
        }
        $game = $this->game->findId($gameid);
        if (!empty($game)) {
            return $this->response(true, 'Success', $this->buildDetail($game), ['status' => 201]);
        }
        return $this->response(false, 'Game id : ' . $gameid . ' not data!', $game, ['status' => 404]);
    }

    public function list()
    {
        $list = $this->game->listGamesUsers();
        $games = $this->buildListGame($list);
        $temp = (string)view('cms::appui.pages.game.comp.__tbody', [
            'games' => $games
        ]);
        if (!empty($list)) {
            return $this->response(true, 'Success', $temp, ['status' => 201]);
        } else {
            return $this->response(false, 'Data not found!', [], ['status' => 404]);
        }
    }

    private function buildListGame($games)
    {
        $raw = [];
        foreach ($games as $k => $v) {
            $raw[$k] = [
                'gameid' => $v->game_id,
                'name' => $v->name,
                'email' => $v->email,
                'status' => $v->status,
                'logo' => $v->logo
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
            $game = $this->game->find($id);

            $validator = Validator::make($data, Artikel::$rules);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            $artikel->update($data);

            return Redirect::route('admin.artikels.index');
        } elseif (isset($data['Batal'])) {
            $this->index();
        }

        if (!$this->game->update($request->all(), $id)) {
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
        // 	$this->gameCms->update($request->all());
        // 	$this->gameCms->save();
        // }catch (PDOException $e) {
        // 	return $e->getMessage();
        // }
    }

    public function del($id)
    {
        if (empty($id)) {
            return $this->response(false, 'Game id : ' . $id . ' not found!', [], ['status' => 404]);
        }
        $res = $this->game->findOrFail($id);
        if ($this->game->del($res)) {
            return $this->response(true, 'Delete game id : ' . $id . ' success!', $res, ['status' => 200]);
        } else {
            return $this->response(false, 'Delete game id : ' . $id . ' failed!', $res, ['status' => 304]);
        }
    }


    public function getone($gameid)
    {
        if (empty($gameid)) {
            return $this->response(false, 'Game id : ' . $gameid . ' not found!', $this->gameCms->find($gameid), ['status' => 404]);
        }
        if (!empty($this->gameCms->find($gameid))) {
            return $this->response(true, 'Success', $this->buildDetail($this->gameCms->find($gameid)), ['status' => 201]);
        }
        return $this->response(false, 'Game id : ' . $gameid . ' not data!', $this->gameCms->find($gameid), ['status' => 404]);
    }

    private function buildDetail($game)
    {
        return [
            'id' => $game->user->id,
            'username' => $game->user->username,
            'email' => $game->user->email,
            'mobile' => $game->user->mobile,
            'name' => $game->name,
            'slug' => $game->slug,
            'logo' => $game->logo,
            'cover' => $game->cover,
            'thumb_share' => $game->thumb_share,
            'description' => $game->description,
            'status' => $game->status,
        ];
    }
}
