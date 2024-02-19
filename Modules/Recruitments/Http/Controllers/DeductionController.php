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
use Modules\Recruitments\DataTables\DeductionDataTable;
use Modules\Recruitments\Entities\Deduction;
use Modules\Recruitments\Http\Repositories\DeductionRepository;
use Modules\Recruitments\Http\Requests\CreateDeductionRequest;
use Modules\Recruitments\Http\Requests\UpdateDeductionRequest;
use Request;

use function app\bootstrap\randGenerator;

class DeductionController extends AppBaseController
{
    /** @var DeductionRepository */
    private $DeductionRepository;

    public function __construct(DeductionRepository $DeductionRepo)
    {
        $this->DeductionRepository = $DeductionRepo;
    }

    /**
     * Display a listing of the Deduction.
     *
     * @param DeductionDataTable $DeductionDataTable
     *
     * @return Response
     */
    public function index(DeductionDataTable $DeductionDataTable)
    {
        abort_if(Gate::denies('deduction_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $DeductionDataTable->render('backend.deductions.index');
    }

    /**
     * Show the form for creating a new Payment.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('deduction_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.deductions.create');
    }

    /**
     * Store a newly created Deductions in storage.
     *
     * @param CreateDeductionRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateDeductionRequest $request)
    {
        $input = $request->all();

        $Deduction = $this->DeductionRepository->create($input);

        Flash::success('Deduction saved successfully.');

        return redirect(route('admin.deductions.index'));
    }

    /**
     * Display the specified Deductions.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('deduction_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deduction = $this->DeductionRepository->find($id);

        if (empty($Deduction)) {
            Flash::error('Deduction not found');

            return redirect(route('admin.deductions.index'));
        }

        return view('backend.deductions.show')->with('Deduction', $deduction);
    }

    /**
     * Show the form for editing the specified Deduction.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('deduction_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deduction = $this->DeductionRepository->find($id);

        if (empty($deduction)) {
            Flash::error('Deduction not found');

            return redirect(route('admin.deductions.index'));
        }
        return view('backend.deductions.edit')->with('deduction', $deduction);
    }

    /**
     * Update the specified Deduction in storage.
     *
     * @param int                   $id
     * @param UpdateDeductionRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateDeductionRequest $request)
    {
        $deduction = $this->DeductionRepository->find($id);

        if (empty($deduction)) {
            Flash::error('deduction not found');

            return redirect(route('admin.deductions.index'));
        }
        $deduction = $this->DeductionRepository->update($request->all(), $id);

        Flash::success('deduction updated successfully.');

        return redirect(route('admin.deductions.index'));
    }

    /**
     * Remove the specified deduction from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('deduction_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $deduction = $this->DeductionRepository->find($id);

        if (empty($payment)) {
            Flash::error('deduction not found');

            return redirect(route('admin.deductions.index'));
        }

        $this->DeductionRepository->delete($id);

        Flash::success('deduction deleted successfully.');

        return redirect(route('admin.deductions.index'));
    }

      

}
