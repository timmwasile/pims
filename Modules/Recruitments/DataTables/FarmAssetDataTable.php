<?php

namespace Modules\Recruitments\DataTables;

use DB;
use Modules\Recruitments\Entities\FarmAsset;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Modules\Recruitments\Entities\Plot;
use Modules\Recruitments\Entities\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;


class FarmAssetDataTable extends DataTable
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
         $role = DB::table('admin_role')->where('admin_id', auth()->user()->id)->first()->role_id;

        // $dataTable = new EloquentDataTable($query);


        if($role==3){       //account administrator
        $dataTable = new EloquentDataTable($query->where('created_by',auth()->user()->id)->orwhere('company_id',auth()->user()->company_id));
        }
        $dataTable = new EloquentDataTable($query->where('company_id',auth()->user()->company_id));

        return $dataTable
            ->addIndexColumn()
            ->setRowAttr([
    'style' => function($data) {
        $timely_payment = $data->mpa*$data->month_remaining;
        return $timely_payment < $data->balance ? 'background-color: yellow;' : 'background-color: default;';
    },
])
            ->editColumn('created_by', function ($request) {
                return $request->createdBy ? ucwords($request->name) : 'N/A';
            })
            ->editColumn('customer_id', function ($request) {
                return $request->customerId ? ucwords($request->customerId->name) : 'N/A';
            })
            ->addColumn('client', function ($row) {
                return $row->customerId ? ucwords($row->client) : 'N/A';
            })
              ->editColumn('number', function ($request) {
                return $request->number ? ucwords($request->number) : 'N/A';
            })
            ->editColumn('description', function ($request) {
                return $request->description ? ucwords($request->description) : 'N/A';
            })
            ->editColumn('status_id', function ($request) {
                return $request->status_id ==0 && $request->balance==0  ? "Completed": 'Not Completed';
            })

             ->editColumn('duration', function ($request) {
                return $request->duration >1 ? $request->duration.' Months' : ' N/A';
            })
             ->editColumn('total_amount', function ($request) {
                return $request->total_amount ? number_format($request->total_amount,2).'/=' : '0.00/=';
            })
            ->addColumn('discount', function ($request) {
                $discount = $request->total_amount - $request->to_be_paid_amount;
                return $request->total_amount ? number_format($discount,2).'/=' : '0.00/=';
            })
            ->editColumn('mpa', function ($request) {
                return $request->mpa ? number_format($request->mpa,2).'/=' : '0.00/=';
            })
            ->editColumn('to_be_paid_amount', function ($request) {
                return $request->to_be_paid_amount ? number_format($request->to_be_paid_amount,2).'/=' : '0.00/=';
            })
            ->editColumn('paid_amount', function ($request) {
                return $request->paid_amount ? number_format($request->paid_amount,2).'/=' : '0.00/=';
            })
             ->editColumn('balance', function ($request) {
                return $request->balance ? number_format($request->balance,2).'/=' : '0.00/=';
            })->editColumn('permits', function ($request) {
                if (!$request->permits) {
                    return '(not set)';
                }

                $links = [];

                foreach ($request->permits as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            })
             ->editColumn('marketing_officer_id', function ($request) {
                return $request->marketingOfficerId  ? ucwords($request->marketingOfficerId->name): 'N/A';
            })
            // Handle searching for custom column
        ->filterColumn('marketing_officer_id', function ($query, $keyword) {
        $query->where('marketing_officer_id', 'like', "%{$keyword}%");
            })

            // ->rawColumns(['marketing_officer_id'])
            ->addColumn('action', 'backend.farm_assets.datatables_actions')
            // ->make(true)
            ;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \Modules\Recruitments\Entities\FarmAsset $model
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FarmAsset $model)
    {
        return $model->newQuery()->with(['customerId']);
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
                'processing' => true,
                'serverSide' => true,
                'searchable'=> true,
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

            'map_number' => new Column([
                'data'  => 'map_number',
                'name'  => 'map_number',
                'title' => 'Number(MAP)',
            ]),
            'number' => new Column([
                'data'  => 'number',
                'name'  => 'number',
                'title' => 'Farm Number',
            ]),

            'description' => new Column([
                'data'  => 'description',
                'name'  => 'description',
                'title' => 'Description',
            ]),

            'total_amount' => new Column([
                'data'  => 'total_amount',
                'name'  => 'total_amount',
                'title' => 'Total Amount',
            ]),
             'to_be_paid_amount' => new Column([
                'data'  => 'to_be_paid_amount',
                'name'  => 'to_be_paid_amount',
                'title' => 'To be Paid',
            ]),

             'balance' => new Column([
                'data'  => 'balance',
                'name'  => 'balance',
                'title' => 'Balance',
            ]),
            'paid_amount' => new Column([
                'data'  => 'paid_amount',
                'name'  => 'paid_amount',
                'title' => 'Paid Amount',
            ]),
             'mpa' => new Column([
                'data'  => 'mpa',
                'name'  => 'mpa',
                'title' => 'Monthy Payment',
            ]),
            //  'discount' => new Column([
            //     'data'  => 'discount',
            //     'name'  => 'discount',
            //     'title' => 'Discount Amount',
            // ]),
            // 'duration' => new Column([
            //     'data'  => 'duration',
            //     'name'  => 'duration',
            //     'title' => 'Duration',
            // ]),
             'status_id' => new Column([
                'data'  => 'status_id',
                'name'  => 'status_id',
                'title' => 'Status',
            ]),
            'marketing_officer_id' => new Column([
                'data'  => 'marketing_officer_id',
                'name'  => 'marketing_officer_id',
                'title' => 'Officer Name',
                'searchable'=> true
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
        return 'farm_asset_datatable_' . time();
    }
}
