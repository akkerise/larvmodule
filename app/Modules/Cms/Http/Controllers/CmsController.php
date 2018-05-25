<?php

namespace Modules\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use App\Common\Repos\Repo;
use App\Modules\Cms\Repositories\User\UserRepositoryInterface;

class CmsController extends Controller
{
    protected $user;
    protected $userCms;

    public function __construct(User $user, UserRepositoryInterface $userRepositoryCms)
    {
        $this->user = new Repo($user);
        $this->userCms = $userRepositoryCms;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
//        dd($this->user->all());
        dd($this->userCms->all());
        return view('cms::dashboard/index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cms::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('cms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('cms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
