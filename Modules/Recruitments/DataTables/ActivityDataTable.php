<?php

namespace Modules\Recruitments\DataTables;

use DB;
use Modules\Recruitments\Entities\Activity;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class ActivityDataTable extends DataTable
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
            ->addColumn('id', function ($request) {
                return $request->id? $request->id: 'N/A';
                
            }) 
            ->editColumn('name', function ($request) {
                return $request->name ?  $request->name : 'N/A';
            })
              ->editColumn('description', function ($request) {
                return $request->description ?  $request->description : 'N/A';
            })
             ->editColumn('budget', function ($request) {
                return $request->budget ?  number_format($request->budget,2) : '0';
            })
             ->editColumn('utilised', function ($request) {
                return $request->utilised ?  number_format($request->utilised,2) : '0';
            })
             ->editColumn('balance', function ($request) {
                return $request->balance ?  number_format($request->balance,2) : '0';
            })
           ->editColumn('created_by', function ($request) {
                return $request->createdBy ?  ucwords($request->createdBy->name) : 'N/A';
            })
          
          
             ->addColumn('action', 'backend.activities.datatables_actions')
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Recruitments\Entities\Salary $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Activity $model)
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
              'description' => new Column([
                'data'  => 'description',
                'name'  => 'description',
                'title' => 'Description',
            ]),
      'budget' => new Column([
                'data'  => 'budget',
                'name'  => 'budget',
                'title' => 'budget',
            ]),
            'balance' => new Column([
                'data'  => 'balance',
                'name'  => 'balance',
                'title' => 'balance',
            ]),
             'utilised' => new Column([
                'data'  => 'utilised',
                'name'  => 'utilised',
                'title' => 'utilised',
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
        return 'activities_datatable_' . time();
    }
}
