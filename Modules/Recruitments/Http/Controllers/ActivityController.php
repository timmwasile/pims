<?php

namespace Modules\Recruitments\Http\Controllers;

use DB;
use Gate;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Modules\Recruitments\DataTables\ActivityDataTable;
use Modules\Recruitments\DataTables\PaymentDataTable;
use Modules\Recruitments\Entities\Activity;
use Modules\Recruitments\Entities\ActivityTransaction;
use Modules\Recruitments\Entities\Fyear;
use Modules\Recruitments\Entities\Office;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Http\Repositories\ActivityRepository;
use Modules\Recruitments\Http\Repositories\PaymentRepository;
use Modules\Recruitments\Http\Requests\CreateActivityRequest;
use Modules\Recruitments\Http\Requests\CreateActivityTransactionRequest;
use Modules\Recruitments\Http\Requests\CreatePaymentRequest;
use Modules\Recruitments\Http\Requests\UpdateActivityRequest;
use Modules\Recruitments\Http\Requests\UpdatePaymentRequest;
use Request;

use function app\bootstrap\randGenerator;
use function app\bootstrap\TransactionNumber;

class ActivityController extends AppBaseController
{
    /** @var ActivityRepository */
    private $ActivityRepository;

    public function __construct(ActivityRepository $ActivityRepo)
    {
        $this->ActivityRepository = $ActivityRepo;
    }

    /**
     * Display a listing of the Activity.
     *
     * @param ActivityDataTable $ActivityDataTable
     *
     * @return Response
     */
    public function index(ActivityDataTable $ActivityDataTable)
    {
        abort_if(Gate::denies('activity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $ActivityDataTable->render('backend.activities.index');
    }

    /**
     * Show the form for creating a new Activity.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('activity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $fyears = Fyear::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('backend.activities.create',compact('fyears'));
    }

    /**
     * Store a newly created Activity in storage.
     *
     * @param CreateActivityRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateActivityRequest $request)
    {
        // dd($request);
        $input = $request->all();

        $Activity = $this->ActivityRepository->create($input);

        Flash::success('Activity saved successfully.');

        return redirect(route('admin.activities.index'))->with('success', ' ' . ucwords($request->name) . '  is created successfully.');
    }

    /**
     * Display the specified Activity.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('activity_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Activity = $this->ActivityRepository->find($id);

        if (empty($Activity)) {
            Flash::error('Activity not found');

            return redirect(route('admin.activities.index'));
        }

        return view('backend.activities.show')->with('Activity', $Activity);
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

        $Activity = $this->ActivityRepository->find($id);
        $fyears = Fyear::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        if (empty($Activity)) {
            Flash::error('Activity not found');

            return redirect(route('admin.activities.index'));
        }
        return view('backend.activities.edit',compact('fyears'))->with('Activity', $Activity);
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
        $Activity = $this->ActivityRepository->find($id);
       
        if (empty($Activity)) {
            Flash::error('Activity not found');

            return redirect(route('admin.activities.index'));
        }

        $Activity = $this->ActivityRepository->update($request->all(), $id);

        Flash::success('Activity updated successfully.');

        return redirect(route('admin.activities.index'))->with('success', ' ' . ucwords($request->name) . '  is Updated successfully.');
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
        abort_if(Gate::denies('activity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Activity = $this->ActivityRepository->find($id);

        if (empty($Activity)) {
            Flash::error('Activity not found');

            return redirect(route('admin.activities.index'));
        }

        $this->ActivityRepository->delete($id);

        Flash::success('Activity deleted successfully.');

        return redirect(route('admin.activities.index'));
    }

      /**
     * Show the form for expenses the specified Activity.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function expense($id)
    {
        abort_if(Gate::denies('activity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Activity = $this->ActivityRepository->find($id);
        $fyears = Fyear::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $offices = Office::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $activity = Activity::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        if (empty($Activity)) {
            Flash::error('Activity not found');

            return redirect(route('admin.activities.index'));
        }
        return view('backend.activities.transaction',compact('fyears','offices','activity'))->with('Activity', $Activity);
    }

    /**
     * Update the specified Activity in storage.
     *
     * @param int                   $id
     * @param UpdateActivityRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function transact($id, CreateActivityTransactionRequest $request)
    {
        $Activity = $this->ActivityRepository->find($id);
       
        if (empty($Activity)) {
            Flash::error('Activity not found');

            return redirect(route('admin.activities.index'));
        }

        $Activity = $this->ActivityRepository->update($request->all(), $id);

        $transaction = ActivityTransaction::create($request->all());
        $transaction->update(['number'=>TransactionNumber('transaction_number', $transaction->id)]);

        Flash::success('Transaction updated successfully.');

        return redirect(route('admin.activities.index'))->with('success', ' ' . ucwords($request->name) . '  is Updated successfully.');
    }
 

}
