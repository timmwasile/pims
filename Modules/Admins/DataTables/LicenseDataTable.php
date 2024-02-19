<?php

namespace Modules\Admins\DataTables;

use Yajra\DataTables\EloquentDataTable;
use Modules\Admins\Entities\License;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LicenseDataTable extends DataTable
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
        $dataTable = new EloquentDataTable($query);


        return $dataTable
            ->addIndexColumn()
            ->editColumn('status_id', function ($request) {
                return $request->status_id ==1 ? 'Active' : 'Expired';
            })
             ->editColumn('company_id', function ($request) {
                return $request->company_id ? ucwords($request->companyId->name) : 'N/A';
            })
            ->editColumn('started_at', function ($request) {
                return $request->started_at ? $request->started_at : 'N/A';
            })
              ->editColumn('ended_at', function ($request) {
                return $request->ended_at ? $request->ended_at : 'N/A';
            })
            
            ->addColumn('action', 'backend.licenses.datatables_actions')
            ->rawColumns(['action']);

        // return $request->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Admins\Entities\Admin $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(License $model)
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
             'company_id' => new Column([
                'data'  => 'company_id',
                'name'  => 'company_id',
                'title' => 'Office Name',
            ]),

            'status_id' => new Column([
                'data'  => 'status_id',
                'name'  => 'status_id',
                'title' => 'Status',
            ]),

            'started_at' => new Column([
                'data'  => 'started_at',
                'name'  => 'started_at',
                'title' => 'From',
            ]),

            'ended_at' => new Column([
                'data'  => 'ended_at',
                'name'  => 'ended_at',
                'title' => 'Expered On',
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
        return 'licenses_datatable_' . time();
    }
}
