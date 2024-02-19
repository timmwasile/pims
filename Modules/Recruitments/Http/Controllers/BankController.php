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
use Modules\Recruitments\DataTables\BankDataTable;
use Modules\Recruitments\DataTables\PaymentDataTable;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Http\Repositories\BankRepository;
use Modules\Recruitments\Http\Repositories\PaymentRepository;
use Modules\Recruitments\Http\Requests\CreateBankRequest;
use Modules\Recruitments\Http\Requests\CreatePaymentRequest;
use Modules\Recruitments\Http\Requests\UpdateBankRequest;
use Modules\Recruitments\Http\Requests\UpdatePaymentRequest;
use Request;

use function app\bootstrap\randGenerator;

class BankController extends AppBaseController
{
    /** @var BankRepository */
    private $BankRepository;

    public function __construct(BankRepository $BankRepo)
    {
        $this->BankRepository = $BankRepo;
    }

    /**
     * Display a listing of the Bank.
     *
     * @param BankDataTable $BankDataTable
     *
     * @return Response
     */
    public function index(BankDataTable $BankDataTable)
    {
        abort_if(Gate::denies('bank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $BankDataTable->render('backend.banks.index');
    }

    /**
     * Show the form for creating a new Bank.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('bank_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.banks.create');
    }

    /**
     * Store a newly created Bank in storage.
     *
     * @param CreateBankRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateBankRequest $request)
    {
        $input = $request->all();

        $Bank = $this->BankRepository->create($input);

        Flash::success('Bank saved successfully.');

        return redirect(route('admin.banks.index'))->with('success', ' ' . ucwords($request->name) . '  is tecreated successfully.');
    }

    /**
     * Display the specified Bank.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('bank_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Bank = $this->BankRepository->find($id);

        if (empty($Bank)) {
            Flash::error('Bank not found');

            return redirect(route('admin.banks.index'));
        }

        return view('backend.banks.show')->with('Bank', $Bank);
    }

    /**
     * Show the form for editing the specified Bank.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('bank_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Bank = $this->BankRepository->find($id);

        if (empty($Bank)) {
            Flash::error('Bank not found');

            return redirect(route('admin.banks.index'));
        }
        return view('backend.banks.edit')->with('Bank', $Bank);
    }

    /**
     * Update the specified Bank in storage.
     *
     * @param int                   $id
     * @param UpdateBankRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateBankRequest $request)
    {
        $Bank = $this->BankRepository->find($id);

        if (empty($Bank)) {
            Flash::error('Bank not found');

            return redirect(route('admin.banks.index'));
        }
        $Bank = $this->BankRepository->update($request->all(), $id);

        Flash::success('Bank updated successfully.');

        return redirect(route('admin.banks.index'))->with('success', ' ' . ucwords($request->name) . '  is Updated successfully.');
    }

    /**
     * Remove the specified Bank from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('bank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Bank = $this->BankRepository->find($id);

        if (empty($Bank)) {
            Flash::error('Bank not found');

            return redirect(route('admin.banks.index'));
        }

        $this->BankRepository->delete($id);

        Flash::success('Bank deleted successfully.');

        return redirect(route('admin.banks.index'));
    }

      

}
