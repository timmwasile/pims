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
use Modules\Recruitments\DataTables\FyearDataTable;
use Modules\Recruitments\DataTables\PaymentDataTable;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Http\Repositories\FyearRepository;
use Modules\Recruitments\Http\Repositories\PaymentRepository;
use Modules\Recruitments\Http\Requests\CreateFyearRequest;
use Modules\Recruitments\Http\Requests\CreatePaymentRequest;
use Modules\Recruitments\Http\Requests\UpdateFyearRequest;
use Modules\Recruitments\Http\Requests\UpdatePaymentRequest;
use Request;

use function app\bootstrap\randGenerator;

class FyearController extends AppBaseController
{
    /** @var FyearRepository */
    private $FyearRepository;

    public function __construct(FyearRepository $FyearRepo)
    {
        $this->FyearRepository = $FyearRepo;
    }

    /**
     * Display a listing of the Fyear.
     *
     * @param FyearDataTable $FyearDataTable
     *
     * @return Response
     */
    public function index(FyearDataTable $FyearDataTable)
    {
        abort_if(Gate::denies('fyear_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $FyearDataTable->render('backend.fyears.index');
    }

    /**
     * Show the form for creating a new Fyear.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('fyear_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.fyears.create');
    }

    /**
     * Store a newly created Fyear in storage.
     *
     * @param CreateFyearRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateFyearRequest $request)
    {
        $input = $request->all();

        $Fyear = $this->FyearRepository->create($input);

        Flash::success('Fyear saved successfully.');

        return redirect(route('admin.fyears.index'))->with('success', ' ' . ucwords($request->name) . '  is tecreated successfully.');
    }

    /**
     * Display the specified Fyear.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('fyear_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Fyear = $this->FyearRepository->find($id);

        if (empty($Fyear)) {
            Flash::error('Fyear not found');

            return redirect(route('admin.fyears.index'));
        }

        return view('backend.fyears.show')->with('Fyear', $Fyear);
    }

    /**
     * Show the form for editing the specified Fyear.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('fyear_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Fyear = $this->FyearRepository->find($id);

        if (empty($Fyear)) {
            Flash::error('Fyear not found');

            return redirect(route('admin.fyears.index'));
        }
        return view('backend.fyears.edit')->with('Fyear', $Fyear);
    }

    /**
     * Update the specified Fyear in storage.
     *
     * @param int                   $id
     * @param UpdateFyearRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateFyearRequest $request)
    {
        $Fyear = $this->FyearRepository->find($id);

        if (empty($Fyear)) {
            Flash::error('Fyear not found');

            return redirect(route('admin.fyears.index'));
        }
        $Fyear = $this->FyearRepository->update($request->all(), $id);

        Flash::success('Fyear updated successfully.');

        return redirect(route('admin.fyears.index'))->with('success', ' ' . ucwords($request->name) . '  is Updated successfully.');
    }

    /**
     * Remove the specified Fyear from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('fyear_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Fyear = $this->FyearRepository->find($id);

        if (empty($Fyear)) {
            Flash::error('Fyear not found');

            return redirect(route('admin.fyears.index'));
        }

        $this->FyearRepository->delete($id);

        Flash::success('Fyear deleted successfully.');

        return redirect(route('admin.fyears.index'));
    }

      

}
