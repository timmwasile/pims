<?php

namespace Modules\Recruitments\DataTables;

use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Modules\Recruitments\Entities\Invoice;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class InvoiceDataTable extends DataTable
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
           
            ->editColumn('description', function ($request) {
                return $request->description ? ucwords($request->description) : 'N/A';
            })
             ->editColumn('amount', function ($request) {
                return $request->amount ? number_format($request->amount,2).'/=' : '0.00';
            })
             ->addColumn('customer_name', function ($request) { 
                return $request->customer_name ? $request->customer_name  : 'N/A';
              
            })
             ->editColumn('invoice_no', function ($request) {
                return $request->invoice_no ? number_format($request->invoice_no,2) : 'N/a';
            })
            ->addColumn('action', 'backend.Invoices.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Recruitments\Entities\Invoice $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Invoice $model)
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
                'title' => 'Invoice Description',
            ]),

            'amount' => new Column([
                'data'  => 'amount',
                'name'  => 'amount',
                'title' => 'amount',
            ]),
            
             'customer_name' => new Column([
                'data'  => 'customer_name',
                'name'  => 'customer_name',
                'title' => 'customer_name',
            ]),
            'invoice_no' => new Column([
                'data'  => 'invoice_no',
                'name'  => 'invoice_no',
                'title' => 'invoice_no',
            ]),
            'invoice_date' => new Column([
                'data'  => 'invoice_date',
                'name'  => 'invoice_date',
                'title' => 'invoice_date',
            ]),
            // 'payment_method' => new Column([
            //     'data'  => 'payment_method',
            //     'name'  => 'payment_method',
            //     'title' => 'payment_method',
            // ]),
            // 'derivered_date' => new Column([
            //     'data'  => 'derivered_date',
            //     'name'  => 'derivered_date',
            //     'title' => 'derivered_date',
            // ]),
            //   'created_by' => new Column([
            //     'data'  => 'created_by',
            //     'name'  => 'created_by',
            //     'title' => 'created_by',
            // ]),
           


        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Invoices_datatable_' . time();
    }
}
