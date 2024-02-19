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
use Modules\Admins\DataTables\LicenseDataTable;
use Modules\Admins\Entities\Company;
use Modules\Admins\Entities\Gender;
use Modules\Admins\Http\Repositories\LicenseRepository;
use Modules\Admins\Http\Requests\CreateAdminRequest;
use Modules\Admins\Http\Requests\CreateLicenseRequest;
use Modules\Admins\Http\Requests\UpdateAdminRequest;
use Modules\Admins\Http\Requests\UpdateLicenseRequest;
use Modules\Recruitments\Entities\Role;
use Modules\Recruitments\Http\Requests\CreateUpdateProfileRequest;
use Password;
use Session;
use Validator;

class LicenseController extends AppBaseController
{
    /** @var licenseRepository */
    private $licenseRepository;

    public function __construct(LicenseRepository $licenseRepo)
    {
        $this->licenseRepository = $licenseRepo;
    }

    /**
     * Display a listing of the admin.
     *
     * @param licenseDataTable $licenseDataTable
     *
     * @return Response
     */
    public function index(LicenseDataTable $licenseDataTable)
    {
        return $licenseDataTable->render('backend.licenses.index');
    }

    /**
     * Show the form for creating a new admin.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $company = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

              return view('backend.licenses.create',compact('company'));
    }

    /**
     * Store a newly created license in storage.
     *
     * @param CreateLicenseRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(CreateLicenseRequest $request)
    {
        $input = $request->all();

        $license = $this->licenseRepository->create($input);

        Flash::success('license saved successfully.');

        return redirect(route('admin.licenses.index'));
    }

    /**
     * Display the specified company.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        $license = $this->licenseRepository->find($id);

        if (empty($license)) {
            Flash::error('license not found');

            return redirect(route('admin.licenses.index'));
        }

        return view('backend.licenses.show')->with('license', $license);
    }

    /**
     * Show the form for editing the specified license.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        $license = $this->licenseRepository->find($id);

        if (empty($license)) {
            Flash::error('license not found');

            return redirect(route('admin.licenses.index'));
        }
        $company = Company::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');


        return view('backend.licenses.edit',compact('company'))->with('license', $license);
    }

    /**
     * Update the specified license in storage.
     *
     * @param int                $id
     * @param UpdateLicenseRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateLicenseRequest $request)
    {
        $license = $this->licenseRepository->find($id);

        if (empty($license)) {
            Flash::error('license not found');

            return redirect(route('admin.licenses.index'));
        }

        $license = $this->licenseRepository->update($request->all(), $id);


        Flash::success('license updated successfully.');

        return redirect(route('admin.licenses.index'));
    }

    /**
     * Remove the specified license from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        $license = $this->licenseRepository->find($id);

        if (empty($license)) {
            Flash::error('license not found');

            return redirect(route('admin.licenses.index'));
        }

        $this->licenseRepository->delete($id);

        Flash::success('license deleted successfully.');

        return redirect(route('admin.licenses.index'));
    }

   
}
