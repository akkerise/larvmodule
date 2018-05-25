<?php

namespace App\Http\Controllers;

use App\Common\Repos\Repo;
use App\User;
use Illuminate\Http\Request;

class H5Controller extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = new Repo($user);
    }

    public function index()
    {
        echo "<pre>"; print_r(base_path('app/Modules'));
        echo "<pre>"; print_r(public_path('modules'));
        echo "<pre>"; print_r(base_path('database/migrations')); die();

        dd($this->user->all());
        return view('welcome');
    }
}
