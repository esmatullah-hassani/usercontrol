<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class ImpersonationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:*.impersonate')->except('stopImpersonating');
        //should not imp users from another team => done
        //should not imp users who their access is higher than this => only administrators has access to users
        //should not imp developer => done
        //should not imp administrators => only adminstrator has access to users
    }

    /**
     * Impersonate the given user.
     *
     * @param  Request  $request
     * @param  string  $userId
     * @return Response
     */
    public function impersonate(Request $request, $user)
    {   
        //He could not impersonate users who are developer or they are not in his team
        //He could not impersonate group of users who does not have the right permission
        if (! auth()->user()->isTeammate($user) OR $user->isDeveloper() OR
            (! auth()->user()->may("students.impersonate") and $user->roleIsStudent()) OR
            (! auth()->user()->may("teachers.impersonate") and $user->roleIsTeacher()) OR
            (! auth()->user()->may("users.impersonate") and $user->roleIsUser())) {
            return redirect()->back()->with('error', trans('general.you_can_not_impersonate_x', ['x' => $user->name]));
        }

        /*if (! $user->isDeveloper()) {
            return redirect()->back()->with('error', trans('general.you_can_not_impersonate_x', ['x' => $user->name]));
        }*/

        $request->session()->flush();

        // We will store the original user's ID in the session so we can remember who we
        // actually are when we need to stop impersonating the other user, which will
        // allow us to pull the original user back out of the database when needed.
        $request->session()->put([
            'accessControl:impersonator' => $request->user()->id,
            'accessControl:impersonatorPath' => URL::previous()
        ]);
        
        Auth::login($user);
        
        
        return redirect('/');
    }

    /**
     * Stop impersonating and switch back to primary account.
     *
     * @param  Request  $request
     * @return Response
     */
    public function stopImpersonating(Request $request)
    {
        $currentId = Auth::id();

        // We will make sure we have an impersonator's user ID in the session and if the
        // value doesn't exist in the session we will log this user out of the system
        // since they aren't really impersonating anyone and manually hit this URL.
        if (! $request->session()->has('accessControl:impersonator')) {
            Auth::logout();

            return redirect('/');
        }

        $userId = $request->session()->pull(
            'accessControl:impersonator'
        );

        $path = $request->session()->pull(
            'accessControl:impersonatorPath'
        );

        // After removing the impersonator user's ID from the session so we can retrieve
        // the original user. Then, we will flush the entire session to clear out any
        // stale data from while we were doing the impersonation of the other user.
        $request->session()->flush();

        Auth::login(User::findOrFail($userId));

        return redirect('/');
    }
}
