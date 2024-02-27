<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

class PhotoController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:users.update', ['only' => ['index']]);
//        $this->middleware('permission:users.update', ['only' => ['edit']]);
    }

    public function index($user)
    {
        return view('users.photo', compact('user'));
    }
}
