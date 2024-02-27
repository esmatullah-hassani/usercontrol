<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RegistrationType;
use App\DataTables\RegistrationTypesDataTable;
use Illuminate\Validation\Rule;

class RegistrationTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:administrator');        
    }
    
    public function index(RegistrationTypesDataTable $dataTable)
    {
        return $dataTable->render('administrator.registrationTypes.index');
    }

    public function create()
    {                
        return view('administrator.registrationTypes.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [            
            'code' => 'required|unique:registration_types',
            'title' => 'required',
        ]);

        $type = RegistrationType::create([            
            'code' => $request->get('code'),
            'title' => $request->get('title'),
            'team_id' => auth()->user()->current_team_id,
        ]);
        
        if ($request->has('default')) {
            $type->setDefault();
        }
        
        return redirect(route('registrationTypes.index'))->with('success', trans('general.x_has_been_created', ['x' => $type->title]));
    }

    public function edit($type)
    {        
        return view('administrator.registrationTypes.edit', compact('type'));
    }

    public function update(Request $request, $type)
    {
        $this->validate($request, [
            'code' => [
                'required',
                Rule::unique('registration_types')->where('team_id', currentTeamId())->ignore($type->id),
            ],
            'title' => 'required'
        ]);

        $type->update([
            'code' => $request->get('code'),
            'title' => $request->get('title')            
        ]);

        if ($request->has('default')) {
            $type->setDefault();
        }      
        
        return redirect(route('registrationTypes.index'))->with('success', trans('general.x_has_been_updated', ['x' => $type->title]));
    }

    public function destroy($type)
    {
        $type->delete();
        return redirect(route('registrationTypes.index'))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.registration_type')]));
    }
}