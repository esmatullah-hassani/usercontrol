<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManager;
use PDF;

class UsersController extends Controller
{
    protected $images;
    public function __construct(ImageManager $images)
    {
        $this->middleware('permission:users.*', ['only' => ['index']]);
        $this->middleware('permission:users.view', ['only' => ['show']]);
        $this->middleware('permission:users.create', ['only' => ['create','store']]);
        $this->middleware('permission:users.update', ['only' => ['edit','update', 'updateUsersPassword']]);
        $this->middleware('permission:users.destroy', ['only' => ['destroy']]);
        $this->images = $images;
    }

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_card' => 'required|unique:users',
            'email' => 'unique:users',
            'name' => 'required'
        ]);

        $user = DB::transaction(function () use ($request) {
            $url = null;
            if ($request->has('photo')) {

                $file = $request->photo;
                $path = $file->hashName(config('client') . '/photos');
                $disk = Storage::disk('public');

                $url = $disk->put(
                    $path, (string)$this->images->make($file->path())->fit(354, 472)->encode()
                );
            }
            $user = User::create([
                'name' => $request->get('name'),
                'id_card' => $request->get('id_card'),
                'last_name' => $request->get('last_name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'photo_url'=>$url?$disk->url($path):null,
                'password' => $request->has('password') ? bcrypt($request->get('password')) : null,
                'active' => $request->get('user_account')
            ]);
            
            $user->roles()->attach(1);//user role id is 1
            
            return $user;
        });

        $route = $request->has('new') ? route('users.create') : route('users.edit', $user);    
        return redirect($route)->with('success', trans('general.x_has_been_registered', ['x' => $user->name]));
    }

    public function show($user)
    {
       
        return view('users.show', compact('user'));
    }

    public function edit($user)
    {   
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $user)
    {
        $this->validate($request, [
            'id_card' => ['required',Rule::unique('users')->ignore($user->id)],
            'email' => [Rule::unique('users')->ignore($user->id)],
            'name' => 'required'
        ]);       
        
        DB::transaction(function () use ($request, $user) {
            $url = null;
            if ($request->has('photo')) {

                $file = $request->photo;
                $path = $file->hashName('photos');
               
                $disk = Storage::disk('public');
                if ($user->photo_url) {
                    Storage::delete(str_replace("/storage/","public/", $user->photo_url));
                }

                $url = $disk->put(
                    $path, (string)$this->images->make($file->path())->fit(354, 472)->encode()
                );
            }
            $user->update([
                'name' => $request->get('name'),
                'id_card' => $request->get('id_card'),
                'last_name' => $request->get('last_name'),
                'phone' => $request->get('phone'),
                'email' => $request->get('email'),
                'photo_url'=>$url?$disk->url($path):$user->photo_url,
                'password' => $request->has('password') ? bcrypt($request->get('password')) : $user->password,
                'active' => $request->get('user_account'),
            ]);
        });
        
        return redirect(route('users.show', $user))->with('success', trans('general.x_has_been_updated', ['x' => $user->name]));        
    }

    public function destroy($user)
    {
        $user->delete();
        return redirect(route('users.index'))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.user')]));
    }

    public function idCard(Request $request, $user)
    {        
        $format = [85, 54];
        $pdf = PDF::loadView('pdf.users.cards.idCard', compact('user'), [], [            
            'title' => $user->code.' '.$user->name,
            'format' => $format
        ]);

        return $pdf->stream($user->name.'.pdf');
    }

}