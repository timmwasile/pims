<?php

namespace Modules\Admins\Http\Controllers;

use Auth;
use Flash;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Hash;
use Modules\Admins\DataTables\AdminDataTable;
use Modules\Admins\Entities\Permission;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Entities\Company;
use Modules\Admins\Entities\Gender;
use Modules\Admins\Http\Requests\CreateAdminRequest;
use Modules\Admins\Http\Repositories\AdminRepository;
use Modules\Admins\Http\Requests\UpdateAdminRequest;
use Modules\Recruitments\Entities\Role;
use Modules\Recruitments\Http\Requests\CreateUpdateProfileRequest;
use Illuminate\Support\Facades\Password;

// use Password;
use Session;
use Validator;

class AdminController extends AppBaseController
{
    /** @var adminRepository */
    private $adminRepository;

    public function __construct(AdminRepository $adminRepo)
    {
        $this->adminRepository = $adminRepo;
    }

    /**
     * Display a listing of the admin.
     *
     * @param adminDataTable $adminDataTable
     *
     * @return Response
     */
    public function index(AdminDataTable $adminDataTable)
    {

        return $adminDataTable->render('backend.admins.index');
    }

    /**
     * Show the form for creating a new admin.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $roles = Role::where('id','!=',1)->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');
        $genders = Gender::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        if(auth()->user()->id ==1){
        $roles = Role::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');
        $companies = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }else{
        $companies = Company::where('id',auth()->user()->company_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        }


        return view('backend.admins.create', compact('roles', 'genders','companies'));
    }

    /**
     * Store a newly created admin in storage.
     *
     * @param CreateadminRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(CreateAdminRequest $request)
    {
        $input = $request->all();

        $admin = $this->adminRepository->create($input);
        $admin->roles()->sync($request->input('roles', []));

        // Send password reset link after account creation
        $this->sendResetLinkEmail($admin->email);


        Flash::success('admin saved successfully.');

        return redirect(route('admin.admins.index'));
    }

    /**
     * Display the specified admin.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error('admin not found');

            return redirect(route('admin.admins.index'));
        }

        return view('backend.admins.show')->with('admin', $admin, 'roles');
    }

    /**
     * Show the form for editing the specified admin.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id, Admin $admins)
    {
        $roles = Role::where('id',"!=",1)->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

       $genders = Gender::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        if(auth()->user()->id ==1){
        $roles = Role::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');
        $companies = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        }
        $companies = Company::where('id',auth()->user()->company_id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $admins->load('roles');

        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error('admin not found');

            return redirect(route('admin.admins.index'));
        }

        return view('backend.admins.edit', compact('admins', 'roles', 'genders','companies'))->with('admin', $admin);
    }

    /**
     * Update the specified admin in storage.
     *
     * @param int                $id
     * @param UpdateAdminRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateAdminRequest $request)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error('admin not found');

            return redirect(route('admin.admins.index'));
        }

        $admin = $this->adminRepository->update($request->all(), $id);
        $admin->roles()->sync($request->input('roles', []));


        Flash::success('Admin updated successfully.');

        return redirect(route('admin.admins.index'));
    }

    /**
     * Remove the specified admin from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error('admin not found');

            return redirect(route('admin.admins.index'));
        }

        $this->adminRepository->delete($id);

        Flash::success('admin deleted successfully.');

        return redirect(route('admin.admins.index'));
    }



    /**
 * Send the reset password email to the user.
 *
 * @param  string  $email
 * @return void
 */
public function sendResetLinkEmail($email)
{
    Password::broker()->sendResetLink(['email' => $email]);
}

    /**
     * Trigger password reset based on admins email.
     *
     * @param \App\Models\Admin $admin Admin
     *
     * @return \Illuminate\Http\Response
     */
    public function passwordReset(Admin $admin)
    {


        $this->sendResetLinkEmail($admin->email);

        return back()->with('success', 'Password reset sent successfully!');
    }


    /**
     * Show the form for creating a new admin.
     *
     * @return Application|Factory|View|Response
     */
    public function profile()
    {
        $roles = Role::all()->pluck('title', 'id');
        $genders = Gender::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('backend.admins.profile.index', compact('roles', 'genders'));

    }
     public function update_profile(CreateUpdateProfileRequest $request)
    {
        // Hash::make(
             if($request->new_password!=$request->confirm_password  )
             {
                 $rules =   [
                            'new_password' => 'required|string|min:8|max:48',
                            'confirm_password' => 'required|string|min:8|max:48'
                            ];
                $validator = Validator::make($request->all(), $rules);
                $messages = $validator->errors();
                $roles = Role::all()->pluck('title', 'id');
                $genders = Gender::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('backend.admins.profile.index', compact('roles', 'genders'))->with("kuna shida");
            }
            else
            {
             Admin::where('id',auth()->user()->id)->update(['password'=>Hash::make($request->new_password)]);
             Auth::logout();
            return redirect()->route('login');
            }


    }
}
