<?php

namespace Modules\Recruitments\Http\Controllers;

use Auth;
use Barryvdh\DomPDF\PDF;
use DateInterval;
use DateTime;
use Dompdf\Dompdf;
use Gate;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View as FacadesView;
use Modules\Admins\Entities\Admin;
use Modules\Recruitments\DataTables\FarmAssetDataTable;
use Modules\Recruitments\DataTables\LoanDataTable;
use Modules\Recruitments\DataTables\PlotDataTable;
use Modules\Recruitments\Entities\Customer;
use Modules\Recruitments\Entities\Employee;
use Modules\Recruitments\Entities\Farm;
use Modules\Recruitments\Entities\FarmAsset;
use Modules\Recruitments\Entities\Loan;
use Modules\Recruitments\Entities\MarketingOfficer;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Plot;
use Modules\Recruitments\Entities\Project;
use Modules\Recruitments\Entities\Transaction;
use Modules\Recruitments\Http\Controllers\Traits\MediaUploadingTrait;
use Modules\Recruitments\Http\Repositories\FarmAssetRepository;
use Modules\Recruitments\Http\Repositories\TransactionRepository;
use Modules\Recruitments\Http\Requests\ClearBalanceLoanRequest;
use Modules\Recruitments\Http\Requests\CreateFarmAssetRequest;
use Modules\Recruitments\Http\Requests\CreateLoanRequest;
use Modules\Recruitments\Http\Requests\CreatePlotRequest;
use Modules\Recruitments\Http\Requests\CreateTransactionfarmRequest;
use Modules\Recruitments\Http\Requests\CreateTransactionRequest;
use Modules\Recruitments\Http\Requests\UpdateFarmAssetRequest;
use Modules\Recruitments\Http\Requests\UpdateLoanRequest;
use Modules\Recruitments\Http\Requests\UpdatePlotRequest;
use Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use function app\bootstrap\farmNumber;
use function app\bootstrap\plotNumber;
use function app\bootstrap\transactionNumber;


class FarmAssetController extends AppBaseController
{
use MediaUploadingTrait;

    /** @var FarmAssetRepository */
    private $FarmAssetRepository;

      /** @var TransactionRepository */
    private $TransactionRepository;

    public function __construct(FarmAssetRepository $farmAssetRepo,TransactionRepository $TransactionRepo)
    {
        $this->FarmAssetRepository = $farmAssetRepo;
        $this->TransactionRepository = $TransactionRepo;

    }

    /**
     * Display a listing of the Loan.
     *
     * @param FarmAssetDataTable $PlotDataTable
     *
     * @return Response
     */
    public function index(FarmAssetDataTable $farmAssetDataTable)
    {



        abort_if(Gate::denies('plot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $farmAssetDataTable->render('backend.farm_assets.index');
    }

    /**
     * Show the form for creating a new Loan.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('plot_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $customers = Customer::where('company_id',auth()->user()->company_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $farms = Farm::where('company_id',auth()->user()->company_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $payments = Payment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $marketing_officers = MarketingOfficer::where('company_id',auth()->user()->company_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('backend.farm_assets.create',compact('customers','farms','payments','marketing_officers'));
    }

    /**
     * Store a newly proprty farm in storage.
     *
     * @param CreateFarmAssetRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateFarmAssetRequest $request)
    {
        $input = $request->all();
        $farm = $this->FarmAssetRepository->create($input);

        $farm->update(['number'=>farmNumber('farmNumber', $farm->id)]);
if($request->payment_id < 3){
    $data = FarmAsset::where('id',$farm->id)->first();
        $customer = Customer::where('id',$data->customer_id)->first();

        $farm = Farm::where('id',$data->project_id)->first();
        $inserts = [
            'created_by'=>auth()->user()->id,
            'amount'=>floatval(preg_replace("/[^-0-9\.]/","",$data->paid_amount)),
            'customer_id'=>$data->customer_id,
            'company_id'=>$data->company_id,
            'customer'=>$customer->name,
            'project'=>$farm->name,
            'description'=>$data->description,
            'payment_date'=>$data->created_at,
            'reference'=>$request->reference,
            'file_name'=>$request->file_name,
            'project_id'=>$data->project_id,
            'plot_id'=>$data->id,
            'plot'=>$data->number,

    ];

        $transaction = $this->TransactionRepository->create($inserts);
        $transaction->update(['number' => transactionNumber('transactionNumber', $transaction->id)]);

        if ($request->hasFile('file_name') && $request->file('file_name')->isValid()) {
            $media = $farm->addMediaFromRequest('file_name')->toMediaCollection('file_name');

            // Update the number field of the associated media entry with the transaction ID
            $media->update(['number' => $transaction->id]);
        }

        if ($media = $request->input('ck-media', false)) {
            // Update the number field of the selected media entries with the transaction ID
            Media::whereIn('id', $media)->update([
                'model_id' => $farm->id,
                'number' => $transaction->id
            ]);
        }

        Plot::where('id',)->update(['number'=>transactionNumber('transactionNumber', $farm->id)]);

}


        Flash::success('farmer saved successfully.');

        return redirect(route('admin.farm_assets.index'));
    }

    /**
     * Display the specified Loan.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
   public function show($id)
{
    abort_if(Gate::denies('plot_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    $farm = $this->FarmAssetRepository->find($id);

    $transactions = Transaction::with('receipt')->select('transactions.number as transaction_number', 'transactions.amount as amount',
     'transactions.payment_date as payment_date',
     'transactions.description as description',
     'transactions.reference as reference',
     'customers.name as customer',
     'farms.name as project',
     'farm_assets.number as farm',
     'media.file_name as file_name',
     'transactions.id as id',
     'media.id as media_id'
     )
        ->leftJoin('farms', 'farms.id', '=', 'transactions.project_id')
        ->leftJoin('farm_assets', 'farm_assets.id', '=', 'transactions.plot_id')
        ->leftJoin('customers', 'customers.id', '=', 'transactions.customer_id')
        ->leftJoin('media', 'media.number', '=', 'transactions.id')
        ->where('transactions.plot_id', $id)
        ->orderBy('transactions.id', 'desc')
        ->get();



    if (empty($farm)) {
        Flash::error('Plot not found');
        return redirect(route('admin.farm_assets.index'));
    }

    return view('backend.farm_assets.show', compact('transactions'))->with('farm', $farm);
}

    /**
     * Show the form for editing the specified plot.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('plot_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $farm_asset = $this->FarmAssetRepository->find($id);

        if (empty($farm_asset)) {
            Flash::error('farm_asset not found');

            return redirect(route('admin.farm_assets.index'));
        }

        $customers = Customer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $farm = Farm::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $payments = Payment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $marketing_officers = MarketingOfficer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('backend.farm_assets.edit',compact('customers','farm','payments','marketing_officers'))->with('farm_asset', $farm_asset);
    }

    /**
     * Update the specified Plot in storage.
     *
     * @param int                   $id
     * @param UpdateFarmAssetRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateFarmAssetRequest $request)
    {
        $farm = $this->FarmAssetRepository->find($id);

        if (empty($farm)) {
            Flash::error('farm not found');

            return redirect(route('admin.farm_assets.index'));
        }
        $farm = $this->FarmAssetRepository->update($request->all(), $id);
        // update file uploaded
        if (count($farm->permits) > 0) {
            foreach ($farm->permits as $media) {
                if (!in_array($media->file_name, $request->input('permits', []))) {
                    $media->delete();
                }
            }
        }
        $transaction = Transaction::where('plot_id', $id)->first()->update([
            'amount' => $request->paid_amount,
        ]);

        $media = $farm->permits->pluck('file_name')->toArray();

        foreach ($request->input('permits', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $farm->addMedia(storage_path('tmp/attachments/' . $file))->toMediaCollection('permits');
            }
        }

        Flash::success('Farm updated successfully.');

        return redirect(route('admin.farm_assets.index'));
    }

    /**
     * Clear plot Balance.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
  public function transaction($id)
    {

        abort_if(Gate::denies('plot_transaction'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $plot = $this->FarmAssetRepository->find($id);
        if (empty($plot)) {
            Flash::error('plot Balance not found');
            return redirect(route('admin.plots.transaction'));
        }
        $customers = Customer::get();
        return view('backend.farm_assets.transaction',compact('customers'))->with('plot', $plot);

    }

     /**
     * Store_balance the specified Loan in storage.
     *
     * @param int                   $id
     * @param ClearBalanceLoanRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */

    public function save_to_clear_balance($id, CreateTransactionfarmRequest $request)
    {
        $farm = FarmAsset::where('id', $id)->first();
        $input = $request->all();
        $transaction = $this->TransactionRepository->create($input);
           $to_media = $farm->addMediaFromRequest('file_name')->toMediaCollection('file_name');
           $to_media->update(['number' => $transaction->id]);
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $farm->id]);
        }
        $transaction->update(['number'=>transactionNumber('transactionNumber', $transaction->id)]);
        if($request->amount - $farm->balance ==0){
            FarmAsset::where('id', $id)
                ->update([
                    'status_id' =>0,
                    'month_remaining' =>0,
                ]);
        }
        $farm = $this->FarmAssetRepository->update([
                    'paid_amount'=>floatval(preg_replace("/[^-0-9\.]/","",$farm->paid_amount)) + floatval(preg_replace("/[^-0-9\.]/","",$request->amount)),

                    'balance'=>floatval(preg_replace("/[^-0-9\.]/","",$farm->balance)) -  floatval(preg_replace("/[^-0-9\.]/","",$request->amount)),
            ],$id);

        Flash::success('Transaction updated successfully.');
        return redirect(route('admin.transactions.index'));
    }
     /**
     * Store_balance the specified Loan in storage.
     *
     * @param int                   $id
     * @param ClearBalanceLoanRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */

    public function print($id)
    {
        abort_if(Gate::denies('plot_finished_payment'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $dompdf = new Dompdf();
        $media = Media::where('model_id',auth()->user()->company_id)->first();
        $imagePath = '/'.$media->id.'/'.$media->file_name;
        $query= FarmAsset::where('id', $id)->get()->first();
        $customer =Customer::where('id', $query->customer_id)->first();
        $project =Farm::where('id', $query->project_id)->first();

        $transactions = Transaction::select('transactions.number as number',
                                    'transactions.amount as amount',
                                    'transactions.payment_date as date',
                                    'transactions.reference as reference',
                        )
                        ->join('farm_assets', 'farm_assets.id', '=', 'transactions.plot_id')
                        ->join('customers', 'customers.id', '=', 'transactions.customer_id')
                        ->where('transactions.plot_id',$id)
                        ->get();

                         $total = $transactions -> pluck('amount')->sum();
        $viewContent = FacadesView::make('backend.farm_assets.print',compact(
            'transactions','customer','query','total','imagePath','project'
            ))
            ->render();
        $file_name = str_ireplace(' ', '', $query->number) . '_'.$customer->name;
        $dompdf->loadHtml($viewContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream($file_name.".pdf"); //
         return $dompdf->stream(); // Output the generated PDF to the browser
    }
      /**
     * Remove the specified plot from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('plot_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $plot = $this->FarmAssetRepository->find($id);
        $project=FarmAsset::where('id',$id)->first();
        if (empty($plot)) {
            Flash::error('plot not found');
            return redirect(route('admin.plots.index'));
        }

        $this->FarmAssetRepository->delete($id);
        Flash::success('plot deleted successfully.');

        return redirect(route('admin.farm_assets.index'));
    }

     public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('plot_create') && Gate::denies('plot_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new FarmAsset();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
