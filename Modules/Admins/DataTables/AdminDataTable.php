<?php

namespace Modules\Admins\DataTables;

use Yajra\DataTables\EloquentDataTable;
use Modules\Admins\Entities\Admin;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query results from query() method
     *
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        
        if(auth()->user()->id !=1){
             $dataTable = new EloquentDataTable($query->where('company_id',auth()->user()->company_id));
            
        }
       
     $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addIndexColumn()
            ->editColumn('name', function ($request) {
                return $request->name ? ucwords($request->name) : 'N/A';
            })
            
            ->editColumn('email', function ($request) {
                return $request->email ? $request->email : 'N/A';
            })
            ->addColumn('roles', function ($request) {
                if (!$request->roles) {
                    return '(not set)';
                }

                $roles = [];

                foreach ($request->roles as $role) {
                    $roles[] = '<div class="badge badge-info">' . ucwords($role->title) . '</div>';
                }

                return implode(', ', $roles);
            })
            ->addColumn('action', 'backend.admins.datatables_actions')
            ->rawColumns(['action', 'roles']);

        // return $request->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Admins\Entities\Admin $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Admin $model)
    {
        return $model->newQuery()->where('id','!=',1);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    // ['extend' => 'create', 'className' => 'btn btn-primary btn-sm no-corner'],
                    ['extend' => 'export', 'className' => 'btn btn-warning btn-sm no-corner'],
                    ['extend' => 'print', 'className' => 'btn btn-success btn-sm no-corner'],
                    ['extend' => 'reset', 'className' => 'btn btn-dark btn-sm no-corner'],
                    ['extend' => 'reload', 'className' => 'btn btn-outline-dark btn-sm no-corner'],
                ],
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
            'S/No' => new Column([
                'data'  => 'DT_RowIndex',
                'name'  => 'id',
                'title' => 'S/No',
            ]),

            'name' => new Column([
                'data'  => 'name',
                'name'  => 'name',
                'title' => 'FullName',
            ]),

            'email' => new Column([
                'data'  => 'email',
                'name'  => 'email',
                'title' => 'E-mail',
            ]),

            'phone_no' => new Column([
                'data'  => 'phone_no',
                'name'  => 'phone_no',
                'title' => 'Mobile_Number',
            ]),

            'roles' => new Column([
                'data'  => 'roles',
                'name'  => 'roles',
                'title' => 'Roles',
            ]),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'admins_datatable_' . time();
    }
}
