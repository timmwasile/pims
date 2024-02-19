<?php

namespace Modules\Recruitments\Http\Controllers;

use Gate;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Modules\Recruitments\DataTables\InvoiceDataTable;
use Modules\Recruitments\Entities\Employee;
use Modules\Recruitments\Entities\Invoice;
use Modules\Recruitments\Http\Repositories\InvoiceRepository;
use Modules\Recruitments\Http\Requests\CreateInvoiceRequest;
use Modules\Recruitments\Http\Requests\UpdateInvoiceRequest;

use function app\bootstrap\randGenerator;

class InvoiceController extends AppBaseController
{
    /** @var InvoiceRepository */
    private $InvoiceRepository;

    public function __construct(InvoiceRepository $InvoiceRepo)
    {
        $this->InvoiceRepository = $InvoiceRepo;
    }

    /**
     * Display a listing of the Invoice.
     *
     * @param InvoiceDataTable $InvoiceDataTable
     *
     * @return Response
     */
    public function index(InvoiceDataTable $InvoiceDataTable)
    {
        abort_if(Gate::denies('invoice_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $InvoiceDataTable->render('backend.invoices.index');
    }

    /**
     * Show the form for creating a new Invoice.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('invoice_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employees = Employee::get();
        return view('backend.invoices.create',compact('employees'));
    }

    /**
     * Store a newly created Invoice in storage.
     *
     * @param CreateInvoiceRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateInvoiceRequest $request)
    {
        $input = $request->all();

        $Invoice = $this->InvoiceRepository->create($input);

        $Invoice->update(['number'=>randGenerator('InvoiceRegistration', $Invoice->id)]);
                if($request->rate >0){
                $pv=$request->Invoice_amount;
                $rate=$request->rate/100;
                $top=$pv*$rate;
                $rate_plus1=1+$rate;
                $duration=$request->duration;
                $rate_power=pow($rate_plus1,-$duration);
                $bottom=1-$rate_power;
                $pmt=$top/$bottom;
                $Invoice->update(['pmt'=>$pmt, 'Invoice_balance'=>$request->duration*$pmt]);
               } 
               else{
                $pv=$request->Invoice_amount;
                $rate=$request->rate/100;
                $top=$pv*$rate;
                $rate_plus1=1+$rate;
                $duration=$request->duration;
                $rate_power=pow($rate_plus1,-$duration);
                $bottom=1-$rate_power;
                $pmt=$top/$bottom;
                $Invoice->update(['pmt'=>$pmt, 'Invoice_balance'=>$request->duration*$pmt]);
               }


        Flash::success('Invoice saved successfully.');

        return redirect(route('admin.Invoices.index'));
    }

    /**
     * Display the specified Invoice.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('invoice_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Invoice = $this->InvoiceRepository->find($id);

        if (empty($Invoice)) {
            Flash::error('Invoice not found');

            return redirect(route('admin.Invoices.index'));
        }

        return view('backend.Invoices.show')->with('Invoice', $Invoice);
    }

    /**
     * Show the form for editing the specified Invoice.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('invoice_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Invoice = $this->InvoiceRepository->find($id);

        if (empty($Invoice)) {
            Flash::error('Invoice not found');

            return redirect(route('admin.Invoices.index'));
        }
        $employees = Employee::get();
        return view('backend.Invoices.edit',compact('employees'))->with('Invoice', $Invoice);
    }

    /**
     * Update the specified Invoice in storage.
     *
     * @param int                   $id
     * @param UpdateInvoiceRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateInvoiceRequest $request)
    {
        $Invoice = $this->InvoiceRepository->find($id);

        if (empty($Invoice)) {
            Flash::error('Invoice not found');

            return redirect(route('admin.Invoices.index'));
        }
        $Invoice = $this->InvoiceRepository->update($request->all(), $id);

         if($request->rate >0){
                $pv=$request->Invoice_balance;
                $rate=$request->rate/100;
                $top=$pv*$rate;
                $rate_plus1=1+$rate;
                $duration=$request->duration;
                $rate_power=pow($rate_plus1,-$duration);
                $bottom=1-$rate_power;
                $pmt=$top/$bottom;
                $Invoice = $this->InvoiceRepository->update(['pmt'=>$pmt],$id);
                $Invoice = $this->InvoiceRepository->update(['Invoice_balance'=>$request->duration*$pmt], $id);
               } 
               else{
                $pv=$request->Invoice_balance;
                $rate=$request->rate/100;
                $top=$pv*$rate;
                $rate_plus1=1+$rate;
                $duration=$request->duration;
                $rate_power=pow($rate_plus1,-$duration);
                $bottom=1-$rate_power;
                $pmt=$top/$bottom;
                $Invoice = $this->InvoiceRepository->update(['pmt'=>$pmt],$id);
                $Invoice = $this->InvoiceRepository->update(['Invoice_balance'=>$request->duration*$pmt], $id);
               }

        Flash::success('Invoice updated successfully.');

        return redirect(route('admin.Invoices.index'));
    }

    /**
     * Remove the specified Invoice from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('invoice_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Invoice = $this->InvoiceRepository->find($id);

        if (empty($Invoice)) {
            Flash::error('Invoice not found');

            return redirect(route('admin.Invoices.index'));
        }

        $this->InvoiceRepository->delete($id);

        Flash::success('Invoice deleted successfully.');

        return redirect(route('admin.Invoices.index'));
    }
}
