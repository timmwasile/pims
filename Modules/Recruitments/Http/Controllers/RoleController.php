<?php

namespace Modules\Recruitments\Http\Controllers;

use Flash;
use Gate;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Modules\Recruitments\DataTables\RoleDataTable;
use Modules\Recruitments\Entities\Permission;
use Modules\Recruitments\Entities\Role;
use Modules\Recruitments\Http\Requests\CreateRoleRequest;
use Modules\Recruitments\Http\Requests\UpdateRoleRequest;
use Modules\Recruitments\Http\Repositories\RoleRepository;

class RoleController extends AppBaseController
{
    /** @var roleRepository */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the role.
     *
     * @param RoleDataTable $roleDataTable
     *
     * @return Response
     */
    public function index(RoleDataTable $roleDataTable)
    {
        abort_if(Gate::denies('role_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        return $roleDataTable->render('backend.roles.index');
    }

    /**
     * Show the form for creating a new role.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        abort_if(Gate::denies('role_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $permissions = Permission::all()->pluck('title', 'id');

        return view('backend.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();

        $role = $this->roleRepository->create($input);
        $role->permissions()->sync($request->input('permissions', []));


        Flash::success('Role saved successfully.');

        return redirect(route('admin.roles.index', compact('role')));
    }

    /**
     * Display the specified role.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        abort_if(Gate::denies('role_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('admin.roles.index'));
        }

        return view('backend.roles.show')->with('role', $role);
    }

    /**
     * Show the form for editing the specified role.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function edit($id, Role $roles)
    {
        abort_if(Gate::denies('role_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $permissions = Permission::all()->pluck('title', 'id');

        $roles->load('permissions');

        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('admin.roles.index'));
        }

        return view('backend.roles.edit', compact('permissions', 'roles', 'role'))->with('role', $role);
    }

    /**
     * Update the specified role in storage.
     *
     * @param int                $id
     * @param UpdateroleRequest $request
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('admin.roles.index'));
        }

        $role = $this->roleRepository->update($request->all(), $id);
        $role->permissions()->sync($request->input('permissions', []));


        Flash::success('Role updated successfully.');

        return redirect(route('admin.roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        abort_if(Gate::denies('role_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('admin.roles.index'));
        }

        $this->roleRepository->delete($id);

        Flash::success('Role deleted successfully.');

        return redirect(route('admin.roles.index'));
    }
}
