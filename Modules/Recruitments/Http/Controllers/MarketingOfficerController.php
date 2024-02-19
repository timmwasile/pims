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
use Modules\Recruitments\DataTables\MarketingOfficerDataTable;
use Modules\Recruitments\Entities\Customer;
use Modules\Recruitments\Entities\Loan_Transaction;
use Modules\Recruitments\Entities\MarketingOfficer;
use Modules\Recruitments\Entities\Project;
use Modules\Recruitments\Http\Repositories\MarketingOfficerRepository;
use Modules\Recruitments\Http\Requests\CreateCustomerRequest;
use Modules\Recruitments\Http\Requests\CreateMarketingOfficerRequest;
use Modules\Recruitments\Http\Requests\UpdateCustomerRequest;
use Modules\Recruitments\Http\Requests\UpdateMarketingOfficerRequest;
use PDF;
use Request;
use Storage;
use URL;

use function app\bootstrap\randGenerator;

class MarketingOfficerController extends AppBaseController
{
    /** @var MarketingOfficerRepository */
    private $MarketingOfficerRepository;

    public function __construct(MarketingOfficerRepository $MarketingOfficerRepo)
    {
        $this->MarketingOfficerRepository = $MarketingOfficerRepo;
    }

    /**
     * Display a listing of the MarketingOfficer.
     *
     * @param MarketingOfficerDataTable $MarketingOfficerDataTable
     *
     * @return Response
     */
    public function index(MarketingOfficerDataTable $MarketingOfficerDataTable)
    {
        abort_if(Gate::denies('marketing_officer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $MarketingOfficerDataTable->render('backend.marketing_officers.index');
    }

    /**
     * Show the form for creating a new MarketingOfficer.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        abort_if(Gate::denies('marketing_officer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.marketing_officers.create');
    }

    /**
     * Store a newly created MarketingOfficer in storage.
     *
     * @param CreateMarketingOfficerRequest $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function store(CreateMarketingOfficerRequest $request)
    {
        
       $input = $request->all();
        $marketing_officer = $this->MarketingOfficerRepository->create($input);
        Flash::success('marketing_officer saved successfully.');

        return redirect(route('admin.marketing_officers.index'));
    }

    /**
     * Display the specified MarketingOfficer.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('marketing_officer_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $marketing_officer = $this->MarketingOfficerRepository->find($id);
        if (empty($marketing_officer)) {
            Flash::error('marketing_officer not found');
            return redirect(route('admin.marketing_officers.index'));
        }
        return view('backend.marketing_officers.show',compact('marketing_officer'));
    }

    /**
     * Show the form for editing the specified MarketingOfficer.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        abort_if(Gate::denies('marketing_officer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marketing_officer = $this->MarketingOfficerRepository->find($id);

        if (empty($marketing_officer)) {
            Flash::error('marketing_officer not found');

            return redirect(route('admin.marketing_officers.index'));
        }
        return view('backend.marketing_officers.edit')->with('marketing_officer', $marketing_officer);
    }

    /**
     * Update the specified MarketingOfficer in storage.
     *
     * @param int                   $id
     * @param UpdateMarketingOfficerRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateMarketingOfficerRequest $request)
    {
        $marketing_officer = $this->MarketingOfficerRepository->find($id);

        if (empty($marketing_officer)) {
            Flash::error('marketing_officer not found');

            return redirect(route('admin.marketing_officers.index'));
        }
        $marketing_officer = $this->MarketingOfficerRepository->update($request->all(), $id);

        Flash::success('marketing_officer updated successfully.');

        return redirect(route('admin.marketing_officers.index'));
    }

    /**
     * Remove the specified marketing_officer from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('marketing_officer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $marketing_officer = $this->MarketingOfficerRepository->find($id);

        if (empty($marketing_officer)) {
            Flash::error('marketing_officer not found');

            return redirect(route('admin.marketing_officers.index'));
        }

        $this->MarketingOfficerRepository->delete($id);

        Flash::success('marketing_officer deleted successfully.');

        return redirect(route('admin.marketing_officers.index'));
    }

    /**
     * Create a printable and downloadable marketing_officer Summary.
     *
     * @param  \App\Models\MarketingOfficer $marketingOfficer
     * @return \Barryvdh\DomPDF\PDF
     */
    public function print(MarketingOfficer $marketingOfficer) {
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
