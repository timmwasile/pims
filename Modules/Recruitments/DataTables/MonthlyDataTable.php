<?php

namespace Modules\Recruitments\DataTables;

use Modules\Recruitments\Entities\Deduction;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Modules\Recruitments\Entities\Monthly;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class MonthlyDataTable extends DataTable
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
             ->editColumn('number', function ($request) {
                return $request->employeeId ? ucwords($request->employeeId->number) : 'N/A';
            })
            ->editColumn('payment_id', function ($request) {
                if($request->transaction_type == 0){
                    $deduction=Deduction::where('id',$request->payment_id)->get()->first();
                return $request->paymentId ? ucwords($deduction->name) : 'N/A';

                }else{
                return $request->paymentId ? ucwords($request->paymentId->name) : 'N/A';
                }
            })
             ->editColumn('amount', function ($request) {
                return $request->amount ? number_format($request->amount,2).'/=' : '0.00';
            })
              ->editColumn('started_at', function ($request) {
                return $request->started_at ? date("d F, Y", strtotime($request->started_at)) : 'N/A';
            })
             ->editColumn('ended_at', function ($request) {
                return $request->ended_at ? date("d F, Y", strtotime($request->ended_at)) : 'N/A';
            })
             ->addColumn('transaction_type', function ($request) {
                    return $request->transaction_type == 0 ? ucwords('deduction') : ucwords('payment');
               
            })
             ->addColumn('is_static', function ($request) {
                    return $request->is_static == 1 ? ucwords('static') :  ucwords('dynamic');
                
            })
            ->addColumn('action', 'backend.monthlies.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Recruitments\Entities\Monthly $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Monthly $model)
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

                'number' => new Column([
                'data'  => 'number',
                'name'  => 'number',
                'title' => 'Employee Number',
            ]),

            'employee_id' => new Column([
                'data'  => 'employee_id',
                'name'  => 'employee_id',
                'title' => 'Employee Name',
            ]),
              'transaction_type' => new Column([
                'data'  => 'transaction_type',
                'name'  => 'transaction_type',
                'title' => 'Type of Transaction',
            ]),

              'is_static' => new Column([
                'data'  => 'is_static',
                'name'  => 'is_static',
                'title' => 'Nature',
            ]),

             'payment_id' => new Column([
                'data'  => 'payment_id',
                'name'  => 'payment_id',
                'title' => 'Payment',
            ]),
            'amount' => new Column([
                'data'  => 'amount',
                'name'  => 'amount',
                'title' => 'Amount',
            ]),
            
            'started_at' => new Column([
                'data'  => 'started_at',
                'name'  => 'started_at',
                'title' => 'Started At',
            ]),
            'ended_at' => new Column([
                'data'  => 'ended_at',
                'name'  => 'ended_at',
                'title' => 'Ended At',
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
        return 'monthlies_datatable_' . time();
    }
}
