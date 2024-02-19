<?php

namespace Modules\Recruitments\Http\Controllers;

use App\Exports\SalaryExport;
use Dompdf\Dompdf;
use File;
use Gate;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Modules\Recruitments\Entities\Salary;
use Modules\Recruitments\Http\Requests\CreateProjectRequest;
use Modules\Recruitments\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\View as viewhtml;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Recruitments\DataTables\ProjectDataTable;
use Modules\Recruitments\Entities\Employee;
use Modules\Recruitments\Entities\Employee_Monthly_Deduction;
use Modules\Recruitments\Entities\Employee_Monthly_Payment;
use Modules\Recruitments\Entities\Loan_Transaction;
use Modules\Recruitments\Entities\Payroll;
use Modules\Recruitments\Entities\Project;
use Modules\Recruitments\Entities\Standard;
use Modules\Recruitments\Http\Repositories\ProjectRepository;
use PDF;
use Request;
use Storage;
use URL;

use function app\bootstrap\randGenerator;

class ProjectController extends AppBaseController
{
    /** @var ProjectRepository */
    private $ProjectRepository;

    public function __construct(ProjectRepository $ProjectRepo)
    {
        $this->ProjectRepository = $ProjectRepo;
    }

    /**
     * Display a listing of the Project.
     *
     * @param ProjectDataTable $ProjectDataTable
     *
     * @return Response
     */
    public function index(ProjectDataTable $ProjectDataTable)
    {
        abort_if(Gate::denies('project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $ProjectDataTable->render('backend.projects.index');
    }

    /**
     * Show the form for creating a new Project.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.projects.create');
    }

    /**
     * Store a newly created salary in storage.
     *
     * @param CreateProjectRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateProjectRequest $request)
    {
       $input = $request->all();
        $Project = $this->ProjectRepository->create($input);
        Flash::success('Project saved successfully.');

        return redirect(route('admin.projects.index'));
    }

    /**
     * Display the specified salary.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('project_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $project = $this->ProjectRepository->find($id);
        if (empty($project)) {
            Flash::error('project not found');
            return redirect(route('admin.projects.index'));
        }
        return view('backend.projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified project.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('project_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $project = $this->ProjectRepository->find($id);

        if (empty($project)) {
            Flash::error('project not found');

            return redirect(route('admin.projects.index'));
        }
        return view('backend.projects.edit')->with('project', $project);
    }

    /**
     * Update the specified project in storage.
     *
     * @param int                   $id
     * @param UpdateProjectRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateProjectRequest $request)
    {
        $project = $this->ProjectRepository->find($id);

        if (empty($project)) {
            Flash::error('project not found');

            return redirect(route('admin.projects.index'));
        }
        $project = $this->ProjectRepository->update($request->all(), $id);

        Flash::success('project updated successfully.');

        return redirect(route('admin.projects.index'));
    }

    /**
     * Remove the specified project from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('project_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $project = $this->ProjectRepository->find($id);

        if (empty($project)) {
            Flash::error('project not found');

            return redirect(route('admin.projects.index'));
        }

        $this->ProjectRepository->delete($id);

        Flash::success('project deleted successfully.');

        return redirect(route('admin.projects.index'));
    }

    /**
     * Create a printable and downloadable project Summary.
     *
     * @param  \App\Models\Project $project
     * @return \Barryvdh\DomPDF\PDF
     */
    public function print(Project $project) {
        dd("under construction");

        abort_if(Gate::denies('print_project_status'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $dompdf = new Dompdf();
        $query= Project::where('id', $project->id)->get()->first();

        $project = Project::select('payments.name as name',
                        DB::raw('SUM(amount) as amount'))
                        ->join('payments', 'payments.id', '=', 'employee_monthly_payment.monthly_id')
                        ->join('salaries', 'salaries.started_at', '=', 'employee_monthly_payment.started_at')
                        ->groupBy('payments.name')
                        ->where('salaries.id',$query->id)
                        ->get();

        $total_payment = $payments -> pluck('amount')->sum();         
     
         $deductions = Employee_Monthly_Deduction::select('deductions.name as name',
                        DB::raw('SUM(amount) as amount'))
                        ->join('deductions', 'deductions.id', '=', 'employee_monthly_deduction.monthly_id')
                        ->join('salaries', 'salaries.started_at', '=', 'employee_monthly_deduction.started_at')
                        ->groupBy('deductions.name')
                        ->where('salaries.id',$query->id)
                        ->get();
        $total_deduction = $deductions -> pluck('amount')->sum();

        $loans = Loan_Transaction::select('loans.description as description',
                                    DB::raw('SUM(loan_transaction.pmt) as amount'))
                                    ->join('loans', 'loans.id', '=', 'loan_transaction.loan_id')
                                    ->join('salaries', 'salaries.started_at', '=', 'loan_transaction.started_at')
                                    ->groupBy('loans.description')
                                    ->where('salaries.id',$query->id)
                                    ->get();
        $total_loan = $loans -> pluck('amount')->sum();
        $total_paye = $payrolls -> pluck('paye')->sum();
        $total_nssf = $payrolls -> pluck('nssf')->sum();
        $total_nhif = $payrolls -> pluck('nhif')->sum();
        $total_basic_pay = $payrolls -> pluck('basic')->sum();
        $viewContent = viewhtml::make('backend.salaries.print',compact(
            'query',
            'payments',
            'total_payment',
            'deductions',
            'total_deduction',
            'loans',
            'total_loan',
            'total_paye',
            'total_nssf',
            'total_basic_pay',
            'total_nhif',
            ))
            ->render();
        $file_name = str_ireplace(' ', '', date("MY", strtotime($query->started_at))) . '_Control_Statement';
        $dompdf->loadHtml($viewContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream($file_name.".pdf"); //
         return $dompdf->stream(); // Output the generated PDF to the browser
        
    }

 public function deduction($employeeId,$salaryID){
$deduction=DB::table('employee_monthly_deduction')
->where('employee_monthly_deduction.employee_id', $employeeId)
->where('employee_monthly_deduction.salary_id', $salaryID)
->sum(DB::raw('
    COALESCE(employee_monthly_deduction.amount,0)'
 ));
return $deduction;
 }

public function payment($employeeId,$salaryID){
$payment=DB::table('employee_monthly_payment')
->where('employee_monthly_payment.employee_id', $employeeId)
->where('employee_monthly_payment.salary_id', $salaryID)
->sum(DB::raw('
    COALESCE(employee_monthly_payment.amount,0)'
 ));
return $payment;
 }

  public function loan($employeeId,$salaryID){
$loan=DB::table('loan_transaction')
->where('loan_transaction.employee_id', $employeeId)
->where('loan_transaction.salary_id', $salaryID)
->sum(DB::raw('
    COALESCE(loan_transaction.pmt,0)'
 ));
return $loan;
 }
 
    /**
     * Create a exportable and downloadable  bank files.
     *
     * @param  \App\Models\Salary $salary
     * @return \Barryvdh\DomPDF\PDF
     */
    public function export($salary, $started_at) {
        $payment_date=Salary::where('id',$salary)->get()->first();

        $start_date_find = strtotime(date("Y-m-d", strtotime(date('Y-m-d'))) . ", first day of this month");
        $start_date = date("Y-m-d",$start_date_find);
        
        $employee=Employee::select('employees.id','employees.basic_salary','standards.paye','standards.nhif','standards.nssf','employees.name','employees.bank_account','banks.name as bank_name')
        ->JOIN ('payrolls',  'payrolls.employee_id', '=' ,'employees.id' )
       ->JOIN ('standards'  , 'standards.employee_id', '=', 'employees.id' )
       ->JOIN('banks', 'banks.id' ,'=', 'employees.bank_id')
        ->where('standards.started_at',$started_at)
       ->WHERE ('standards.salary_id', $salary)
       ->groupBY('employees.id')
        ->get();
$result=[];
$grandResult=[];
$id=1;
       foreach ($employee as $row) {
        $empId=$row['id'];

                
        $net_pay=(($row['basic_salary']+$this->payment($empId,$salary))-($row['nssf']+$row['nhif']+$row['paye']+$this->loan($empId,$salary)+$this->deduction($empId,$salary)));
       
        $result['id']=$id++;
        $result['name']=$row['name'];
        $result['net_pays']=$net_pay;
        $result['bank_account']=$row['bank_account'];
        $result['bank_name']=$row['bank_name'];
        $result['payment_date']=date('F Y', strtotime($payment_date->started_at));
        $grandResult[]=$result;

       }
        $export = $grandResult;

        return Excel::download(new SalaryExport($export), 'BankFiles.csv');
        abort_if(Gate::denies('salary_print_payroll_summary'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $dompdf = new Dompdf();
        $query= Salary::where('id', $salary->id)->get()->first();
        // dd($query->started_at); //employee_monthly_payment
        $payrolls=Payroll::get();

        $payments = Employee_Monthly_Payment::select('payments.name as name',
                        DB::raw('SUM(amount) as amount'))
                        ->join('payments', 'payments.id', '=', 'employee_monthly_payment.monthly_id')
                        ->join('salaries', 'salaries.started_at', '=', 'employee_monthly_payment.started_at')
                        ->groupBy('payments.name')
                        ->where('salaries.id',$query->id)
                        ->where('employee_monthly_payment.started_at',$started_at)
                        ->get();
        $total_payment = $payments -> pluck('amount')->sum();         
     

         $deductions = Employee_Monthly_Deduction::select('deductions.name as name',
                        DB::raw('SUM(amount) as amount'))
                        ->join('deductions', 'deductions.id', '=', 'employee_monthly_deduction.monthly_id')
                        ->join('salaries', 'salaries.started_at', '=', 'employee_monthly_deduction.started_at')
                        ->groupBy('deductions.name')
                        ->where('salaries.id',$query->id)
                        ->where('employee_monthly_deduction.started_at',$started_at)
                        ->get();
        $total_deduction = $deductions -> pluck('amount')->sum();

        $loans = Loan_Transaction::select('loans.description as description',
                                    DB::raw('SUM(loan_transaction.pmt) as amount'))
                                    ->join('loans', 'loans.id', '=', 'loan_transaction.loan_id')
                                    ->join('salaries', 'salaries.started_at', '=', 'loan_transaction.started_at')
                                    ->groupBy('loans.description')
                                    ->where('loan_transaction.started_at',$started_at)
                                    ->where('salaries.id',$query->id)
                                    ->get();

        $total_loan = $loans -> pluck('amount')->sum();
        $total_paye = $payrolls -> pluck('paye')->sum();
        $total_nssf = $payrolls -> pluck('nssf')->sum();
        $total_nhif = $payrolls -> pluck('nhif')->sum();
        $total_basic_pay = $payrolls -> pluck('basic_pay')->sum();
        $viewContent = viewhtml::make('backend.salaries.print',compact(
            'query',
            'payments',
            'total_payment',
            'deductions',
            'total_deduction',
            'loans',
            'total_loan',
            'total_paye',
            'total_nssf',
            'total_basic_pay',
            'total_nhif',
            ))
            ->render();

        $dompdf->loadHtml($viewContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream(); // Output the generated PDF to the browser
        
    }
     
   }
