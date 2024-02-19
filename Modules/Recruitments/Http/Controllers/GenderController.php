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
use Modules\Recruitments\DataTables\GenderDataTable;
use Modules\Recruitments\DataTables\PaymentDataTable;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Http\Repositories\GenderRepository;
use Modules\Recruitments\Http\Repositories\PaymentRepository;
use Modules\Recruitments\Http\Requests\CreateGenderRequest;
use Modules\Recruitments\Http\Requests\CreatePaymentRequest;
use Modules\Recruitments\Http\Requests\UpdateGenderRequest;
use Modules\Recruitments\Http\Requests\UpdatePaymentRequest;
use Request;

use function app\bootstrap\randGenerator;

class GenderController extends AppBaseController
{
    /** @var GenderRepository */
    private $GenderRepository;

    public function __construct(GenderRepository $GenderRepo)
    {
        $this->GenderRepository = $GenderRepo;
    }

    /**
     * Display a listing of the Gender.
     *
     * @param GenderDataTable $GenderDataTable
     *
     * @return Response
     */
    public function index(GenderDataTable $GenderDataTable)
    {
        abort_if(Gate::denies('gender_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $GenderDataTable->render('backend.genders.index');
    }

    /**
     * Show the form for creating a new Gender.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('gender_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.genders.create');
    }

    /**
     * Store a newly created Gender in storage.
     *
     * @param CreateGenderRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateGenderRequest $request)
    {
        $input = $request->all();

        $Gender = $this->GenderRepository->create($input);

        Flash::success('Gender saved successfully.');

        return redirect(route('admin.genders.index'));
    }

    /**
     * Display the specified Gender.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('gender_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Gender = $this->GenderRepository->find($id);

        if (empty($Gender)) {
            Flash::error('Gender not found');

            return redirect(route('admin.genders.index'));
        }

        return view('backend.genders.show')->with('Gender', $Gender);
    }

    /**
     * Show the form for editing the specified Gender.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('gender_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Gender = $this->GenderRepository->find($id);

        if (empty($Gender)) {
            Flash::error('Gender not found');

            return redirect(route('admin.genders.index'));
        }
        return view('backend.genders.edit')->with('Gender', $Gender);
    }

    /**
     * Update the specified Gender in storage.
     *
     * @param int                   $id
     * @param UpdateGenderRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateGenderRequest $request)
    {
        $Gender = $this->GenderRepository->find($id);

        if (empty($Gender)) {
            Flash::error('Gender not found');

            return redirect(route('admin.genders.index'));
        }
        $Gender = $this->GenderRepository->update($request->all(), $id);

        Flash::success('Gender updated successfully.');

        return redirect(route('admin.genders.index'));
    }

    /**
     * Remove the specified Gender from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('gender_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Gender = $this->GenderRepository->find($id);

        if (empty($Gender)) {
            Flash::error('Gender not found');

            return redirect(route('admin.genders.index'));
        }

        $this->GenderRepository->delete($id);

        Flash::success('Gender deleted successfully.');

        return redirect(route('admin.genders.index'));
    }

      

}
