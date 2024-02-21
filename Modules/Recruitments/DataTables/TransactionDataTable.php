<?php

namespace Modules\Recruitments\DataTables;

use DB;
use Modules\Recruitments\Entities\Transaction;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Storage;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class TransactionDataTable extends DataTable
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
            ->addColumn('id', function ($request) {
                return $request->id? $request->id: 'N/A';

            })
            ->editColumn('number', function ($request) {
                return $request->number ?  $request->number : 'N/A';
            })
            ->editColumn('number', function ($request) {
                return $request->number ?  $request->number : 'N/A';
            })
             ->editColumn('amount', function ($request) {
                return $request->amount ?  number_format($request->amount,2) : '0';
            })

             ->editColumn('project_id', function ($request) {
                return $request->project_id ?  ucwords($request->projectId->name): 'N/A';
            })
            ->editColumn('plot_id', function ($request) {
                return $request->plot_id ?  ucwords($request->plotId->number): 'N/A';
            })
             ->editColumn('customer', function ($request) {
                return $request->customer ?  ucwords($request->customer): 'N/A';
            })
             ->editColumn('reference', function ($request) {
                return $request->reference ?  ucwords($request->reference): 'N/A';
            })
            ->editColumn('description', function ($request) {
                return $request->description ?  ucwords($request->description): 'N/A';
            })
             ->editColumn('project', function ($request) {
                return $request->project ?  ucwords($request->project): 'N/A';
            })
           ->editColumn('created_by', function ($request) {
                return $request->createdBy ?  ucwords($request->createdBy->name) : 'N/A';
            })
            ->editColumn('file_name', function ($row) {
                if (!$row->file_name) {
                    return '(not set)';
                }

                $media = Media::where('number', $row->id)->first();
                if (!$media) {
                    return '(media not found)';
                }

                $links[] = '<a href="' . Storage::url($media->id.'/'.$media->file_name) . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                return implode(', ', $links);
            })
            ->addColumn('action', 'backend.transactions.datatables_actions')
             ->rawColumns([ 'action','file_name'])

            // return $table->make(true);
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Recruitments\Entities\Salary $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Transaction $model)
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
             'plot' => new Column([
                'data'  => 'plot',
                'name'  => 'plot',
                'title' => 'Plot Number',
            ]),
             'number' => new Column([
                'data'  => 'number',
                'name'  => 'number',
                'title' => 'Transaction number',
            ]),

            'project' => new Column([
                'data'  => 'project',
                'name'  => 'project',
                'title' => 'Project Name',
            ]),
             'description' => new Column([
                'data'  => 'description',
                'name'  => 'description',
                'title' => 'Description',
            ]),
             'reference' => new Column([
                'data'  => 'reference',
                'name'  => 'reference',
                'title' => 'Reference',
            ]),
            'customer' => new Column([
                'data'  => 'customer',
                'name'  => 'customer',
                'title' => 'Customer Fullname',
            ]),

      'amount' => new Column([
                'data'  => 'amount',
                'name'  => 'amount',
                'title' => 'amount',
            ]),
             'payment_date' => new Column([
                'data'  => 'payment_date',
                'name'  => 'payment_date',
                'title' => 'Transaction Date',
            ]),
            'created_at' => new Column([
                'data'  => 'created_at',
                'name'  => 'created_at',
                'title' => 'Date',
            ]),
             'file_name' => new Column([
                'data'  => 'file_name',
                'name'  => 'file_name',
                'title' => 'Attachments',
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
        return 'transaction_datatable_' . time();
    }
}
