<?php

namespace Modules\Recruitments\DataTables;

use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Modules\Recruitments\Entities\Payroll;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class PayrollDataTable extends DataTable
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
            ->editColumn('description', function ($request) {
                return $request->description ? ucwords($request->description) : 'N/A';
            })
             ->editColumn('basic_pay', function ($request) {
                return $request->basic_pay ? number_format($request->basic_pay,2).'/=' : '0.00';
            })
             
             ->editColumn('nssf', function ($request) {
                return $request->nssf ? number_format($request->nssf,2).'/=' : '0.00';
            })
             ->editColumn('paye', function ($request) {
                return $request->paye ? number_format($request->paye,2).'/=' : '0.00';
            })
             ->editColumn('net_pay', function ($request) {
                return $request->net_pay ? number_format($request->net_pay,2).'/=' : '0.00';
            })
             ->editColumn('nhif', function ($request) {
                return $request->nhif ? number_format($request->nhif,2).'/=' : '0.00';
            })
            ->editColumn('Amount', function ($request) {
                return $request->basic_pay ? number_format($request->basic_pay - ($request->nssf+$request->paye+$request->nhif),2).'/=' : '0.00';
            })
             ->editColumn('started_at', function ($request) {
                return $request->started_at ?$request->started_at : '0.00';
            })
             ->editColumn('ended_at', function ($request) {
                return $request->ended_at ? $request->ended_at : '0.00';
            })
            ->addColumn('action', 'backend.payrolls.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Recruitments\Entities\Payroll $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Payroll $model)
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
             'employee_id' => new Column([
                'data'  => 'employee_id',
                'name'  => 'employee_id',
                'title' => 'Name',
            ]),

            
            'basic_pay' => new Column([
                'data'  => 'basic_pay',
                'name'  => 'basic_pay',
                'title' => 'basic_pay',
            ]),
            
             'nssf' => new Column([
                'data'  => 'nssf',
                'name'  => 'nssf',
                'title' => 'nssf',
            ]),
            'paye' => new Column([
                'data'  => 'paye',
                'name'  => 'paye',
                'title' => 'paye',
            ]),
            'nhif' => new Column([
                'data'  => 'nhif',
                'name'  => 'nhif',
                'title' => 'nhif',
            ]),
             'Amount' => new Column([
                'data'  => 'Amount',
                'name'  => 'Amount',
                'title' => 'Amount',
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
           


        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'payrolls_datatable_' . time();
    }
    
}
