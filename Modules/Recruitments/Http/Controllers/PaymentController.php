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
use Modules\Recruitments\DataTables\PaymentDataTable;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Http\Repositories\PaymentRepository;
use Modules\Recruitments\Http\Requests\CreatePaymentRequest;
use Modules\Recruitments\Http\Requests\UpdatePaymentRequest;
use Request;

use function app\bootstrap\randGenerator;

class PaymentController extends AppBaseController
{
    /** @var PaymentRepository */
    private $PaymentRepository;

    public function __construct(PaymentRepository $PaymentRepo)
    {
        $this->PaymentRepository = $PaymentRepo;
    }

    /**
     * Display a listing of the Payment.
     *
     * @param PaymentDataTable $PaymentDataTable
     *
     * @return Response
     */
    public function index(PaymentDataTable $PaymentDataTable)
    {
        abort_if(Gate::denies('payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $PaymentDataTable->render('backend.payments.index');
    }

    /**
     * Show the form for creating a new Payment.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('payment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.payments.create');
    }

    /**
     * Store a newly created payment in storage.
     *
     * @param CreatePaymentRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreatePaymentRequest $request)
    {
        $input = $request->all();

        $Payment = $this->PaymentRepository->create($input);

        Flash::success('Payment type saved successfully.');

        return redirect(route('admin.payments.index'));
    }

    /**
     * Display the specified payment.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('payment_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment = $this->PaymentRepository->find($id);

        if (empty($Payment)) {
            Flash::error('Payment type not found');

            return redirect(route('admin.payments.index'));
        }

        return view('backend.payments.show')->with('Payment', $payment);
    }

    /**
     * Show the form for editing the specified Payment.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment = $this->PaymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment  typenot found');

            return redirect(route('admin.payments.index'));
        }
        return view('backend.payments.edit')->with('payment', $payment);
    }

    /**
     * Update the specified Payment in storage.
     *
     * @param int                   $id
     * @param UpdatePaymentRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdatePaymentRequest $request)
    {
        $payment = $this->PaymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment type not found');

            return redirect(route('admin.payments.index'));
        }
        $payment = $this->PaymentRepository->update($request->all(), $id);

        Flash::success('Payment type updated successfully.');

        return redirect(route('admin.payments.index'));
    }

    /**
     * Remove the specified Payment from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment = $this->PaymentRepository->find($id);

        if (empty($payment)) {
            Flash::error('Payment type not found');

            return redirect(route('admin.payments.index'));
        }

        $this->PaymentRepository->delete($id);

        Flash::success('Payment type deleted successfully.');

        return redirect(route('admin.payments.index'));
    }

      

}
