<?php

namespace App\DataTables;

use App\Models\User;
use App\DataTables\Yajra\Services\DataTable;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Illuminate\Support\Facades\DB;

class UsersDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return datatables()
            ->eloquent($this->query())
            ->editColumn('name', function ($user) {
                return auth()->user()->may('users.view') ? 
                        '<a href="'. route('users.show', $user) .'" > '.$user->name.' </a>' :
                        $user->name;
            })
            ->editColumn('active', function ($user) {                
                return $user->active ? "<span class='badge badge-success'>".trans('general.active')."</span>" : "<span class='badge badge-danger'>".trans('general.inactive')."</span>";
            })
            ->addColumn('action', function ($user) {
                $html = '<div class="btn-group">
                <a class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"> '.trans('general.actions').'
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right">'; 
                if (auth()->user()->may('users.cards.id'))

                $html .= '<li>
                        <form action="'. route('users.cards.id',['user'=> $user->id]) .'" method="post" target="_new" style="display:inline">
                            <input type="hidden" name="_method" value="POST" />
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <input type="hidden" name="certificate_duration" value="" />
                            <button type="submit" class="btn-link certificate-duration" >'.trans("general.id_card").'</button>
                        </form>
                    </li>';
                if(auth()->user()->may('users.impersonate'))
                    $html .= ' <li><a href="'. route('impersonate', $user) .'" class="btn btn-xs btn-default"><i class="fa fa-sign-in"></i> '.trans("general.impersonate").' </a></li>';

                if(auth()->user()->may('users.update'))
                    $html .= ' <li><a href="'. route('users.roles.edit', $user) .'" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i> '.trans("general.roles").' </a></li>';

                if(auth()->user()->may('users.update'))
                    $html .= ' <li><a href="'. route('users.edit', $user) .'" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i> '.trans("general.edit").' </a></li>';                

                if(auth()->user()->may('users.destroy'))
                    $html .= '<li><form action="'. route('users.destroy', $user) .'" method="post" style="display:inline">
                                <input type="hidden" name="_method" value="DELETE" />
                                <input type="hidden" name="_token" value="'.csrf_token().'" />
                                <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()"><i class="fa fa-trash"></i> '.trans("general.delete").' </button>
                            </form></li>';

                $html .= '</ul>
                        </div>';
                return $html;
            })
            ->rawColumns(['action','active','name'])
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = User::select('users.id', 'name', 'last_name', 'active','id_card')
        ->join('role_user', function ($join) {
            $join->on('role_user.user_id', '=', 'users.id');
        });        

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())->parameters(['language' => ['url' => asset('/vendor/datatables/Dari.json')]])                    
            ->addAction(['title' => trans('general.actions'), 'width' => '40px'])
            ->ajax([
                'url' => '',
            ])                    
            ->parameters([                        
                'stateSave' => true,
                'order' => [['0', 'desc']],                                                                
                'dom'          => 'lBrtip',
                'buttons'      => [
                    'buttons' => [
                        [ 'extend' => 'reload', 'className' => 'btn btn-default btn-xs', 'text' => trans('general.reload') ],
                        [ 'extend'=> 'excel', 'className'=> 'btn btn-default btn-xs', 'text' => trans('general.excel') ]
                    ]
                ],
                'initComplete' => "function (settings, data) {   
                    emptyValue = '';                                     
                    table = this      
                    state = table.api().state.loaded()                        
                    
                    if(!state || state.columns[0].search.search == '')        
                        $('a[data-status-id=\"all\"]').parent().addClass('active')
                    else
                        $('a[data-status-id=\"'+state.columns[0].search.search+'\"]').parent().addClass('active')

                    table.api().columns().every(function () {
                        var column = this;
                        var onEvent = 'change';
                                                                                                            
                        if(this.index() >= 0 && this.index() <= 2) { 
                            if (this.index() == 0 || this.index() == 2) {
                                $('<input class=\"datatable-footer-input ltr\" placeholder=\"'+$(column.header()).text()+'\" name=\"'+ column.index() + '\" value=\"'+ (state ? state.columns[this.index()].search.search : emptyValue) +'\" />').appendTo($(column.footer()).empty())                                        
                                .on(onEvent, function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            } else {
                                $('<input class=\"datatable-footer-input\" placeholder=\"'+$(column.header()).text()+'\" name=\"'+ column.index() + '\" value=\"'+ (state ? state.columns[this.index()].search.search : emptyValue) +'\" />').appendTo($(column.footer()).empty())                                        
                                .on(onEvent, function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            }   
                        }
                    });   

                    $('a.student-status').click(function () {
                        if ($(this).attr('data-status-id') == 'all')
                            table.api().columns(0).search('', false, false, true).draw();
                        else
                            table.api().columns(0).search($(this).attr('data-status-id'), false, false, true).draw();
                    });                            
                        
                    $('#dataTableBuilder').wrap('<div class=\"table-responsive\"></div>');
                    $('#check-all').change(function () {                                
                        $('input:checkbox').prop('checked', $(this).prop('checked'));
                    });                           
                }",
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [            
            ['data' => 'name',        'name' => 'name',       'title' => trans('general.name')],
            ['data' => 'id_card',        'name' => 'id_card',       'title' => trans('general.id_card')],
            ['data' => 'last_name',   'name' => 'last_name',  'title' => trans('general.last_name')], 
            ['data' => 'active',           'name' => 'users.active',                      'title' => trans('general.user_account'), 'searchable' => false],      
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'UsersDatatables_' . str_replace('/','-',jalaliDate());
    }
}
