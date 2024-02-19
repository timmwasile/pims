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
use Modules\Recruitments\DataTables\JobtitleDataTable;
use Modules\Recruitments\DataTables\PaymentDataTable;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Http\Repositories\JobtitleRepository;
use Modules\Recruitments\Http\Repositories\PaymentRepository;
use Modules\Recruitments\Http\Requests\CreateJobtitleRequest;
use Modules\Recruitments\Http\Requests\CreatePaymentRequest;
use Modules\Recruitments\Http\Requests\UpdateJobtitleRequest;
use Modules\Recruitments\Http\Requests\UpdatePaymentRequest;
use Request;

use function app\bootstrap\randGenerator;

class JobtitleController extends AppBaseController
{
    /** @var JobtitleRepository */
    private $JobtitleRepository;

    public function __construct(JobtitleRepository $JobtitleRepo)
    {
        $this->JobtitleRepository = $JobtitleRepo;
    }

    /**
     * Display a listing of the Jobtitle.
     *
     * @param JobtitleDataTable $JobtitleDataTable
     *
     * @return Response
     */
    public function index(JobtitleDataTable $JobtitleDataTable)
    {
        abort_if(Gate::denies('jobtitle_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $JobtitleDataTable->render('backend.jobtitles.index');
    }

    /**
     * Show the form for creating a new Jobtitle.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('jobtitle_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.jobtitles.create');
    }

    /**
     * Store a newly created Jobtitle in storage.
     *
     * @param CreateJobtitleRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateJobtitleRequest $request)
    {
        $input = $request->all();

        $Jobtitle = $this->JobtitleRepository->create($input);

        Flash::success('Jobtitle saved successfully.');

        return redirect(route('admin.jobtitles.index'));
    }

    /**
     * Display the specified Jobtitle.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('jobtitle_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Jobtitle = $this->JobtitleRepository->find($id);

        if (empty($Jobtitle)) {
            Flash::error('Jobtitle not found');

            return redirect(route('admin.jobtitles.index'));
        }

        return view('backend.jobtitles.show')->with('Jobtitle', $Jobtitle);
    }

    /**
     * Show the form for editing the specified Jobtitle.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('jobtitle_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Jobtitle = $this->JobtitleRepository->find($id);

        if (empty($Jobtitle)) {
            Flash::error('Jobtitle not found');

            return redirect(route('admin.jobtitles.index'));
        }
        return view('backend.jobtitles.edit')->with('Jobtitle', $Jobtitle);
    }

    /**
     * Update the specified Jobtitle in storage.
     *
     * @param int                   $id
     * @param UpdateJobtitleRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateJobtitleRequest $request)
    {
        $Jobtitle = $this->JobtitleRepository->find($id);

        if (empty($Jobtitle)) {
            Flash::error('Jobtitle not found');

            return redirect(route('admin.jobtitles.index'));
        }
        $Jobtitle = $this->JobtitleRepository->update($request->all(), $id);

        Flash::success('Jobtitle updated successfully.');

        return redirect(route('admin.jobtitles.index'));
    }

    /**
     * Remove the specified Jobtitle from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('jobtitle_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Jobtitle = $this->JobtitleRepository->find($id);

        if (empty($Jobtitle)) {
            Flash::error('Jobtitle not found');

            return redirect(route('admin.jobtitles.index'));
        }

        $this->JobtitleRepository->delete($id);

        Flash::success('Jobtitle deleted successfully.');

        return redirect(route('admin.jobtitles.index'));
    }

      

}
