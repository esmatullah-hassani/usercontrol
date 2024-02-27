<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\DataTables\ContactsDataTable;
use Illuminate\Validation\Rule;

class ContactsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:administrator');        
    }
    
    public function index(ContactsDataTable $dataTable)
    {
        return $dataTable->render('administrator.contacts.index');
    }

    public function create()
    {               
        return view('administrator.contacts.create', ['grades' => getGrades()]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user' => 'required',
            'title' => 'required',    
        ]);

        $contact = Contact::create([
            'user_id' => $request->get('user'),
            'title' => $request->get('title'),            
            'team_id' => auth()->user()->current_team_id,
        ]);        
        
        return redirect(route('contacts.index'))->with('success', trans('general.x_has_been_created', ['x' => $contact->title]));
    }

    public function edit($id)
    {
        $contact = Contact::find($id);
        return view('administrator.contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [            
            'user' => 'required',
            'title' => 'required',            
        ]);
        $contact = Contact::find($id);
        
        $contact->update([
            'user_id' => $request->get('user'),
            'title' => $request->get('title'),
        ]);    
        
        return redirect(route('contacts.index'))->with('success', trans('general.x_has_been_updated', ['x' => $contact->title]));
    }

    public function destroy($id)
    {
        Contact::destroy($id);
        return redirect(route('contacts.index'))->with('success', trans('general.x_has_been_deleted', ['x' => trans('general.department')]));
    }
}