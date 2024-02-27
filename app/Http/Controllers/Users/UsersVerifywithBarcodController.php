<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersVerifywithBarcodController extends Controller
{
    public function index(Request $request,$idCard){
        
        $user = User::where('id_card',$idCard)->first();
        if($user){
            $user = User::find($user->id);
            if($user->active)
            {
                Auth::login($user);
            
                return view('users.login_with_id_card',compact('user'));
            }
            
            return abort(401);
        }
        return  abort(404, 'User not found.');
        
    }
}
