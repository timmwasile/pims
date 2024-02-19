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
use Modules\Recruitments\DataTables\TaxeDataTable;
use Modules\Recruitments\Entities\Taxe;
use Modules\Recruitments\Http\Repositories\TaxeRepository;
use Modules\Recruitments\Http\Requests\CreateTaxeRequest;
use Modules\Recruitments\Http\Requests\UpdateTaxeRequest;

use function app\bootstrap\randGenerator;

class TaxeController extends AppBaseController
{
    /** @var TaxeRepository */
    private $TaxeRepository;

    public function __construct(TaxeRepository $TaxeRepo)
    {
        $this->TaxeRepository = $TaxeRepo;
    }

    /**
     * Display a listing of the Taxe.
     *
     * @param TaxeDataTable $TaxeDataTable
     *
     * @return Response
     */
    public function index(TaxeDataTable $TaxeDataTable)
    {
        abort_if(Gate::denies('taxe_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $TaxeDataTable->render('backend.taxes.index');
    }

    /**
     * Show the form for creating a new Taxe.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('taxe_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.taxes.create');
    }

    /**
     * Store a newly created Taxe in storage.
     *
     * @param CreateTaxeRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateTaxeRequest $request)
    {
        $input = $request->all();

        $Taxe = $this->TaxeRepository->create($input);

        Flash::success('Taxe saved successfully.');

        return redirect(route('admin.taxes.index'));
    }

    /**
     * Display the specified Taxe.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('taxe_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Taxe = $this->TaxeRepository->find($id);

        if (empty($Taxe)) {
            Flash::error('Taxe not found');

            return redirect(route('admin.taxes.index'));
        }

        return view('backend.taxes.show')->with('Taxe', $Taxe);
    }

    /**
     * Show the form for editing the specified Taxe.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('taxe_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxe = $this->TaxeRepository->find($id);

        if (empty($taxe)) {
            Flash::error('Taxe not found');

            return redirect(route('admin.taxes.index'));
        }
        return view('backend.taxes.edit')->with('taxe', $taxe);
    }

    /**
     * Update the specified Taxe in storage.
     *
     * @param int                   $id
     * @param UpdateTaxeRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateTaxeRequest $request)
    {
        $taxe = $this->TaxeRepository->find($id);

        if (empty($taxe)) {
            Flash::error('Taxe not found');

            return redirect(route('admin.taxes.index'));
        }
        $taxe = $this->TaxeRepository->update($request->all(), $id);

        Flash::success('Taxe updated successfully.');

        return redirect(route('admin.taxes.index'));
    }

    /**
     * Remove the specified Taxe from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('taxe_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Taxe = $this->TaxeRepository->find($id);

        if (empty($Taxe)) {
            Flash::error('Taxe not found');

            return redirect(route('admin.taxes.index'));
        }

        $this->TaxeRepository->delete($id);

        Flash::success('Taxe deleted successfully.');

        return redirect(route('admin.taxes.index'));
    }
}
