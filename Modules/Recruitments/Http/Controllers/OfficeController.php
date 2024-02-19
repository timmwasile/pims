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
use Modules\Recruitments\DataTables\OfficeDataTable;
use Modules\Recruitments\DataTables\PaymentDataTable;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Http\Repositories\OfficeRepository;
use Modules\Recruitments\Http\Repositories\PaymentRepository;
use Modules\Recruitments\Http\Requests\CreateOfficeRequest;
use Modules\Recruitments\Http\Requests\CreatePaymentRequest;
use Modules\Recruitments\Http\Requests\UpdateOfficeRequest;
use Modules\Recruitments\Http\Requests\UpdatePaymentRequest;
use Request;

use function app\bootstrap\randGenerator;

class OfficeController extends AppBaseController
{
    /** @var OfficeRepository */
    private $OfficeRepository;

    public function __construct(OfficeRepository $OfficeRepo)
    {
        $this->OfficeRepository = $OfficeRepo;
    }

    /**
     * Display a listing of the Office.
     *
     * @param OfficeDataTable $OfficeDataTable
     *
     * @return Response
     */
    public function index(OfficeDataTable $OfficeDataTable)
    {
        abort_if(Gate::denies('office_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $OfficeDataTable->render('backend.offices.index');
    }

    /**
     * Show the form for creating a new Office.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('office_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.offices.create');
    }

    /**
     * Store a newly created Office in storage.
     *
     * @param CreateOfficeRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateOfficeRequest $request)
    {
        $input = $request->all();

        $Office = $this->OfficeRepository->create($input);

        Flash::success('Office saved successfully.');

        return redirect(route('admin.offices.index'));
    }

    /**
     * Display the specified Office.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('office_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Office = $this->OfficeRepository->find($id);

        if (empty($Office)) {
            Flash::error('Office not found');

            return redirect(route('admin.offices.index'));
        }

        return view('backend.offices.show')->with('Office', $Office);
    }

    /**
     * Show the form for editing the specified Office.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('office_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Office = $this->OfficeRepository->find($id);

        if (empty($Office)) {
            Flash::error('Office not found');

            return redirect(route('admin.offices.index'));
        }
        return view('backend.offices.edit')->with('Office', $Office);
    }

    /**
     * Update the specified Office in storage.
     *
     * @param int                   $id
     * @param UpdateOfficeRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateOfficeRequest $request)
    {
        $Office = $this->OfficeRepository->find($id);

        if (empty($Office)) {
            Flash::error('Office not found');

            return redirect(route('admin.offices.index'));
        }
        $Office = $this->OfficeRepository->update($request->all(), $id);

        Flash::success('Office updated successfully.');

        return redirect(route('admin.offices.index'));
    }

    /**
     * Remove the specified Office from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('office_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Office = $this->OfficeRepository->find($id);

        if (empty($Office)) {
            Flash::error('Office not found');

            return redirect(route('admin.offices.index'));
        }

        $this->OfficeRepository->delete($id);

        Flash::success('Office deleted successfully.');

        return redirect(route('admin.offices.index'));
    }

      

}
