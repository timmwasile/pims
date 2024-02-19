<?php

namespace Modules\Admins\Http\Controllers;

use Auth;
use Flash;
use Gate;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Hash;
use Modules\Admins\DataTables\CompanyDataTable;
use Modules\Admins\Entities\Permission;
use Modules\Admins\Entities\Admin;
use Modules\Admins\Entities\Company;
use Modules\Admins\Entities\Gender;
use Modules\Admins\Http\Repositories\CompanyRepository;
use Modules\Admins\Http\Requests\CreateAdminRequest;
use Modules\Admins\Http\Requests\CreateCompanyRequest;
use Modules\Admins\Http\Requests\UpdateAdminRequest;
use Modules\Admins\Http\Requests\UpdateCompanyRequest;
use Modules\Recruitments\Entities\Role;
use Modules\Recruitments\Http\Controllers\Traits\MediaUploadingTrait;
use Modules\Recruitments\Http\Requests\CreateUpdateProfileRequest;
use Password;
use Request;
use Session;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Validator;

class CompanyController extends AppBaseController
{
use MediaUploadingTrait;

    /** @var companyRepository */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepository = $companyRepo;
    }

    /**
     * Display a listing of the admin.
     *
     * @param CompanyDataTable $CompanyDataTable
     *
     * @return Response
     */
    public function index(CompanyDataTable $CompanyDataTable)
    {
        // dd(auth()->user()->id);
        return $CompanyDataTable->render('backend.companies.index');
    }

    /**
     * Show the form for creating a new admin.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
              return view('backend.companies.create');
    }

    /**
     * Store a newly created company in storage.
     *
     * @param CreateCompanyRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(CreateCompanyRequest $request)
    {
        $input = $request->all();

        $company = $this->companyRepository->create($input);
        if($request->hasFile('logo') && $request->file('logo')->isValid()){
            $company->addMediaFromRequest('logo')->toMediaCollection('logo');
        }
          if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $company->id]);
        }

        // Send password reset link after account creation
        // $this->sendResetLinkEmail($company->email);


        Flash::success('company saved successfully.');

        return redirect(route('admin.companies.index'));
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
        $company = $this->companyRepository->find($id);

        if (empty($company)) {
            Flash::error('company not found');

            return redirect(route('admin.companies.index'));
        }

        return view('backend.companies.show')->with('company', $company);
    }

    /**
     * Show the form for editing the specified company.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        $company = $this->companyRepository->find($id);

        if (empty($company)) {
            Flash::error('company not found');

            return redirect(route('admin.companies.index'));
        }

        return view('backend.companies.edit')->with('company', $company);
    }

    /**
     * Update the specified company in storage.
     *
     * @param int                $id
     * @param UpdateCompanyRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateCompanyRequest $request)
    {
        $company = $this->companyRepository->find($id); 
        if (empty($company)) {
            Flash::error('company not found');
            return redirect(route('admin.companies.index'));
        }

        $company = $this->companyRepository->update($request->all(), $id);
         
        Flash::success('company updated successfully.');

        return redirect(route('admin.companies.index'));
    }


    /**
     * Remove the specified company from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        $company = $this->companyRepository->find($id);

        if (empty($company)) {
            Flash::error('company not found');

            return redirect(route('admin.companies.index'));
        }

        $this->companyRepository->delete($id);

        Flash::success('Company deleted successfully.');

        return redirect(route('admin.companies.index'));
    }

   public function storeCKEditorImages(Request $request)
    {
        // abort_if(Gate::denies('plot_create') && Gate::denies('plot_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Company();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('logo')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }


}
