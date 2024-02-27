<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RegistrationPeriod;
use App\DataTables\RegistrationPeriodsDataTable;
use Illuminate\Validation\Rule;

class RegistrationPeriodsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:administrator');        
    }
    
    public function index(RegistrationPeriodsDataTable $dataTable)
    {
        return $dataTable->render('administrator.registrationPeriods.index');
    }

    public function create()
    {                
        return view('administrator.registrationPeriods.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [            
            'code' => 'required|unique:registration_periods',
            'title' => ['required',
                        Rule::unique('registration_periods')
                            ->where('team_id', currentTeamId())->whereNull('deleted_at'),  
                        ],
        ]);
        
        $type = RegistrationPeriod::create([            
            'code' => $request->get('code'),
            'title' => $request->get('title'),
            'period' => $request->get("period"),
            'team_id' => auth()->user()->current_team_id,
        ]);
        
        return redirect(route('registrationPeriods.index'))->with('success', trans('general.x_has_been_created', ['x' => $type->title]));
    }

    public function edit($type)
    {        
        return view('administrator.registrationPeriods.edit', compact('type'));
    }

    public function update(Request $request, $type)
    {
        $this->validate($request, [
            'code' => [
                'required',
                Rule::unique('registration_periods')->where('team_id', currentTeamId())->ignore($type->id),
            ],
            'title' => ['required',
                        Rule::unique('registration_periods')
                            ->ignore($type->id)
                            ->where('team_id', currentTeamId())->whereNull('deleted_at'),  
                        ],
            
        ]);

        $type->update([
            'code' => $request->get('code'),
            'title' => $request->get('title'),
            'period' => $request->get("period")            
        ]);

        if ($request->has('default')) {
            $type->setDefault();
        }      
        
        return redirect(route('registrationPeriods.index'))->with('success', trans('general.x_has_been_updated', ['x' => $type->title]));
    }

    public function destroy($type)
    {
        $type->delete();
        return redirect(route('registrationPeriods.index'))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.registration_period')]));
    }
}