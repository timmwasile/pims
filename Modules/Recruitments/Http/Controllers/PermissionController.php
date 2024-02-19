<?php

namespace Modules\Recruitments\Http\Controllers;

use Flash;
use Gate;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Modules\Recruitments\DataTables\PermissionDataTable;
use Modules\Recruitments\Http\Requests\CreatePermissionRequest;
use Modules\Recruitments\Http\Requests\UpdatePermissionRequest;
use Modules\Recruitments\Http\Repositories\PermissionRepository;
use Symfony\Component\HttpFoundation\Response;

class PermissionController extends AppBaseController
{
    /** @var PermissionRepository */
    private $permissionRepository;

    public function __construct(PermissionRepository $permissionRepo)
    {
        $this->permissionRepository = $permissionRepo;
    }

    /**
     * Display a listing of the permission.
     *
     * @param PermissionlDataTable $permissionDataTable
     *
     * @return Response
     */
    public function index(PermissionDataTable $permissionDataTable)
    {

        abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return $permissionDataTable->render('backend.permissions.index');
    }

    /**
     * Show the form for creating a new permission.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {

        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('backend.permissions.create');
    }

    /**
     * Store a newly created permission in storage.
     *
     * @param CreatePermissionRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(CreatePermissionRequest $request)
    {

        $input = $request->all();

        $permission = $this->permissionRepository->create($input);

        Flash::success('Permission saved successfully.');

        return redirect(route('admin.permissions.index'));
    }

    /**
     * Display the specified permission.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('admin.permissions.index'));
        }

        return view('backend.permissions.show')->with('permission', $permission);
    }

    /**
     * Show the form for editing the specified permission.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('admin.permissions.index'));
        }

        return view('backend.permissions.edit')->with('permission', $permission);
    }

    /**
     * Update the specified Permission in storage.
     *
     * @param int                $id
     * @param UpdatePermissionRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdatePermissionRequest $request)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('admin.permissions.index'));
        }

        $permission = $this->permissionRepository->update($request->all(), $id);

        Flash::success('Permission updated successfully.');

        return redirect(route('admin.permissions.index'));
    }

    /**
     * Remove the specified Permission from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        $permission = $this->permissionRepository->find($id);

        if (empty($permission)) {
            Flash::error('Permission not found');

            return redirect(route('admin.permissions.index'));
        }

        $this->permissionRepository->delete($id);

        Flash::success('Permission deleted successfully.');

        return redirect(route('admin.permissions.index'));
    }
}
