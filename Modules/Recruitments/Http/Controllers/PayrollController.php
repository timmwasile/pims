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
use Modules\Recruitments\DataTables\PayrollDataTable;
use Modules\Recruitments\Entities\Employee;
use Modules\Recruitments\Http\Repositories\PayrollRepository;
use Modules\Recruitments\Http\Requests\CreatePayrollRequest;
use Modules\Recruitments\Http\Requests\UpdatePayrollRequest;

use function app\bootstrap\randGenerator;

class PayrollController extends AppBaseController
{
    /** @var PayrollRepository */
    private $PayrollRepository;

    public function __construct(PayrollRepository $PayrollRepo)
    {
        $this->PayrollRepository = $PayrollRepo;
    }

    /**
     * Display a listing of the Payroll.
     *
     * @param PayrollDataTable $PayrollDataTable
     *
     * @return Response
     */
    public function index(PayrollDataTable $PayrollDataTable)
    {
        abort_if(Gate::denies('payroll_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $PayrollDataTable->render('backend.payrolls.index');
    }

    /**
     * Show the form for creating a new Payroll.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('payroll_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $employees = Employee::get();
        return view('backend.payrolls.create',compact('employees'));
    }

    /**
     * Store a newly created Payroll in storage.
     *
     * @param CreatePayrollRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreatePayrollRequest $request)
    {
        $input = $request->all();

        $Payroll = $this->PayrollRepository->create($input);

        Flash::success('Payroll saved successfully.');

        return redirect(route('admin.payrolls.index'));
    }

    /**
     * Display the specified Payroll.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('payroll_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Payroll = $this->PayrollRepository->find($id);

        if (empty($Payroll)) {
            Flash::error('Payroll not found');

            return redirect(route('admin.payrolls.index'));
        }

        return view('backend.payrolls.show')->with('Payroll', $Payroll);
    }

    /**
     * Show the form for editing the specified Payroll.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('payroll_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payroll = $this->PayrollRepository->find($id);

        if (empty($payroll)) {
            Flash::error('Payroll not found');

            return redirect(route('admin.payrolls.index'));
        }
        $employees = Employee::get();
        return view('backend.payrolls.edit',compact('employees'))->with('payroll', $payroll);
    }

    /**
     * Update the specified Payroll in storage.
     *
     * @param int                   $id
     * @param UpdatePayrollRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdatePayrollRequest $request)
    {
        $payroll = $this->PayrollRepository->find($id);

        if (empty($payroll)) {
            Flash::error('Payroll not found');

            return redirect(route('admin.payrolls.index'));
        }
        $payroll = $this->PayrollRepository->update($request->all(), $id);

        Flash::success('Payroll updated successfully.');

        return redirect(route('admin.payrolls.index'));
    }

    /**
     * Remove the specified Payroll from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('payroll_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Payroll = $this->PayrollRepository->find($id);

        if (empty($Payroll)) {
            Flash::error('Payroll not found');

            return redirect(route('admin.payrolls.index'));
        }

        $this->PayrollRepository->delete($id);

        Flash::success('Payroll deleted successfully.');

        return redirect(route('admin.payrolls.index'));
    }
}
