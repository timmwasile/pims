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
use Modules\Recruitments\DataTables\SalaryDataTable;
use Modules\Recruitments\Entities\Loan;
use Modules\Recruitments\Entities\Monthly;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Salary;
use Modules\Recruitments\Http\Repositories\SalaryRepository;
use Modules\Recruitments\Http\Requests\CreateSalaryRequest;
use Modules\Recruitments\Http\Requests\UpdatePaymentRequest;
use Illuminate\Support\Facades\View as viewhtml;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Recruitments\Entities\Employee;
use Modules\Recruitments\Entities\Employee_Monthly_Deduction;
use Modules\Recruitments\Entities\Employee_Monthly_Payment;
use Modules\Recruitments\Entities\Loan_Transaction;
use Modules\Recruitments\Entities\Payroll;
use Modules\Recruitments\Entities\Standard;
use PDF;
use Request;
use Storage;
use URL;

use function app\bootstrap\randGenerator;

class SalaryController extends AppBaseController
{
    /** @var SalaryRepository */
    private $SalaryRepository;

    public function __construct(SalaryRepository $SalaryRepo)
    {
        $this->SalaryRepository = $SalaryRepo;
    }

    /**
     * Display a listing of the salary.
     *
     * @param SalaryDataTable $SalaryDataTable
     *
     * @return Response
     */
    public function index(SalaryDataTable $SalaryDataTable)
    {
        abort_if(Gate::denies('salary_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $SalaryDataTable->render('backend.salaries.index');
    }

    /**
     * Show the form for creating a new salary.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('salary_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.salaries.create');
    }

    /**
     * Store a newly created salary in storage.
     *
     * @param CreateSalaryRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateSalaryRequest $request)
    {
       $input = $request->all();
        payroll::where('status_id',1)->update(['started_at' => $request->started_date,
                                               'ended_at' => $request->ended_date
                                            ]);

            
        $Salary = $this->SalaryRepository->create($input);
        Flash::success('salary saved successfully.');

        return redirect(route('admin.salaries.index'));
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
        $query=Salary::where('id', $id)->get()->first();
        abort_if(Gate::denies('salary_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salary = $this->SalaryRepository->find($id);

        if (empty($salary)) {
            Flash::error('salary not found');

            return redirect(route('admin.salaries.index'));
        }
       $loan= DB::table('loan_transaction')->where('started_at', $query->started_at)->sum('pmt');
       $deduction= DB::table('employee_monthly_deduction')->where('started_at', $query->started_at)->sum('amount');
       $payment= DB::table('employee_monthly_payment')->where('started_at', $query->started_at)->sum('amount');


        return view('backend.salaries.show',compact('salary','loan','payment','deduction'));
        // return view('backend.salaries.show')->with('salary','loan', $salary,$loan);
    }

    /**
     * Show the form for editing the specified salary.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('salary_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salary = $this->SalaryRepository->find($id);

        if (empty($salary)) {
            Flash::error('salary not found');

            return redirect(route('admin.salaries.index'));
        }
        return view('backend.salaries.edit')->with('salary', $salary);
    }

    /**
     * Update the specified salary in storage.
     *
     * @param int                   $id
     * @param UpdatePaymentRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdatePaymentRequest $request)
    {
        $salary = $this->SalaryRepository->find($id);

        if (empty($salary)) {
            Flash::error('salary not found');

            return redirect(route('admin.salaries.index'));
        }
        $salary = $this->SalaryRepository->update($request->all(), $id);

        Flash::success('salary updated successfully.');

        return redirect(route('admin.salaries.index'));
    }

    /**
     * Remove the specified salary from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('salary_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $salary = $this->SalaryRepository->find($id);

        if (empty($salary)) {
            Flash::error('salary not found');

            return redirect(route('admin.salaries.index'));
        }

        $this->SalaryRepository->delete($id);

        Flash::success('salary deleted successfully.');

        return redirect(route('admin.salaries.index'));
    }

    /**
     * Create a printable and downloadable Salary Summary.
     *
     * @param  \App\Models\Salary $salary
     * @return \Barryvdh\DomPDF\PDF
     */
    public function print(Salary $salary) {

        abort_if(Gate::denies('salary_print_payroll_summary'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $dompdf = new Dompdf();
        $query= Salary::where('id', $salary->id)->get()->first();

        $payrolls=Standard::where('salary_id',$query->id )->get();
        $payments = Employee_Monthly_Payment::select('payments.name as name',
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
