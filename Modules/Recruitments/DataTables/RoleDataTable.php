<?php

namespace Modules\Recruitments\DataTables;

use Yajra\DataTables\EloquentDataTable;
use Modules\Recruitments\Entities\Role;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
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
        $dataTable = new EloquentDataTable($query->with([
            'permissions'
        ]));

        return $dataTable
            ->addIndexColumn()
            ->editColumn('name', function ($request) {
                return $request->title ? ucwords($request->title) : 'N/A';
            })
            ->addColumn('permissions', function ($row) {
                if (!$row->permissions) {
                    return '(not set)';
                }

                $permissions = [];

                foreach ($row->permissions as $permission) {
                    $permissions[] = '<span class="badge badge-info">' . $permission->title . '</span>';
                }

                return implode(', ', $permissions);
            })
            ->addColumn('action', 'backend.roles.datatables_actions')

            ->rawColumns(['action', 'permissions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Recruitments\Entities\role $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        return $model->newQuery();
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
                    ['extend' => 'create', 'className' => 'btn btn-primary btn-sm no-corner'],
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
                'title' => 'Title',
            ]),

            'permissions' => new Column([
                'data'  => 'permissions',
                'name'  => 'permissions',
                'title' => 'Permissions',
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
        return 'role_datatable_' . time();
    }
}
