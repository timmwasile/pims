<?php

namespace Modules\Recruitments\DataTables;

use DB;
use Modules\Payrolls\Entities\Payroll;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Salary;
use Modules\Recruitments\Entities\Standard;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;



class PayslipDataTable extends DataTable
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
            ->editColumn('employee_id', function ($request) {
               return $request->employee_id ? ucwords($request->name) : 'N/A';
            })
            //  ->addColumn('name', function ($request) {
            //    return $request->Employee->name ? ucwords($request->Employee->name) : 'N/A';
            // })
            ->editColumn('started_at', function ($request) {
                return $request->started_at ? date('d F, Y (l)',strtotime($request->started_at))     : 'N/A';
            })
            ->editColumn('ended_at', function ($request) {
                return $request->ended_at ? date('d F, Y (l)',strtotime($request->ended_at)) : 'N/A';
            })
             ->addColumn('action', 'backend.payslips.datatables_actions');
    }                  
    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Recruitments\Entities\Salary $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Standard $model)
    {
        Salary::get()->first()->id;
        $lastRecord = Salary::latest()->first()->id;

         return $model->newQuery()
        ->select('employees.name as name', 
        'employees.id as id',
        'standards.started_at','standards.salary_id',
        'standards.ended_at')
        ->leftjoin('employees', 'employees.id', '=', 'standards.employee_id')
        ->where('standards.salary_id',$lastRecord)
        ->orderBy('standards.salary_id', 'desc')
        ->groupBy('standards.employee_id')
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
                'title' => 'S/No',
            ]),
             'name' => new Column([
                'data'  => 'name',
                'name'  => 'name',
                'title' => 'Employee_Name',
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
        return 'payslips_datatable_' . time();
    }
}
