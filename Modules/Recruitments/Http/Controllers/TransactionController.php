<?php

namespace Modules\Recruitments\Http\Controllers;

use DB;
use Dompdf\Dompdf;
use Gate;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\View as FacadesView;
use Modules\Recruitments\DataTables\ActivityTransactionDataTable;
use Modules\Recruitments\DataTables\PaymentDataTable;
use Modules\Recruitments\DataTables\TransactionDataTable;
use Modules\Recruitments\Entities\Activity;
use Modules\Recruitments\Entities\ActivityTransaction;
use Modules\Recruitments\Entities\Customer;
use Modules\Recruitments\Entities\Fyear;
use Modules\Recruitments\Entities\Office;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Plot;
use Modules\Recruitments\Entities\Project;
use Modules\Recruitments\Entities\Transaction;
use Modules\Recruitments\Http\Controllers\Traits\MediaUploadingTrait;
use Modules\Recruitments\Http\Repositories\ActivityTransactionRepository;
use Modules\Recruitments\Http\Repositories\PaymentRepository;
use Modules\Recruitments\Http\Repositories\TransactionRepository;
use Modules\Recruitments\Http\Requests\CreateActivityRequest;
use Modules\Recruitments\Http\Requests\CreateActivityTransactionRequest;
use Modules\Recruitments\Http\Requests\CreatePaymentRequest;
use Modules\Recruitments\Http\Requests\CreateReportTransactionRequest;
use Modules\Recruitments\Http\Requests\UpdateActivityRequest;
use Modules\Recruitments\Http\Requests\UpdatePaymentRequest;
use Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use function app\bootstrap\randGenerator;
use function app\bootstrap\TransactionNumber;

class TransactionController extends AppBaseController
{
    use MediaUploadingTrait;

    /** @var TransactionRepository */
    private $TransactionRepository;

    public function __construct(TransactionRepository $TransactionRepo)
    {
        $this->TransactionRepository = $TransactionRepo;
    }

    /**
     * Display a listing of the Transaction.
     *
     * @param TransactionDataTable $TransactionDataTable
     *
     * @return Response
     */
    public function index(TransactionDataTable $TransactionDataTable)
    {

        abort_if(Gate::denies('transaction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $TransactionDataTable->render('backend.transactions.index');
    }

    /**
     * Show the form for editing the specified Activity.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('activity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Activity = $this->ActivityTransactionRepository->find($id);
        $fyears = Fyear::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        if (empty($Activity)) {
            Flash::error('Activity not found');

            return redirect(route('admin.transactions.index'));
        }
        return view('backend.transactions.edit',compact('fyears'))->with('Activity', $Activity);
    }

    /**
     * Update the specified Activity in storage.
     *
     * @param int                   $id
     * @param UpdateActivityRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateActivityRequest $request)
    {
        $Activity = $this->ActivityTransactionRepository->find($id);

        if (empty($Activity)) {
            Flash::error('Activity not found');

            return redirect(route('admin.transactions.index'));
        }

        $Activity = $this->ActivityTransactionRepository->update($request->all(), $id);

        Flash::success('Transaction updated successfully.');

        return redirect(route('admin.transactions.index'))->with('success', ' ' . ucwords($request->name) . '  is Updated successfully.');
    }

    /**
     * Remove the specified Activity from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {

        abort_if(Gate::denies('transaction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $query=Transaction::where('id', $id)->get()->first();
        $plot= Plot::where('id',$query->plot_id)->first();
        $plot->update([
            'paid_amount' =>$plot->paid_amount - $query->amount,
            'balance' =>$plot->balance + $query->amount,
        ]);

        $transaction = $this->TransactionRepository->find($id);

        if (empty($transaction)) {
            Flash::error('Transaction not found');

            return redirect(route('admin.transactions.index'));
        }

        $this->TransactionRepository->delete($id);

        Flash::success('Transaction deleted successfully.');

        return redirect(route('admin.transactions.index'));
    }



    /**
     * Clear Loan Balance.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
  public function get_report_form()
    {
       $customers = Customer::where('company_id',auth()->user()->company_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('backend.transactions.reports.index',compact('customers'));

    }

 /**
     * Store_balance the specified Loan in storage.
     *
     * @param int                   $id
     * @param ClearBalanceLoanRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */

    public function transaction_report_print(CreateReportTransactionRequest $request)
    {
        abort_if(Gate::denies('plot_finished_payment'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $dompdf = new Dompdf();
        $loiItem = Media::where('model_id',auth()->user()->company_id)->first();
        $imagePath = '/'.$loiItem->id.'/'.$loiItem->file_name;
       if(!$request->customer_id){
         $transactions = Transaction::select('transactions.number as number',
                                    'transactions.amount as amount',
                                    'transactions.payment_date as date',
                                    'transactions.reference as reference',
                                    'customers.name as customer_name',
                        )
                        ->leftjoin('plots', 'plots.id', '=', 'transactions.plot_id')
                        ->leftjoin('customers', 'customers.id', '=', 'transactions.customer_id')
                        ->leftjoin('companies', 'companies.id', '=', 'transactions.company_id')
                        ->whereRaw(
                "(transactions.payment_date >= ? AND transactions.payment_date <= ?)",
                [
                    $request->started_at,
                    $request->ended_at
                ]
            )
                        ->where('companies.id', auth()->user()->company_id)
                        ->get()
                        ;

       }else{
         $transactions = Transaction::select('transactions.number as number',
                                    'transactions.amount as amount',
                                    'transactions.payment_date as date',
                                    'transactions.reference as reference',
                                    'customers.name as customer_name',

                        )
                        ->leftjoin('plots', 'plots.id', '=', 'transactions.plot_id')
                        ->leftjoin('customers', 'customers.id', '=', 'transactions.customer_id')
                        ->whereRaw(
                "(transactions.payment_date >= ? AND transactions.payment_date <= ?)",
                [
                    $request->started_at,
                    $request->ended_at
                ]
            )
                        ->where('transactions.customer_id', $request->customer_id)
                        ->get()
                        ;
       }


                         $total = $transactions -> pluck('amount')->sum();
        $viewContent = FacadesView::make('backend.transactions.reports.print',compact(
            'transactions','total','imagePath','request'
            ))
            ->render();
        $file_name = str_ireplace(' ', '', $request->started_at) ;
        $dompdf->loadHtml($viewContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream($file_name.".pdf"); //
         return $dompdf->stream(); // Output the generated PDF to the browser
    }
}
