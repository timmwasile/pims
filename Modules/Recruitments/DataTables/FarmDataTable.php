<?php

namespace Modules\Recruitments\DataTables;

use Illuminate\Support\Facades\DB;
use Modules\Recruitments\Entities\Farm;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Project;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class FarmDataTable extends DataTable
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

        $dataTable = new EloquentDataTable($query->where('farms.company_id',auth()->user()->company_id));


        return $dataTable
            ->addIndexColumn()
            ->editColumn('created_by', function ($request) {
                return $request->createdBy ? ucwords($request->createdBy->name) : 'N/A';
            })


             ->editColumn('name', function ($request) {
                return $request->name ? strtoupper($request->name)    : 'N/A';
            })
            ->editColumn('location', function ($request) {
                return $request->location ? strtoupper($request->location)    : 'N/A';
            })
            ->editColumn('code', function ($request) {
                return $request->code ? strtoupper($request->code)    : 'N/A';
            })

            ->editColumn('size', function ($request) {
                return $request->size ? number_format($request->size).' Acres'    : 'N/A';
            })
            //  ->addColumn('remaining', function ($request) {
            //     return $request->remaining ? number_format($request->remaining)     : 'N/A';
            // })
             ->addColumn('baki', function ($request) {
                return $request->size - $request->remaining  ? number_format($request->size - $request->remaining) .' Acres'    : 'N/A';
            })
            ->addColumn('sold', function ($request) {
                return $request->sold ? number_format($request->sold)     : 'N/A';
            })
            ->editColumn('amount', function ($request) {
                return $request->amount ? number_format($request->amount,2)."/="    : 'N/A';
            })
            ->editColumn('description', function ($request) {
                return $request->description ? strtoupper($request->description)    : 'N/A';
            })
            // ->editColumn('number_of_plots', function ($request) {
            //     return $request->number_of_plots ? $request->number_of_plots   : 'N/A';
            // })
            // ->editColumn('initial', function ($request) {
            //     return $request->initial ? strtoupper($request->initial)    : 'N/A';
            // })
             ->addColumn('action', 'backend.farms.datatables_actions')
             ->filterColumn('created_by', function($query, $keyword) {
                $query->whereHas('createdBy', function($subQuery) use ($keyword) {
                    $subQuery->where('name', 'like', "%{$keyword}%");
                });
            })

                ;
    }


    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Recruitments\Entities\Project $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Farm $model)
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
                'title' => 'Project Name',
            ]),

            'location' => new Column([
                'data'  => 'location',
                'name'  => 'location',
                'title' => 'Project Location',
            ]),
             'size' => new Column([
                'data'  => 'size',
                'name'  => 'size',
                'title' => 'Total Project Size (Acre)',
            ]),
            // 'remaining' => new Column([
            //     'data'  => 'remaining',
            //     'name'  => 'remaining',
            //     'title' => 'SQM Sold Out',
            // ]),
            'baki' => new Column([
                'data'  => 'baki',
                'name'  => 'baki',
                'title' => 'Acres Remaining',
            ]),
            // 'sold' => new Column([
            //     'data'  => 'sold',
            //     'name'  => 'sold',
            //     'title' => 'Plot(s) Sold Out',
            // ]),
             'amount' => new Column([
                'data'  => 'amount',
                'name'  => 'amount',
                'title' => 'Amount Per Acre',
            ]),
            //  'initial' => new Column([
            //     'data'  => 'initial',
            //     'name'  => 'initial',
            //     'title' => 'Project Initial',
            // ]),

             'created_by' => new Column([
                'data'  => 'created_by',
                'name'  => 'created_by',
                'title' => 'Added By',
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
        return 'farms_datatable_' . time();
    }
}
