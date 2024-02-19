<?php

namespace Modules\Admins\Http\Controllers;

use Flash;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use Modules\Admins\DataTables\AuditLogDataTable;
use Modules\Admins\Http\Repositories\AuditLogRepository;
use Password;

class AuditLogController extends AppBaseController
{
    /** @var AuditLogRepository */
    private $auditlogRepository;

    public function __construct(AuditLogRepository $auditlogRepo)
    {
        $this->auditlogRepository = $auditlogRepo;
    }

    /**
     * Display a listing of the admin.
     *
     * @param auditlogDataTable $auditlogDataTable
     *
     * @return Response
     */
    public function index(AuditLogDataTable $auditlogDataTable)
    {
        return $auditlogDataTable->render('backend.auditlogs.index');
    }



    /**
     * Display the specified auditlog.
     *
     * @param int $id
     *
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function show($id)
    {
        $auditlog = $this->auditlogRepository->find($id);

        if (empty($auditlog)) {
            Flash::error('Audit-Log not found');

            return redirect(route('admin.auditlogs.index'));
        }

        return view('backend.auditlogs.show')->with('auditlog', $auditlog);
    }
}
