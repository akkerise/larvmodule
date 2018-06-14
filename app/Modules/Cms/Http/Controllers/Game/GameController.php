<?php

namespace App\Modules\Cms\Http\Controllers\Game;

use App\Modules\Cms\Http\Requests\Game\CmsEditGameRequest;
use App\Modules\Cms\Http\Requests\Game\CmsAddGameRequest;
use App\Modules\Cms\Entities\Service\GameService;
use App\Common\Entities\Api\AppotaUploadImageApi;
use App\Modules\Cms\Entities\Traits\UploadFile;
use App\Modules\Cms\Entities\Model\Game;
use App\Common\Repos\Repo;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class GameController extends Controller
{

    use UploadFile;

    protected $game;

    public function __construct(GameService $game)
    {
        $this->middleware('cms');
        $this->game = $game;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('cms::appui.pages.game.list', [
            'games' => $this->game->listGamesUsers()
        ]);
    }

    public function addGame()
    {
        return view('cms::appui.pages.game.add');
    }

    public function editGame($id)
    {
        return view('cms::appui.pages.game.edit', ['game' => $this->game->findOrFail($id), 'listStatus' => $this->game->listStatus()]);
    }

    public function add(CmsAddGameRequest $request)
    {
        $validator = validator()->make($request->all(), $request->rules(), $request->messages());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if (!$this->buildAddGameInsertDB($request)) {
                return redirect()->route('cms.game.list')->with(Message::buildMsgAction('danger',"You can't create new game!"));
            }
            return redirect()->route('cms.game.list')->with(Message::buildMsgAction('success', 'You are created new game successful!'));
        }
    }

    public function edit(CmsEditGameRequest $request, $id)
    {
        $validator = validator()->make($request->all(), $request->rules(), $request->messages());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if (!$this->buildEditGameInsertDB($request, $id)) {
                return redirect()->route('cms.game.list')->with(Message::buildMsgAction('danger',"You can't edit game!"));
            }
            return redirect()->route('cms.game.list')->with(Message::buildMsgAction('success', 'You are edited game successful!'));
        }
    }

    private function buildAddGameInsertDB($request)
    {
        $file = $request->file('file');
        $logo = $request->file('logo');
        $cover = $request->file('cover');
        $thumb_share = $request->file('thumb_share');
        $resLogo = AppotaUploadImageApi::resp($logo->getRealPath());
        $resCover = AppotaUploadImageApi::resp($cover->getRealPath());
        $resThumbShare = AppotaUploadImageApi::resp($thumb_share->getRealPath());
        $slug = $this->buildRandomStringAndCheckSlug($request->name);
        $input = [
            'name' => $request->name,
            'slug' => $slug,
            'logo' => $resLogo->data->url,
            'cover' => $resCover->data->url,
            'thumb_share' => $resThumbShare->data->url,
            'link' => '/appui/upload/games/' . $slug,
            'description' => $request->description,
            'status' => random_int(0, 10),
            'viewed' => 0,
            'played' => 0,
            'is_trending' => 0,
            'is_ghim' => 0,
            'tags' => $request->name,
            'user_id' => auth()->guard('cms')->user()->id,
            'category_id' => 1,
            'order' => random_int(0, 1000000),
            'publish_at' => time('Y-m-d H-i-s')
        ];
        $result = $this->game->store($input);
        if ($result) {
            if (!($this->uploadFile($file, $extractToPath = public_path() . '/appui/upload/games/', $slug, $msg))) {
                $this->msg = $msg;
                return false;
            }
        }
        return $result;
    }

    private function buildEditGameInsertDB($request, $id)
    {
        $game = $this->game->findOrFail($id);
        if (empty($game)) {
            return false;
        }
        $file = $request->file('file');
        $logo = $request->file('logo');
        $cover = $request->file('cover');
        $thumb_share = $request->file('thumb_share');
        $resLogo = AppotaUploadImageApi::resp($logo->getRealPath());
        $resCover = AppotaUploadImageApi::resp($cover->getRealPath());
        $resThumbShare = AppotaUploadImageApi::resp($thumb_share->getRealPath());
        $slug = $this->buildRandomStringAndCheckSlug($request->name);
        $input = [
            'name' => $request->name,
            'slug' => $slug,
            'logo' => $resLogo->data->url,
            'cover' => $resCover->data->url,
            'thumb_share' => $resThumbShare->data->url,
            'link' => '/appui/upload/games/' . $slug,
            'description' => $request->description,
            'status' => $request->status,
            'tags' => $request->name,
            'publish_at' => time('Y-m-d H-i-s'),
            'updated_at' => time('Y-m-d H-i-s')
        ];
        $result = $this->game->update($game, $input);
        if ($result) {
            return $this->updateFolderGame($file, $game->slug, $slug);
        }
        return $result;
    }

    private function buildRandomStringAndCheckSlug(string $str)
    {
        $raw = substr(sha1(bcrypt($str)), 0, 8);
        $res = $this->game->findByCondition(['slug' => $raw]);
        if (count($res) > 0) {
            return self::buildRandomStringAndCheckSlug($str);
        } else {
            return $raw;
        }
    }

    protected function updateFolderGame($file, $oldSlug, $slug){
        if (!empty($file)) {
            $resUpload = $this->uploadFile($file, $extractToPath = public_path() . '/appui/upload/games/', $slug, $msg);
            if (!empty($msg)) {
                $this->msg = $msg;
                return false;
            }
            $resDel = $this->deleteDir(public_path() . '/appui/upload/games/' . $oldSlug);
            if ($resUpload == true && $resDel == true) {
                return true;
            }
            return false;
        }else{
            return false;
        }
    }

    protected function delFolderGame(){
    }
}
