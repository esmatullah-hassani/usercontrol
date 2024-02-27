<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Building;
use App\DataTables\BuildingsDataTable;

class BuildingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:administrator');        
    }

    public function index(BuildingsDataTable $dataTable)
    {
        return $dataTable->render('administrator.buildings.index');
    }

    public function create()
    {                
        return view('administrator.buildings.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [            
            'title' => 'required|max:50',        
        ]);

        $building = Building::create([            
            'title' => $request->get('title'),
            'team_id' => currentTeamId(),
        ]);
        
        return redirect(route('buildings.index'))->with('success', trans('general.x_has_been_created', ['x' => $building->title]));
    }

    public function edit($building)
    {        
        return view('administrator.buildings.edit', compact('building'));
    }

    public function update(Request $request, $building)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
        ]);

        $building->update([
            'title' => $request->get('title')    
        ]);

        return redirect(route('buildings.index'))->with('success', trans('general.x_has_been_updated', ['x' => $building->title]));
    }

    public function destroy($building)
    {
        $building->delete();
        return redirect(route('buildings.index'))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.building')]));
    }
}