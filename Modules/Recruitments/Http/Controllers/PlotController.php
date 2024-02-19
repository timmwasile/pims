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
use Modules\Recruitments\DataTables\LoanDataTable;
use Modules\Recruitments\DataTables\PlotDataTable;
use Modules\Recruitments\Entities\Customer;
use Modules\Recruitments\Entities\Employee;
use Modules\Recruitments\Entities\Loan;
use Modules\Recruitments\Entities\MarketingOfficer;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Plot;
use Modules\Recruitments\Entities\Project;
use Modules\Recruitments\Entities\Transaction;
use Modules\Recruitments\Http\Controllers\Traits\MediaUploadingTrait;
use Modules\Recruitments\Http\Repositories\PlotRepository;
use Modules\Recruitments\Http\Repositories\TransactionRepository;
use Modules\Recruitments\Http\Requests\ClearBalanceLoanRequest;
use Modules\Recruitments\Http\Requests\CreateLoanRequest;
use Modules\Recruitments\Http\Requests\CreatePlotRequest;
use Modules\Recruitments\Http\Requests\CreateTransactionRequest;
use Modules\Recruitments\Http\Requests\UpdateLoanRequest;
use Modules\Recruitments\Http\Requests\UpdatePlotRequest;
use Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use function app\bootstrap\plotNumber;
use function app\bootstrap\transactionNumber;


class PlotController extends AppBaseController
{
use MediaUploadingTrait;

    /** @var PlotRepository */
    private $PlotRepository;

      /** @var TransactionRepository */
    private $TransactionRepository;

    public function __construct(PlotRepository $plotRepo,TransactionRepository $TransactionRepo)
    {
        $this->PlotRepository = $plotRepo;
        $this->TransactionRepository = $TransactionRepo;

    }

    /**
     * Display a listing of the Loan.
     *
     * @param PlotDataTable $PlotDataTable
     *
     * @return Response
     */
    public function index(PlotDataTable $PlotDataTable)
    {
       
        abort_if(Gate::denies('plot_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $PlotDataTable->render('backend.plots.index');
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
        $projects = Project::where('company_id',auth()->user()->company_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $payments = Payment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $marketing_officers = MarketingOfficer::where('company_id',auth()->user()->company_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('backend.plots.create',compact('customers','projects','payments','marketing_officers'));
    }

    /**
     * Store a newly created Loan in storage.
     *
     * @param CreatePlotRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreatePlotRequest $request)
    {
        $input = $request->all();
        $plot = $this->PlotRepository->create($input);
       
         if($request->hasFile('file_name') && $request->file('file_name')->isValid()){
            $plot->addMediaFromRequest('file_name')->toMediaCollection('file_name');
        }
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $plot->id]);
        }
        $plot->update(['number'=>plotNumber('plotNumber', $plot->id)]);
if($request->payment_id < 3){
    $data = Plot::where('id',$plot->id)->first();
        $customer = Customer::where('id',$data->customer_id)->first();

        $project = Project::where('id',$data->project_id)->first();
        $inserts = [ 
            'created_by'=>auth()->user()->id,
            'amount'=>floatval(preg_replace("/[^-0-9\.]/","",$data->paid_amount)),
            'customer_id'=>$data->customer_id,
            'company_id'=>$data->company_id,
            'customer'=>$customer->name,
            'project'=>$project->name,
            'description'=>$data->description,
            'payment_date'=>$data->created_at,
            'reference'=>$request->reference,
            'file_name'=>$request->file_name,
            'project_id'=>$data->project_id,
            'plot_id'=>$data->id,
            'plot'=>$data->number,

    ];

        $transaction = $this->TransactionRepository->create($inserts);
        $transaction->update(['number'=>transactionNumber('transactionNumber', $transaction->id)]);

        Plot::where('id',)->update(['number'=>transactionNumber('transactionNumber', $plot->id)]);

}
        

        Flash::success('Plot saved successfully.');

        return redirect(route('admin.plots.index'));
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

        $plot = $this->PlotRepository->find($id);
        
        $transactions = Transaction::
                        select('transactions.number as transaction_number','transactions.amount as amount','transactions.payment_date as payment_date','transactions.description as description','transactions.reference as reference','customers.name as customer','projects.name as project','plots.number as plot','media.file_name as file_name','transactions.id as id')
                        ->leftjoin('projects', 'projects.id', '=', 'transactions.project_id')
                        ->leftjoin('plots', 'plots.id', '=', 'transactions.plot_id')
                        ->leftjoin('customers', 'customers.id', '=', 'transactions.customer_id')
                        ->leftjoin('media', 'media.number', '=', 'transactions.id')
                        ->where('transactions.plot_id', $id)
                        ->orderBy('transactions.id', 'desc')
                        ->get()
                        ;
        $media = Media::where('model_id',$id)->first()->media_id;
        // dd($id);
        if(!$media){
        $media = Media::where('model_id',auth()->user()->company_id)->first();
                   }
                //    dd(Storage::url($media->id.'/'.$media->file_name));
        $imagePath = public_path().'/storage/'.$media->id.'/'.$media->file_name;
        // $link = Storage::url($media->id.'/'.$media->file_name);
        $link = $media->getUrl();
        // dd($link);
        if (empty($plot)) {
            Flash::error('plot not found');

            return redirect(route('admin.plots.index'));
        }

        return view('backend.plots.show',compact('transactions','media','link'))->with('plot', $plot);

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

        $plot = $this->PlotRepository->find($id);

        if (empty($plot)) {
            Flash::error('plot not found');

            return redirect(route('admin.plots.index'));
        }

        $customers = Customer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $projects = Project::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $payments = Payment::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $marketing_officers = MarketingOfficer::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('backend.plots.edit',compact('customers','projects','payments','marketing_officers'))->with('plot', $plot);
    }

    /**
     * Update the specified Plot in storage.
     *
     * @param int                   $id
     * @param UpdatePlotRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdatePlotRequest $request)
    {
        $plot = $this->PlotRepository->find($id);

        if (empty($plot)) {
            Flash::error('plot not found');

            return redirect(route('admin.plots.index'));
        }
        $plot = $this->PlotRepository->update($request->all(), $id);
        // update file uploaded
        if (count($plot->permits) > 0) {
            foreach ($plot->permits as $media) {
                if (!in_array($media->file_name, $request->input('permits', []))) {
                    $media->delete();
                }
            }
        }

        $media = $plot->permits->pluck('file_name')->toArray();

        foreach ($request->input('permits', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $plot->addMedia(storage_path('tmp/attachments/' . $file))->toMediaCollection('permits');
            }
        }

        Flash::success('Plot updated successfully.');

        return redirect(route('admin.plots.index'));
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
        $plot = $this->PlotRepository->find($id);
        if (empty($plot)) {
            Flash::error('plot Balance not found');
            return redirect(route('admin.plots.transaction'));
        }
        $customers = Customer::get();
        // return view('backend.plots.transaction',compact('customers','lastpayment'))->with('plot', $plot);
        return view('backend.plots.transaction',compact('customers'))->with('plot', $plot);

    }

     /**
     * Store_balance the specified Loan in storage.
     *
     * @param int                   $id
     * @param ClearBalanceLoanRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */

    public function save_to_clear_balance($id, CreateTransactionRequest $request)
    {
        $plot = Plot::where('id', $id)->first();
        $input = $request->all();
        $transaction = $this->TransactionRepository->create($input);
           $to_media = $plot->addMediaFromRequest('file_name')->toMediaCollection('file_name');
           $to_media->update(['number' => $transaction->id]);
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $plot->id]);
        }
        $transaction->update(['number'=>transactionNumber('transactionNumber', $transaction->id)]);
        if($request->amount - $plot->balance ==0){
            Plot::where('id', $id)
                ->update([
                    'status_id' =>0,
                    'month_remaining' =>0,
                ]);
        }
        $plot = $this->PlotRepository->update([
                    'paid_amount'=>floatval(preg_replace("/[^-0-9\.]/","",$plot->paid_amount)) + floatval(preg_replace("/[^-0-9\.]/","",$request->amount)),

                    'balance'=>floatval(preg_replace("/[^-0-9\.]/","",$plot->balance)) -  floatval(preg_replace("/[^-0-9\.]/","",$request->amount)),
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
        $query= Plot::where('id', $id)->get()->first();
        $customer =Customer::where('id', $query->customer_id)->first();
        $project =Project::where('id', $query->project_id)->first();

        $transactions = Transaction::select('transactions.number as number',
                                    'transactions.amount as amount',
                                    'transactions.payment_date as date',
                                    'transactions.reference as reference',
                        )
                        ->join('plots', 'plots.id', '=', 'transactions.plot_id')
                        ->join('customers', 'customers.id', '=', 'transactions.customer_id')
                        ->where('transactions.plot_id',$id)
                        ->get();
        
                         $total = $transactions -> pluck('amount')->sum();
        $viewContent = FacadesView::make('backend.plots.print',compact(
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

        $plot = $this->PlotRepository->find($id);
        $project=Plot::where('id',$id)->first();
        // dd($project);
        
        if (empty($plot)) {
            Flash::error('plot not found');

            return redirect(route('admin.plots.index'));
        }

        $this->PlotRepository->delete($id);
        // Plot::where('id',$ixd)->update(['size'=>0]);

        Flash::success('plot deleted successfully.');

        return redirect(route('admin.plots.index'));
    }

     public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('plot_create') && Gate::denies('plot_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Plot();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
