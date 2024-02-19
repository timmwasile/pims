<?php

namespace Modules\Admins\Http\Controllers;

use Flash;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Modules\Admins\DataTables\UserDataTable;
use Modules\Admins\Entities\Permission;
use Modules\Admins\Entities\User;
use Modules\Admins\Entities\Gender;
use Modules\Admins\Http\Repositories\UserRepository;
use Modules\Recruitments\Entities\Role;
use Modules\Users\Entities\Profile;
use Password;

class UserController extends AppBaseController
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the admin.
     *
     * @param userDataTable $adminDataTable
     *
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('backend.users.index');
    }

    /**
     * Show the form for creating a new admin.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('title', 'id');
        $genders = Gender::get();

        return view('backend.admins.create', compact('roles', 'genders'));
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
        // $this->sendResetLinkEmail($admin->email);


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
        $info = Profile::where('user_id', $id)->first();
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('admin not found');

            return redirect(route('admin.users.index'));
        }

        return view('backend.users.show', compact('info'))->with('user', $user, 'roles');
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
        $roles = Role::all()->pluck('title', 'id');
        $genders = Gender::get();

        $admins->load('roles');

        $admin = $this->adminRepository->find($id);

        if (empty($admin)) {
            Flash::error('admin not found');

            return redirect(route('admin.admins.index'));
        }

        return view('backend.admins.edit', compact('admins', 'roles', 'genders'))->with('admin', $admin);
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
     * @param  User                              $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail($email)
    {
        Password::broker()->sendResetLink(['email' => $email]);
    }
}
