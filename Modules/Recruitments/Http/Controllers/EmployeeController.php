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
use Modules\Recruitments\DataTables\EmployeeDataTable;
use Modules\Recruitments\Entities\Bank;
use Modules\Recruitments\Entities\Employee;
use Modules\Recruitments\Entities\Gender;
use Modules\Recruitments\Entities\JobTitle;
use Modules\Recruitments\Entities\Office;
use Modules\Recruitments\Entities\Payroll;
use Modules\Recruitments\Entities\Standard;
use Modules\Recruitments\Entities\Taxe;
use Modules\Recruitments\Http\Repositories\EmployeeRepository;
use Modules\Recruitments\Http\Requests\CreateEmployeeRequest;
use Modules\Recruitments\Http\Requests\UpdateEmployeeRequest;

use function app\bootstrap\randGenerator;

class EmployeeController extends AppBaseController
{
    /** @var EmployeeRepository */
    private $EmployeeRepository;

    public function __construct(EmployeeRepository $EmployeeRepo)
    {
        $this->EmployeeRepository = $EmployeeRepo;
    }

    /**
     * Display a listing of the Employee.
     *
     * @param EmployeeDataTable $EmployeeDataTable
     *
     * @return Response
     */
    public function index(EmployeeDataTable $EmployeeDataTable)
    {
        abort_if(Gate::denies('employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return $EmployeeDataTable->render('backend.employees.index');
    }

    /**
     * Show the form for creating a new Employee.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        
        abort_if(Gate::denies('employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $jobtitles = JobTitle::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $banks = Bank::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $genders = Gender::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $offices = Office::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('backend.employees.create', compact('jobtitles','banks','genders','offices'));
    }

    /**
     * Store a newly created Employee in storage.
     *
     * @param CreateEmployeeRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateEmployeeRequest $request)
    {
        $basic2 = $request->basic_salary-($request->basic_salary*0.1);
       $rates  =  Taxe::where('max_amount', '>=',$basic2)->first();
       $nssf_employee = $request->basic_salary*0.1;
       $nhif_employee = $request->basic_salary*0.03;
       $after_deduction=$request->basic_salary - $nssf_employee;
        $taxable_amount=$request->basic_salary-$nssf_employee;

        $taxable_amount_income  =  Taxe::where('max_amount', '>=',$taxable_amount)->first()->constant_amount;
       $paye= ($taxable_amount_income +($rates->rate *($taxable_amount-($rates->min_amount-1))));
       
        $input = $request->all();

        $Employee = $this->EmployeeRepository->create($input);

        $Employee->update(['number'=>randGenerator('EmployeeRegistration', $Employee->id)]);
            $payroll = Payroll::updateOrCreate([
                'basic_pay' => $request->basic_salary, 
                'nssf' => $nssf_employee,
                'paye' => $paye,
                'net_pay' =>0,
                'nhif' => $nhif_employee,
                'employee_id' => $Employee->id
            ]);

        $start_date_find = strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . ", first day of this month");
        $started_at = date("Y-m-d",$start_date_find);

        $end_date_find = strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . ", last day of this month");
        $ended_at = date("Y-m-d",$end_date_find);
           
    
        Flash::success('Employee saved successfully.');

        return redirect(route('admin.employees.index'));
    }

    /**
     * Display the specified Employee.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('employee_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Employee = $this->EmployeeRepository->find($id);

        if (empty($Employee)) {
            Flash::error('Employee not found');

            return redirect(route('admin.employees.index'));
        }
         $jobtitles = JobTitle::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $banks = Bank::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $genders = Gender::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $offices = Office::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('backend.employees.show',compact('jobtitles','banks','genders','offices'))->with('Employee', $Employee);
    }

    /**
     * Show the form for editing the specified Employee.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $employee = $this->EmployeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('admin.employees.index'));
        }
         $jobtitles = JobTitle::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $banks = Bank::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $genders = Gender::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $offices = Office::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('backend.employees.edit',compact('jobtitles','banks','genders','offices'))->with('employee', $employee);
    }

    /**
     * Update the specified Employee in storage.
     *
     * @param int                   $id
     * @param UpdateEmployeeRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateEmployeeRequest $request)
    {
        $employee = $this->EmployeeRepository->find($id);

        if (empty($employee)) {
            Flash::error('Employee not found');

            return redirect(route('admin.employees.index'));
        }
        $basic2 = $request->basic_salary-($request->basic_salary*0.1);
        $rates  =  Taxe::where('max_amount', '>=',$basic2)->first();
       $nssf_employee = $request->basic_salary*0.1;
       $nhif_employee = $request->basic_salary*0.03;
       $after_deduction=$request->basic_salary - $nssf_employee;
        $taxable_amount=$request->basic_salary-$nssf_employee;
        $taxable_amount_income  =  Taxe::where('max_amount', '>=',$taxable_amount)->first()->constant_amount;
       $paye= ($taxable_amount_income +($rates->rate *($taxable_amount-($rates->min_amount-1))));

        $employee = $this->EmployeeRepository->update($request->all(), $id);

        $payroll = Payroll::where('employee_id', $id)->update([
                'basic_pay' => $request->basic_salary, 
                'nssf' => $nssf_employee,
                'paye' => $paye,
                'net_pay' =>0,
                'nhif' => $nhif_employee,
                'employee_id' => $id
            ]);
        $start_date_find = strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . ", first day of this month");
        $started_at = date("Y-m-d",$start_date_find);

        $end_date_find = strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . ", last day of this month");
        $ended_at = date("Y-m-d",$end_date_find);
           
        Flash::success('Employee updated successfully.');

        return redirect(route('admin.employees.index'));
    }

    /**
     * Remove the specified Employee from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $Employee = $this->EmployeeRepository->find($id);

        if (empty($Employee)) {
            Flash::error('Employee not found');

            return redirect(route('admin.employees.index'));
        }

        $this->EmployeeRepository->delete($id);

        Flash::success('Employee deleted successfully.');

        return redirect(route('admin.employees.index'));
    }
}
