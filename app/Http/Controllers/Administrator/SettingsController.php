<?php

namespace App\Http\Controllers\Administrator;

use App\Models\StudentCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\StudentStatus;
use App\Models\RegistrationType;
use App\Models\RegistrationPeriod;
use App\Models\TransactionCategory;
use App\DataTables\IncomeCategoriesDataTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:administrator');        
    }
    
    public function index()
    {
        $studentStatuses = StudentStatus::pluck('title', 'id');
        $registrationTypes = RegistrationType::pluck('title', 'id');
        $registrationPeriods = RegistrationPeriod::pluck('title', 'id');
        $note = StudentCard::first();
        return view('administrator.settings', compact(
            'studentStatuses',
            'registrationTypes',
            'registrationPeriods',
            'note'
        ));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'student_number_format' => 'required',
            'student_code_format' => 'required'
        ]);        

        $all = $request->except(['_method', '_token']);
                
        foreach ($all as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key, 'team_id' => currentTeamId()],
                ['value' => $value]
            );
        }

        $note = StudentCard::first();
        if ($note){
            $note->update([
                'note'=>$request->get('student_card_note')
            ]);
        }
        else{
            StudentCard::create([
                'note'=>$request->get('student_card_note')
            ]);
        }

        return redirect()->back()->with('success', trans('general.x_has_been_updated', ['x' => trans('general.settings')]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createSettingColor()
    {
        return view('developer.system.setting.index');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSettingColor(Request $request)
    {
        if($request->has('menubar_default'))
        {
            Setting::updateOrCreate(
                ['key' => "menubar_color".Auth::id(), 'team_id' => currentTeamId()],
                ['value' => NULL]
            );
        }
        else{
            Setting::updateOrCreate(
                ['key' => "menubar_color".Auth::id(), 'team_id' => currentTeamId()],
                ['value' => $request->menubar_color]
            );
        }
        if($request->has('sidebar_default'))
        {
            Setting::updateOrCreate(
                ['key' => "sidebar_color".Auth::id(), 'team_id' => currentTeamId()],
                ['value' => NULL]
            );
        }
        else{
            Setting::updateOrCreate(
                ['key' => "sidebar_color".Auth::id(), 'team_id' => currentTeamId()],
                ['value' => $request->sidebar_color]
            );
        }
        return redirect()->back()->with('success', trans('general.x_has_been_updated', ['x' => trans('general.settings')]));        

    }
}