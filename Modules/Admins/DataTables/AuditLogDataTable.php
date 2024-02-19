<?php

namespace Modules\Admins\DataTables;

use Yajra\DataTables\EloquentDataTable;
use Modules\Admins\Entities\AuditLog;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AuditLogDataTable extends DataTable
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
        if(auth()->user()->id !=1){
             $dataTable = new EloquentDataTable($query->where('company_id',auth()->user()->company_id));
            
        }
       
     $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->addIndexColumn()
            ->editColumn('id', function ($request) {
                return $request->id ? $request->id : '';
            })
            ->editColumn('description', function ($request) {
                return $request->description ? $request->description : '';
            })
            ->editColumn('subject_id', function ($request) {
                return $request->subject_id ? $request->subject_id : '';
            })
            ->editColumn('subject_type', function ($request) {
                return $request->subject_type ? $request->subject_type : '';
            })
            ->editColumn('user_id', function ($request) {
                return $request->admin ? ucwords($request->admin->name) : '(Not Set)';
            })
            ->editColumn('host', function ($request) {
                return $request->host ? $request->host : '';
            })

            // ->rawColumns(['actions', 'placeholder', 'user']);
            ->addColumn('action', 'backend.auditlogs.datatables_actions')
            ->rawColumns(['action', 'admin']);

        // return $request->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Admins\Entities\AuditLog $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AuditLog $model)
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

            'description' => new Column([
                'data'  => 'description',
                'name'  => 'description',
                'title' => 'Description',
            ]),

            'subject_id' => new Column([
                'data'  => 'subject_id',
                'name'  => 'subject_id',
                'title' => 'Subject_id',
            ]),

            'subject_type' => new Column([
                'data'  => 'subject_type',
                'name'  => 'subject_type',
                'title' => 'Subject_type',
            ]),
             'created_at' => new Column([
                'data'  => 'created_at',
                'name'  => 'created_at',
                'title' => 'created_at',
            ]),

            'user_id' => new Column([
                'data'  => 'user_id',
                'name'  => 'user_id',
                'title' => 'Created By',
            ]),

            'host' => new Column([
                'data'  => 'host',
                'name'  => 'host',
                'title' => 'Host',
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
        return 'auditlogs_datatable_' . time();
    }
}
