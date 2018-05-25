<?php

namespace App\Modules\Common\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use App\Common\Repos\Repo;
use App\Modules\Common\Repositories\User\UserRepositoryInterface;

class CommonController extends Controller
{

    protected $user;
    protected $userCommon;

    public function __construct(User $user, UserRepositoryInterface $userCommon)
    {
        $this->user = new Repo($user);
        $this->userCommon = $userCommon;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        dd($this->user->all());
        dd($this->userCommon->all());
        return view('common::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('common::create');
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
        return view('common::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('common::edit');
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
