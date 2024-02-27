<?php

namespace App\DataTables;

use App\Models\Account;
use App\DataTables\Yajra\Services\DataTable;

class AccountsDataTable extends DataTable
{
    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->editColumn('balance', function ($account) {         
                return number_format($account->balance);
            })
            ->editColumn('default', function ($account) {         
                return $account->default ? "<i class='fa fa-check'></i>" : "";
            })
            ->editColumn('is_active',function ($account){
                $active ='';
                switch ($account->is_active){
                    case 1:$active = "<span class=' bold'>".__('general.active')."</span>";
                    break;
                    default: $active  = "<span class='text-default bold'>".__('general.inactive')."</span>";
                }

                return $active;
            })
            ->addColumn('action', function ($account) {
                $html = '';
                $html .= '<a href="'. route('accounts.edit',['account'=> $account]) .'" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i> '.trans("general.edit").' </a>';
                
                if (! $account->transactions()->exists())
                $html .= '<form action="'. route('accounts.destroy',['account'=> $account]) .'" method="post" style="display:inline">
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()"><i class="fa fa-trash"></i> '.trans("general.delete").' </button>
                        </form>';
                return $html;
            })
            ->rawColumns(['default','balance','action','is_active'])
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Account::query();

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
                    ->columns($this->getColumns())->parameters(['language' => ['url' => asset('/vendor/datatables/Dari.json')]])->parameters(['language' => ['url' => asset('/vendor/datatables/Dari.json')]])
                    ->parameters([
                        'order' => [['0', 'desc']],
                        'stateSave' => 'true',
                        'dom'     => 'lBrftip',
                        'buttons' => [
                            'buttons' => [                            
                                [ 'extend' => 'reload', 'className' => 'btn btn-default btn-xs', 'text' => trans('general.reload') ],
                                [ 'extend'=> 'excel', 'className'=> 'btn btn-default btn-xs', 'text' => trans('general.excel') ]
                                ]
                            ],
                        'initComplete' => "function () {                                                                                      
                            $('#dataTableBuilder').wrap('<div class=\"table-responsive\"></div>');
                        }",                                                       
                    ])
                    ->addAction(['width' => '120px', 'title' => trans('general.actions')]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [           
            ['data' => 'title',    'name' => 'title',    'title' => trans('general.title')],
            ['data' => 'balance',  'name' => 'balance',  'title' => trans('general.balance'), 'class' => 'ltr'],
            ['data' => 'default',  'name' => 'default',   'title' => trans('general.default')], 
            ['data' => 'is_active', 'name' => 'is_active', 'title' => trans('general.state')],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AccountsDatatables_' . jalaliDate();
    }
}
