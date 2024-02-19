<?php

namespace Modules\Recruitments\DataTables;

use DB;
use Modules\Recruitments\Entities\Bankfile;
use Modules\Recruitments\Entities\Employee;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Payroll;
use Modules\Recruitments\Entities\Salary;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class BankfileDataTable extends DataTable
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
        $first_date = date('Y-m-d',strtotime('first day of this month'));

        $dataTable = new EloquentDataTable($query);


        return $dataTable
            ->addIndexColumn()
            ->addColumn('id', function ($request) {
                return $request->id? $request->id: 'N/A';
                
            }) ->editColumn('name', function ($request) {
                return $request->name ?  $request->name : 'N/A';
            })
           
            ->editColumn('amount', function ($request) {
                return $request->amount ? number_format($request->amount) : 'N/A';
            })
            ->editColumn('bank_name', function ($request) {
                return $request->bank_name ? strtoupper($request->bank_name): 'N/A';
            })
            ->addColumn('description', function ($request) {
                $first_date = date('Y-m-d',strtotime('first day of this month'));
                $time=strtotime($first_date);
                $month=date("F",$time);
                $year=date("Y",$time);
                return 'SALARY '. strtoupper($month)." ". $year;
            })
            //  ->addColumn('action', 'backend.bankfiles.datatables_actions')
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Recruitments\Entities\Salary $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
    {
        $first_date = date('Y-m-d',strtotime('first day of this month'));
        return $model->newQuery() 
        ->select('employees.id as id','employees.name as name','employees.bank_account as bank_account',
        'payrolls.basic_pay as amount','employees.bank_name as bank_name')
        ->join('payrolls', 'payrolls.employee_id', '=', 'employees.id')
        ->where('payrolls.started_at',$first_date)
        ->wherein('loans.started_at',$first_date)
        ;
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
                'title' => 'id',
            ]),
             'id' => new Column([
                'data'  => 'id',
                'name'  => 'id',
                'title' => 'id',
            ]),
             'name' => new Column([
                'data'  => 'name',
                'name'  => 'name',
                'title' => 'name',
            ]),

            'bank_name' => new Column([
                'data'  => 'bank_name',
                'name'  => 'bank_name',
                'title' => 'bank_name',
            ]),

            'amount' => new Column([
                'data'  => 'amount',
                'name'  => 'amount',
                'title' => 'amount',
            ]),

             'bank_name' => new Column([
                'data'  => 'bank_name',
                'name'  => 'bank_name',
                'title' => 'bank_name',
            ]),
        'description' => new Column([
                'data'  => 'description',
                'name'  => 'description',
                'title' => 'description',
            ]),
            
                   ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    // protected function filename(): string
    // {
    //     return 'bankfiles_datatable_' . time();
    // }
}
