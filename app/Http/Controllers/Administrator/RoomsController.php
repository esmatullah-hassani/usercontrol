<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;

class RoomsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:administrator');        
    }
    
    public function index($building)
    {
        return view('administrator.buildings.rooms.index', compact('building'));
    }

    public function store(Request $request, $building)
    {
        $this->validate($request, [            
            'title' => 'required|max:50',        
        ]);

        $room = Room::create([            
            'title' => $request->get('title'),
            'building_id' => $building->id,
            'team_id' => currentTeamId(),
        ]);
        
        return redirect(route('rooms.index', $building))->with('success', trans('general.x_has_been_created', ['x' => $room->title]));
    }

    public function edit($building, $room)
    {        
        return view('administrator.buildings.rooms.edit', compact('building', 'room'));
    }

    public function update(Request $request, $building, $room)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
        ]);

        $room->update([
            'title' => $request->get('title')    
        ]);

        return redirect(route('rooms.index', $building))->with('success', trans('general.x_has_been_updated', ['x' => $room->title]));
    }

    public function destroy($building, $room)
    {
        $room->delete();
        return redirect(route('rooms.index', $building))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.room')]));
    }
}