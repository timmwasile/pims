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
use Modules\Recruitments\DataTables\MonthlyDataTable;
use Modules\Recruitments\Entities\Deduction;
use Modules\Recruitments\Entities\Employee;
use Modules\Recruitments\Entities\Monthly;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Http\Repositories\MonthlyRepository;
use Modules\Recruitments\Http\Requests\CreateMonthlyRequest;
use Modules\Recruitments\Http\Requests\UpdateMonthlyRequest;

use function app\bootstrap\randGenerator;

class MonthlyController extends AppBaseController
{
    /** @var MonthlyRepository */
    private $MonthlyRepository;

    public function __construct(MonthlyRepository $MonthlyRepo)
    {
        $this->MonthlyRepository = $MonthlyRepo;
    }

    /**
     * Display a listing of the Monthly.
     *
     * @param MonthlyDataTable $MonthlyDataTable
     *
     * @return Response
     */
    public function index(MonthlyDataTable $MonthlyDataTable)
    {
        abort_if(Gate::denies('monthly_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $MonthlyDataTable->render('backend.monthlies.index');

    }

    /**
     * Show the form for creating a new Monthly.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('monthly_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employees = Employee::get();
        $payments = Payment::get();
        $deductions = Deduction::get();
        return view('backend.monthlies.create',compact('employees','payments','deductions'));
    }

    /**
     * Store a newly created Monthly in storage.
     *
     * @param CreateMonthlyRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateMonthlyRequest $request)
    {
        $input = $request->all();

        $Monthly = $this->MonthlyRepository->create($input);

        Flash::success('Monthly saved successfully.');

        return redirect(route('admin.monthlies.index'));
    }

    /**
     * Display the specified Monthly.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('monthly_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Monthly = $this->MonthlyRepository->find($id);

        if (empty($Monthly)) {
            Flash::error('Monthly not found');

            return redirect(route('admin.monthlies.index'));
        }

        return view('backend.monthlies.show')->with('Monthly', $Monthly);
    }

    /**
     * Show the form for editing the specified Monthly.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('monthly_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Monthly = $this->MonthlyRepository->find($id);

        if (empty($Monthly)) {
            Flash::error('Monthly not found');

            return redirect(route('admin.monthlies.index'));
        }
        $employees = Employee::get();
        return view('backend.monthlies.edit',compact('employees'))->with('Monthly', $Monthly);
    }

    /**
     * Update the specified Monthly in storage.
     *
     * @param int                   $id
     * @param UpdateMonthlyRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateMonthlyRequest $request)
    {
        $monthly = $this->MonthlyRepository->find($id);

        if (empty($monthly)) {
            Flash::error('monthly not found');

            return redirect(route('admin.monthlies.index'));
        }
        $monthly = $this->MonthlyRepository->update($request->all(), $id);

         if($request->rate >0){
                $pv=$request->monthly_balance;
                $rate=$request->rate/100;
                $top=$pv*$rate;
                $rate_plus1=1+$rate;
                $duration=$request->duration;
                $rate_power=pow($rate_plus1,-$duration);
                $bottom=1-$rate_power;
                $pmt=$top/$bottom;
                $monthly = $this->MonthlyRepository->update(['pmt'=>$pmt],$id);
                $monthly = $this->MonthlyRepository->update(['monthly_balance'=>$request->duration*$pmt], $id);
               } 
               else{
                $pv=$request->monthly_balance;
                $rate=$request->rate/100;
                $top=$pv*$rate;
                $rate_plus1=1+$rate;
                $duration=$request->duration;
                $rate_power=pow($rate_plus1,-$duration);
                $bottom=1-$rate_power;
                $pmt=$top/$bottom;
                $monthly = $this->MonthlyRepository->update(['pmt'=>$pmt],$id);
                $monthly = $this->MonthlyRepository->update(['monthly_balance'=>$request->duration*$pmt], $id);
               }

        Flash::success('monthly updated successfully.');

        return redirect(route('admin.monthlies.index'));
    }

    /**
     * Remove the specified monthly from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('monthly_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $monthly = $this->MonthlyRepository->find($id);

        if (empty($monthly)) {
            Flash::error('monthly not found');

            return redirect(route('admin.monthlies.index'));
        }

        $this->MonthlyRepository->delete($id);

        Flash::success('monthly deleted successfully.');

        return redirect(route('admin.monthlies.index'));
    }
}
