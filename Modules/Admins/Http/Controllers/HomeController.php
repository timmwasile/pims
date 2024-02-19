<?php

namespace Modules\Admins\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Modules\Recruitments\Entities\Customer;
use Modules\Recruitments\Entities\Employee;
use Modules\Recruitments\Entities\Loan;
use Modules\Recruitments\Entities\Payment;
use Modules\Recruitments\Entities\Plot;
use Modules\Recruitments\Entities\Project;
use Modules\Recruitments\Entities\Transaction;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HomeController extends AppBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
               $total_customers = Customer::where('company_id',auth()->user()->company_id)->get()->count();
        $projects = Project::where('company_id',auth()->user()->company_id)->get()->count();
         $incomplete = Plot::where('company_id',auth()->user()->company_id)->where('status_id',0)->where('balance',"!=",0)->get()->count();
         $complete = Plot::where('company_id',auth()->user()->company_id)->where('status_id',1)->where('balance',"==",0)->get()->count();
        // $total_invoice = Loan::get()->count();
        // $shortlisted_branch = Loan::get()->count();
        $payments = Payment::where('company_id',auth()->user()->company_id)->take(3)->orderBy('id', 'DESC')->get();
        return view('backend.admin', compact('projects','total_customers', 'payments','incomplete','complete'));
    }
}
