<?php

namespace App\DataTables;

use DCN\RBAC\Models\Role;
use App\DataTables\Yajra\Services\DataTable;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;

class RolesDataTable extends DataTable
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
            ->addColumn('action', function ($role) {
                $html = '';                
                $html .= '<a href="'. route('rolePermissions.edit', $role) .'" class="btn btn-xs btn-default"> '.trans("general.permissions").' </a>';
                $html .= '<a href="'. route('roles.edit', $role) .'" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i>  </a>';                            
                $html .= '<form action="'. route('roles.destroy', $role) .'" method="post" style="display:inline">
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <button type="submit" class="btn btn-xs btn-danger" onClick="doConfirm()"><i class="fa fa-trash"></i>  </button>
                        </form>';
                return $html;
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by dataTables.
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
     */
    public function query()
    {
        $query = Role::select('id', 'name', 'slug', 'description')->whereNotIn('id', [1]);

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
                    ->addAction(['width' => '100px', 'title' => trans('general.actions')]);
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
            ['data' => 'description', 'name' => 'description','title' => trans('general.description')], 
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'RolesDatatables_' . str_replace('/','-',jalaliDate());
    }
}
