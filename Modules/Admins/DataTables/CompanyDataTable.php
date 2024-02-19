<?php

namespace Modules\Admins\DataTables;

use Yajra\DataTables\EloquentDataTable;
use Modules\Admins\Entities\Company;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CompanyDataTable extends DataTable
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
        if(auth()->user()->id == 1)
        {
        $dataTable = new EloquentDataTable($query);
        }
        else{
        $dataTable = new EloquentDataTable($query->where('id',auth()->user()->company_id));


        }



        return $dataTable
            ->addIndexColumn()
            ->editColumn('name', function ($request) {
                return $request->name ? ucwords($request->name) : 'N/A';
            })
             ->editColumn('description', function ($request) {
                return $request->description ? ucwords($request->description) : 'N/A';
            })
            ->editColumn('email', function ($request) {
                return $request->email ? $request->email : 'N/A';
            })
            //  ->editColumn('logo', function ($request) {
            //     return $request->logo ? $request->getFullUrl('logo', 'thumb') : 'N/A';
            // })
//             ->addColumn('logo', function ($request) {
//     $url= asset(storage_path().'/images/'.$request->logo);
//     return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
// })
            // <td><img src="{{$item->getFirstMediaUrl('avatar', 'thumb')}}" / width="120px"></td>$image->getFullUrl()
            // ->editColumn('logo', function ($row) {
            //     if (!$row->logo) {
            //         return '(not set)';
            //     }

            //     $links = [];

            //     foreach ($row->logo as $media) {
            //         $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
            //     }

            //     return implode(', ', $links);
            // })
            ->addColumn('action', 'backend.companies.datatables_actions')
            ->rawColumns(['action']);

        // return $request->make(true);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Admins\Entities\Admin $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Company $model)
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

            'name' => new Column([
                'data'  => 'name',
                'name'  => 'name',
                'title' => 'FullName',
            ]),

            'email' => new Column([
                'data'  => 'email',
                'name'  => 'email',
                'title' => 'E-mail',
            ]),

            'phone_no' => new Column([
                'data'  => 'phone_no',
                'name'  => 'phone_no',
                'title' => 'Mobile_Number',
            ]),

            'description' => new Column([
                'data'  => 'description',
                'name'  => 'description',
                'title' => 'Description',
            ]),
            //   'logo' => new Column([
            //     'data'  => 'logo',
            //     'name'  => 'logo',
            //     'title' => 'logo',
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
        return 'companies_datatable_' . time();
    }
}
