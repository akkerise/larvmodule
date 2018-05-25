<?php

namespace App\Modules\Api\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\User;
use App\Common\Repos\Repo;
use App\Modules\Api\Repositories\User\UserRepositoryInterface;

class ApiController extends Controller
{

    protected $user;
    protected $userApi;

    public function __construct(User $user, UserRepositoryInterface $userApi)
    {
        $this->user = new Repo($user);
        $this->userApi = $userApi;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        dd($this->user->all());
        dd($this->userApi->all());
        return view('api::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('api::create');
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
        return view('api::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('api::edit');
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
