<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\DataTables\ShiftsDataTable;
use Illuminate\Validation\Rule;

class ShiftsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:administrator');        
    }
    
    public function index(ShiftsDataTable $dataTable)
    {
        return $dataTable->render('administrator.shifts.index');
    }

    public function create()
    {                
        return view('administrator.shifts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [            
            'code' => 'required|unique:shifts',
            'title' => 'required',
            'from-to' => 'required',
        ]);

        $shift = Shift::create([            
            'code' => $request->get('code'),
            'title' => $request->get('title'),
            'from-to' => $request->get('from-to'),
            'color' => $request->get('color'),
            'team_id' => auth()->user()->current_team_id,
        ]);

        if ($shift->courses()->exists()) {
            $shift->courses()->update([
                'shift_title' => $shift->title
            ]);
        }
        
        if ($request->has('default')) {
            $shift->setDefault();
        }
        
        return redirect(route('shifts.index'))->with('success', trans('general.x_has_been_created', ['x' => $shift->title]));
    }

    public function edit($shift)
    {        
        return view('administrator.shifts.edit', compact('shift'));
    }

    public function update(Request $request, $shift)
    {
        $this->validate($request, [
            'code' => [
                'required',
                Rule::unique('shifts')->where('team_id', currentTeamId())->ignore($shift->id),
            ],
            'title' => 'required',
            'from-to' => 'required',
        ]);

        $shift->update([
            'code' => $request->get('code'),
            'title' => $request->get('title'),
            'from-to' => $request->get('from-to'),
            'color' => $request->get('color')       
        ]);

        if ($request->has('default')) {
            $shift->setDefault();
        }      
        
        return redirect(route('shifts.index'))->with('success', trans('general.x_has_been_updated', ['x' => $shift->title]));
    }

    public function destroy($shift)
    {
        $shift->delete();
        return redirect(route('shifts.index'))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.shift')]));
    }
}