<?php

namespace Modules\Recruitments\Http\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use Gate;
use Laracasts\Flash\Flash;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Modules\Recruitments\DataTables\SalaryDataTable;
use Modules\Recruitments\Entities\Loan;
use Modules\Recruitments\Entities\Monthly;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Salary;
use Modules\Recruitments\Http\Repositories\SalaryRepository;
use Modules\Recruitments\Http\Requests\CreateSalaryRequest;
use Modules\Recruitments\Http\Requests\UpdatePaymentRequest;
use Illuminate\Support\Facades\View as viewhtml;
use Modules\Recruitments\DataTables\Payslip2DataTable;
use Modules\Recruitments\DataTables\PayslipDataTable;
use Modules\Recruitments\Entities\Employee;
use Modules\Recruitments\Entities\Employee_Monthly_Deduction;
use Modules\Recruitments\Entities\Employee_Monthly_Payment;
use Modules\Recruitments\Entities\Loan_Transaction;
use Modules\Recruitments\Entities\Payroll;
use Modules\Recruitments\Entities\Standard;
use Modules\Recruitments\Http\Repositories\PayslipRepository;
use PDF;
use URL;

use function app\bootstrap\randGenerator;

class PayslipController extends AppBaseController
{
    /** @var PayslipRepository */
    private $PayslipRepository;

    public function __construct(PayslipRepository $PayslipRepo)
    {
        $this->PayslipRepository = $PayslipRepo;
    }

    /**
     * Display a listing of the Payslip.
     *
     * @param PayslipDataTable $PayslipDataTable
     *
     * @return Response
     */
    public function index(PayslipDataTable $PayslipDataTable, Request $request)
    {
        abort_if(Gate::denies('payslip_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $salaries= Salary::get();
        return $PayslipDataTable->render('backend.payslips.index',compact('salaries'));
    }
    public function filter(PayslipDataTable $PayslipDataTable, Request $request)
    {
        $salary_id=$request->salary_id;
        abort_if(Gate::denies('payslip_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $salaries= Salary::get();
        echo json_encode($PayslipDataTable);
        exit();
        return $PayslipDataTable->with(['salary_id'=>1])->render('backend.payslips.index2',compact('salaries'));
 }
  

    /**
     * Store a newly created salary in storage.
     *
     * @param CreateSalaryRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
        Flash::success('Payslip saved successfully.');

        return redirect(route('admin.payslips.index'));
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

        $salary = $this->PayslipRepository->find($id);

        if (empty($salary)) {
            Flash::error('salary not found');

            return redirect(route('admin.salaries.index'));
        }
       $loan= DB::table('loan_transaction')->where('started_at', $query->started_at)->sum('pmt');
       $deduction= DB::table('employee_monthly_deduction')->where('started_at', $query->started_at)->sum('amount');
       $payment= DB::table('employee_monthly_payment')->where('started_at', $query->started_at)->sum('amount');


        return view('backend.payslips.show',compact('salary','loan','payment','deduction'));
    }

   

    /**
     * Create a printable and downloadable Salary Summary.
     *
     * @param  \App\Models\Salary $salary
     * @return \Barryvdh\DomPDF\PDF
     */
    public function employee_print_payslip(Request $request,$id, $salary_id, $startdate) {
        $url = Storage::url('logo.jpg');
        abort_if(Gate::denies('salary_print_payroll_summary'), Response::HTTP_FORBIDDEN, '403 Forbidden');
         $options = new Options();
        $options->set('isRemoteEnabled', true);
        
        $dompdf = new Dompdf();
        $query= Employee::where('standards.salary_id', $salary_id)
                        ->join('standards', 'standards.employee_id', '=', 'employees.id')
                        ->where('employees.id',$id)
                        ->get()->first();

        $basic = Standard::select('standards.basic as basic')
                        ->join('employees', 'employees.id', '=', 'standards.employee_id')
                        ->where('standards.salary_id',$salary_id)
                        ->where('employees.id',$id)
                        ->get()->first();
        $paye = Standard::select('standards.paye as paye')
                        ->join('employees', 'employees.id', '=', 'standards.employee_id')
                        ->where('standards.salary_id',$salary_id)
                        ->where('employees.id',$id)
                        ->get()->first();
        $nhif = Standard::select('standards.nhif as nhif')
                        ->join('employees', 'employees.id', '=', 'standards.employee_id')
                        ->where('standards.salary_id',$salary_id)
                        ->where('employees.id',$id)
                        ->get()->first();
        $nssf = Standard::select('standards.nssf as nssf')
                        ->join('employees', 'employees.id', '=', 'standards.employee_id')
                        ->where('standards.salary_id',$salary_id)
                        ->where('employees.id',$id)
                        ->get()->first();
        $payments = Employee_Monthly_Payment::select('payments.name as name',
                        DB::raw('SUM(amount) as amount'))
                        // ->join('payrolls', 'payrolls.started_at', '=', 'employee_monthly_payment.started_at')
                        ->leftjoin('payments', 'payments.id', '=', 'employee_monthly_payment.monthly_id')
                        ->where('employee_monthly_payment.employee_id',$id)
                        ->where('employee_monthly_payment.salary_id',$salary_id)
                        ->groupBy('payments.name')
                        ->get();
        $total_payment = $payments -> pluck('amount')->sum();         
        $deductions = Employee_Monthly_Deduction::select('deductions.name as name',
                        DB::raw('SUM(amount) as amount'))
                        ->leftjoin('deductions', 'deductions.id', '=', 'employee_monthly_deduction.monthly_id')
                        ->groupBy('deductions.name')
                        ->where('employee_monthly_deduction.employee_id',$id)
                        ->where('employee_monthly_deduction.salary_id',$salary_id)
                        ->get();
                        
        $total_deduction = $deductions -> pluck('amount')->sum();
       

        $loans = Loan_Transaction::select('loans.description as name','loan_transaction.balance as balance',
                                    DB::raw('SUM(loan_transaction.pmt) as amount'))
                                    ->leftjoin('loans', 'loans.id', '=', 'loan_transaction.loan_id')
                                    ->groupBy('loans.description','loan_transaction.balance')
                                    ->where('loan_transaction.salary_id',$salary_id)
                                    ->where('loan_transaction.employee_id',$id)
                                    ->get();
        $total_loan = $loans -> pluck('amount')->sum();
        // dd($total_loan);

        $viewContent = viewhtml::make('backend.payslips.payslip',compact('url','query','payments','total_payment','deductions','total_deduction','loans','total_loan','basic','paye','nhif','nssf'))->render();
        
        $file_name = str_ireplace(' ', '', ucwords($query->name)) . '_Payslip';
        $dompdf->loadHtml($viewContent);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream($file_name.".pdf"); // Output the generated PDF to the browser


    }

     
   }
