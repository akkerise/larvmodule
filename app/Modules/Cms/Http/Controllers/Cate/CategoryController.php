<?php

namespace App\Modules\Cms\Http\Controllers\Cate;

use App\Modules\Cms\Http\Requests\Cate\CmsEditCateRequest;
use App\Modules\Cms\Http\Requests\Cate\CmsAddCateRequest;
use App\Modules\Cms\Entities\Service\CategoryService;
use App\Common\Entities\Api\AppotaUploadImageApi;
use App\Modules\Cms\Entities\Service\UserService;
use App\Modules\Cms\Entities\Model\User;
use App\Common\Untils\Regular;
use App\Common\Untils\Message as Msg;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $user;
    protected $cate;

    public function __construct(UserService $user, CategoryService $cate)
    {
        $this->middleware('cms');
        $this->user = $user;
        $this->cate = $cate;
    }

    public function index()
    {
        return view('cms::appui.pages.cate.list', ['cates' => $this->cate->list()]);
    }

    public function addCate()
    {
        return view('cms::appui.pages.cate.add');
    }

    public function editCate($id)
    {

        return view('cms::appui.pages.cate.edit',['cate' => $this->cate->findId($id)]);
    }

    public function add(CmsAddCateRequest $request)
    {
        $validator = validator()->make($request->all(), $request->rules(), $request->messages());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if (!$this->cate->store($this->buildDataAddInsertDB($request))) {
                return redirect()->route('cms.cate.list')->with(Msg::buildMsgAction('danger', "You can't create new category!"));
            }
            return redirect()->route('cms.cate.list')->with(Msg::buildMsgAction('success', 'You are created new category successful!'));
        }
    }

    public function edit(CmsEditCateRequest $request, $id)
    {
        $validator = validator()->make($request->all(), $request->rules(), $request->messages());
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            if (!$this->buildEditGameInsertDB($request, $id)) {
                return redirect()->route('cms.cate.list')->with(Msg::buildMsgAction('danger',"You can't edit game!"));
            }
            return redirect()->route('cms.cate.list')->with(Msg::buildMsgAction('success', 'You are edited game successful!'));
        }
    }

    private function buildDataAddInsertDB($request)
    {
        $cover = $request->file('cover');
        $icon = $request->file('icon');
        $resCover = AppotaUploadImageApi::resp($cover->getRealPath());
        $resIcon = AppotaUploadImageApi::resp($icon->getRealPath());
        return [
            'name' => $request->name,
            'slug' => $request->slug,
            'order' => $request->order,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
            'parent_slug' => $request->parent_slug,
            'description' => $request->description,
            'cover' => $resCover->data->url,
            'icon' => $resIcon->data->url,
        ];
    }

    private function buildEditGameInsertDB($request, $id)
    {
        $cate = $this->cate->findId($id);
        if (empty($cate)) {
            return false;
        }
        $icon = $request->file('icon');
        $cover = $request->file('cover');
        $resCover = AppotaUploadImageApi::resp($cover->getRealPath());
        $resIcon = AppotaUploadImageApi::resp($icon->getRealPath());
        $slug = $this->buildRandomStringAndCheckSlug($request->name);
        $input = [
            'name' => $request->name,
            'slug' => $slug,
            'order' => $request->order,
            'status' => $request->status,
            'parent_id' => $request->parent_id,
            'parent_slug' => $request->parent_slug,
            'icon' => $resIcon->data->url,
            'cover' => $resCover->data->url,
            'description' => $request->description,
        ];
        return $this->cate->update($cate, $input);
    }

    private static function buildCategories($cates, $parent_id = 1)
    {
        foreach ($cates as $k => $v) {
            if ($cates[$k]->parent_id == $v->parent_id) {
                $cates[$k]->subcate[$v->id] = $v;
                unset($cates[$k]);
                self::buildCategories($cates, $v['id']);
            }
        }
    }

    private function buildRandomStringAndCheckSlug(string $str)
    {
        $raw = substr(sha1(bcrypt($str)), 0, 8);
        $res = $this->cate->findByCondition(['slug' => $raw]);
        if (count($res) > 0) {
            return self::buildRandomStringAndCheckSlug($str);
        } else {
            return $raw;
        }
    }
}
