<?php

namespace App\Http\Controllers\Localize;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocalizeController extends Controller
{
    //

    public function index($lang)
    {


        $user = User::find(auth()->id());
        $user->locale = $lang;
        $user->save();

        return redirect()->back();
    }
}
