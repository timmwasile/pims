<?php

namespace Modules\Recruitments\DataTables;

use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Modules\Recruitments\Entities\Taxe;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class TaxeDataTable extends DataTable
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
                return $request->createdBy ? ucwords($request->name) : 'N/A';
            })
             ->editColumn('employee_id', function ($request) {
                return $request->employeeId ? ucwords($request->employeeId->name) : 'N/A';
            })
             ->editColumn('rate', function ($request) {
                return $request->rate ? $request->rate : 'N/A';
            })
            ->editColumn('description', function ($request) {
                return $request->description ? ucwords($request->description) : 'N/A';
            })
             ->editColumn('max_amount', function ($request) {
                return $request->max_amount ? number_format($request->max_amount,2).'/=' : '0.00';
            })
            ->editColumn('min_amount', function ($request) {
                return $request->min_amount ? number_format($request->min_amount,2).'/=' : '0.00';
            })
             ->addColumn('action', 'backend.taxes.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Recruitments\Entities\Taxe $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Taxe $model)
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

            'description' => new Column([
                'data'  => 'description',
                'name'  => 'description',
                'title' => 'Taxe Description',
            ]),

            'max_amount' => new Column([
                'data'  => 'max_amount',
                'name'  => 'max_amount',
                'title' => 'max_amount',
            ]),
            'min_amount' => new Column([
                'data'  => 'min_amount',
                'name'  => 'min_amount',
                'title' => 'min_amount',
            ]),
            
            
            'rate' => new Column([
                'data'  => 'rate',
                'name'  => 'rate',
                'title' => 'rate',
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
        return 'taxes_datatable_' . time();
    }
}
