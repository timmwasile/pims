<?php

namespace Modules\Recruitments\DataTables;

use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Salary;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class SalaryDataTable extends DataTable
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
            ->editColumn('created_by', function ($request) {
                return $request->createdBy ? ucwords($request->createdBy->name) : 'N/A';
            })
            
             ->editColumn('started_at', function ($request) {
                return $request->started_at ? date('d F, Y (l)',strtotime($request->started_at))     : 'N/A';
            })
            ->editColumn('ended_at', function ($request) {
                return $request->ended_at ? date('d F, Y (l)',strtotime($request->ended_at)) : 'N/A';
            })
             ->addColumn('downloads', function ($request) {
                return $request->ended_at ? 'export' : 'N/A';
            })
             ->addColumn('action', 'backend.salaries.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Recruitments\Entities\Salary $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Salary $model)
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

            'started_at' => new Column([
                'data'  => 'started_at',
                'name'  => 'started_at',
                'title' => 'started_at',
            ]),

            'ended_at' => new Column([
                'data'  => 'ended_at',
                'name'  => 'ended_at',
                'title' => 'ended_at',
            ]),

             'created_by' => new Column([
                'data'  => 'created_by',
                'name'  => 'created_by',
                'title' => 'created_by',
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
        return 'salaries_datatable_' . time();
    }
}
