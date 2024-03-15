<?php

namespace Modules\Recruitments\DataTables;

use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Modules\Recruitments\Entities\MarketingOfficer;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class MarketingOfficerDataTable extends DataTable
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
        // $dataTable = new EloquentDataTable($query);
        $dataTable = new EloquentDataTable($query->where('company_id',auth()->user()->company_id));


        return $dataTable
            ->addIndexColumn()
            ->editColumn('created_by', function ($request) {
                return $request->createdBy ? ucwords($request->createdBy->name) : 'N/A';
            })
            
             ->editColumn('name', function ($request) {
                return $request->name ? strtoupper($request->name)    : 'N/A';
            })
            ->editColumn('nida', function ($request) {
                return $request->nida ? strtoupper($request->nida)    : 'N/A';
            })
            ->editColumn('address', function ($request) {
                return $request->address ? strtoupper($request->address)    : 'N/A';
            })
            ->editColumn('description', function ($request) {
                return $request->description ? strtoupper($request->description)    : 'N/A';
            })
            ->editColumn('mobile', function ($request) {
                return $request->mobile ? $request->mobile   : 'N/A';
            })
             ->addColumn('action', 'backend.marketing_officers.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Recruitments\Entities\MarketingOfficer $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MarketingOfficer $model)
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
                'dom'       => 'lBfrtip',
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
                'title' => 'Full Name',
            ]),

            'description' => new Column([
                'data'  => 'description',
                'name'  => 'description',
                'title' => 'Description',
            ]),
             'nida' => new Column([
                'data'  => 'nida',
                'name'  => 'nida',
                'title' => 'NIDA',
            ]),
             'mobile' => new Column([
                'data'  => 'mobile',
                'name'  => 'mobile',
                'title' => 'Mobile Number',
            ]),
             'address' => new Column([
                'data'  => 'address',
                'name'  => 'address',
                'title' => 'Address',
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
        return 'marketing_officers_datatable_' . time();
    }
}
