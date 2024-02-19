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
use Illuminate\Support\Facades\View as viewhtml;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Recruitments\DataTables\CustomerDataTable;
use Modules\Recruitments\Entities\Customer;
use Modules\Recruitments\Entities\Loan_Transaction;
use Modules\Recruitments\Entities\Plot;
use Modules\Recruitments\Http\Repositories\CustomerRepository;
use Modules\Recruitments\Http\Requests\CreateCustomerRequest;
use Modules\Recruitments\Http\Requests\UpdateCustomerRequest;
use PDF;
use Request;
use Storage;
use URL;

use function app\bootstrap\randGenerator;

class CustomerController extends AppBaseController
{
    /** @var CustomerRepository */
    private $CustomerRepository;

    public function __construct(CustomerRepository $CustomerRepo)
    {
        $this->CustomerRepository = $CustomerRepo;
    }

    /**
     * Display a listing of the Customer.
     *
     * @param CustomerDataTable $CustomerDataTable
     *
     * @return Response
     */
    public function index(CustomerDataTable $CustomerDataTable)
    {
        abort_if(Gate::denies('customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $CustomerDataTable->render('backend.customers.index');
    }

    /**
     * Show the form for creating a new Customer.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.customers.create');
    }

    /**
     * Store a newly created customer in storage.
     *
     * @param CreateCustomerRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateCustomerRequest $request)
    {
        
       $input = $request->all();
        $customer = $this->CustomerRepository->create($input);
        Flash::success('Customer saved successfully.');

        return redirect(route('admin.customers.index'));
    }

    /**
     * Display the specified customer.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('customer_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $customer = $this->CustomerRepository->find($id);

                        
        $plots = Plot::
                        select('projects.name as project_name','plots.number as number','plots.to_be_paid_amount as amount' ,'plots.balance as balance','marketing_officers.name as marketing_officer','plots.status_id as status_id','payments.name as payment_mode','plots.mpa as monthly')
                        ->join('projects', 'projects.id', '=', 'plots.project_id')
                        ->join('payments', 'payments.id', '=', 'plots.payment_id')
                        ->join('marketing_officers', 'marketing_officers.id', '=', 'plots.marketing_officer_id')
                        ->where('plots.customer_id', $id)->get();

        if (empty($customer)) {
            Flash::error('customer not found');
            return redirect(route('admin.customers.index'));
        }
        return view('backend.customers.show',compact('customer','plots'));
    }

    /**
     * Show the form for editing the specified customer.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer = $this->CustomerRepository->find($id);

        if (empty($customer)) {
            Flash::error('customer not found');

            return redirect(route('admin.customers.index'));
        }
        return view('backend.customers.edit')->with('customer', $customer);
    }

    /**
     * Update the specified customer in storage.
     *
     * @param int                   $id
     * @param UpdateCustomerRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateCustomerRequest $request)
    {
        $customer = $this->CustomerRepository->find($id);

        if (empty($customer)) {
            Flash::error('customer not found');

            return redirect(route('admin.customers.index'));
        }
        $customer = $this->CustomerRepository->update($request->all(), $id);

        Flash::success('Customer updated successfully.');

        return redirect(route('admin.customers.index'));
    }

    /**
     * Remove the specified customer from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('customer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customer = $this->CustomerRepository->find($id);

        if (empty($customer)) {
            Flash::error('customer not found');

            return redirect(route('admin.customers.index'));
        }

        $this->CustomerRepository->delete($id);

        Flash::success('Customer deleted successfully.');

        return redirect(route('admin.customers.index'));
    }

    /**
     * Create a printable and downloadable Customer Summary.
     *
     * @param  \App\Models\Customer $customer
     * @return \Barryvdh\DomPDF\PDF
     */
    public function print(Customer $customer) {
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
     
   }
