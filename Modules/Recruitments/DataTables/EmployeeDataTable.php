<?php

namespace Modules\Recruitments\DataTables;

use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Modules\Recruitments\Entities\Employee;
use Yajra\DataTables\Html\Column;

class EmployeeDataTable extends DataTable
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
            ->editColumn('office_id', function ($request) {
                 return $request->officeName ? ucwords($request->officeName->name) : 'N/A';
            })
             ->editColumn('jobtitle_id', function ($request) {
                 return $request->JobtitleName ? ucwords($request->JobtitleName->name) : 'N/A';
            })
             ->editColumn('bank_id', function ($request) {
                 return $request->BankName ? strtoupper($request->BankName->name) : 'N/A';
            })
            ->editColumn('gender_id', function ($request) {
                 return $request->GenderName ? strtoupper($request->GenderName->name) : 'N/A';
            })
            ->editColumn('name', function ($request) {
                return $request->name ? ucwords($request->name) : 'N/A';
            })
             ->editColumn('basic_salary', function ($request) {
                return $request->basic_salary ? number_format($request->basic_salary,2).'/=' : '0.00';
            })
            ->addColumn('action', 'backend.employees.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Recruitments\Entities\Employee $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
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
                'title' => 'name',
            ]),

            'number' => new Column([
                'data'  => 'number',
                'name'  => 'number',
                'title' => 'number',
            ]),
            'basic_salary' => new Column([
                'data'  => 'basic_salary',
                'name'  => 'basic_salary',
                'title' => 'Basic Salary',
            ]),
            'bank_account' => new Column([
                'data'  => 'bank_account',
                'name'  => 'bank_account',
                'title' => 'Bank Account',
            ]),
            'bank_id' => new Column([
                'data'  => 'bank_id',
                'name'  => 'bank_id',
                'title' => 'Bank Name',
            ]),
            'jobtitle_id' => new Column([
                'data'  => 'jobtitle_id',
                'name'  => 'jobtitle_id',
                'title' => 'Jobtitle',
            ]),
  'office_id' => new Column([
                'data'  => 'office_id',
                'name'  => 'office_id',
                'title' => 'Office',
            ]),
  'bank_id' => new Column([
                'data'  => 'bank_id',
                'name'  => 'bank_id',
                'title' => 'Bank',
            ]),
              'gender_id' => new Column([
                'data'  => 'gender_id',
                'name'  => 'gender_id',
                'title' => 'Gender',
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
        return 'employees_datatable_' . time();
    }
}
