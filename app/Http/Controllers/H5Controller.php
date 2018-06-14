<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\Repos\Repo;

class H5Controller extends Controller
{
    public function index()
    {
        return redirect('/client');
    }
}
