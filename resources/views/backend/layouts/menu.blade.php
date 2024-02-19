<li class="side-menus pt-3 {{ Request::is('admin') ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('admin.home') }}">
        <i class=" fas fa-building"></i>
        <span>Dashboard</span>
    </a>
</li>
<li class="menu-header">Modules </li>


@can('project_management_access')
    <li
        class="dropdown {{Request::is('admin/projects*') || Request::is('admin/payments*') || Request::is('admin/customers*') ? 'active': '' }}">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-project-diagram"></i> <span>Project Management</span>
        </a>
        <ul class="dropdown-menu">
            @can('project_access')
            <li class="{{ Request::is('admin/projects*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.projects.index') }}">
                        <i class="fab fa-stack-exchange"></i> Project List
                    </a>
                </li>
                @endcan

                 @can('customer_access')
            <li class="{{ Request::is('admin/customers*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.customers.index') }}">
                        <i class="fas fa-user-friends"></i> customer List
                    </a>
                </li>
                @endcan
                 @can('payment_access')
                <li class="{{ Request::is('admin/payments*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.payments.index') }}">
                        <i class="fab fa-html5"></i> Pay Types 
                    </a>
                </li>
            @endcan     
            
        </ul>
    </li>
@endcan



@can('plot_management_access')
    <li
        class="dropdown {{ Request::is('admin/plots*')|| Request::is('admin/marketing_officers*')|| Request::is('admin/transactions*')? 'active': '' }}">
        <a href="#" class="nav-link has-dropdown">
            <i class="far fa-object-ungroup"></i> <span>Plot Management</span>
        </a>
        <ul class="dropdown-menu">
            @can('plot_access')
                <li class="{{ Request::is('admin/plots*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.plots.index') }}">
                        <i class="fab fa-audible"></i> Plot List
                    </a>
                </li>
            @endcan     
             @can('transaction_access')
                <li class="{{ Request::is('admin/transactions*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.transactions.index') }}">
                        <i class="fab fa-slack"></i> Transaction List
                    </a>
                </li>
            @endcan 
              @can('marketing_officer_access')
                <li class="{{ Request::is('admin/marketing_officers*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.marketing_officers.index') }}">
                        <i class="fas fa-user-tie"></i> M'Officers List
                    </a>
                </li>
            @endcan          
        </ul>
        <ul class="dropdown-menu">
                    
        </ul>
    </li>
@endcan
@can('report_management_access')
    <li
        class="dropdown {{ Request::is('admin/transaction/report*')? 'active': '' }}">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-print"></i> <span>Report management</span>
        </a>
        <ul class="dropdown-menu">
            @can('transaction_access')
                <li class="{{ Request::is('admin/transaction/report*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.transactions.reports.index') }}">
                        <i class="fas fa-prescription-bottle"></i> Transaction Rep 
                    </a>
                </li>
            @endcan 
{{--             
             @can('report_project_access')
                <li class="{{ Request::is('admin/projects*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.projects.index') }}">
                        <i class="fas fa-radiation"></i> Project Report
                    </a>
                </li>
            @endcan  
            @can('report_plot_access')
                <li class="{{ Request::is('admin/plots*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.plots.index') }}">
                        <i class="fas fa-route"></i> Plot Report
                    </a>
                </li>
            @endcan     
             
              @can('report_marketing_officer_access')
                <li class="{{ Request::is('admin/marketing_officers*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.marketing_officers.index') }}">
                        <i class="fas fa-user-clock"></i> M'Officers Report
                    </a>
                </li>
            @endcan           --}}
        </ul>
        <ul class="dropdown-menu">
                    
        </ul>
    </li>
@endcan




@can('access_system_setting_menu')
    <li
        class="dropdown {{ Request::is('admin/permissions*') ||Request::is('admin/licenses*') ||Request::is('admin/companies*') || Request::is('admin/roles*')|| Request::is('admin/profile') || Request::is('admin/admins*') ||  Request::is('admin/users*') || Request::is('admin/auditlogs*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown">
            <i class="fas fa-cogs"></i> <span>Settings</span>
        </a>
        <ul class="dropdown-menu">
             @can('profile_access')
                <li class="{{ Request::is('admin/profile') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.admins.profile') }}">
                        <i class="fas fa-user-secret"></i> Profile
                    </a>
                </li>
            @endcan
             @can('company_access')
                <li class="{{ Request::is('admin/companies*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.companies.index') }}">
                        <i class="fas fa-coins"></i> Office Details
                    </a>
                </li>
            @endcan
             @can('license_access')
                <li class="{{ Request::is('admin/licenses*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.licenses.index') }}">
                        <i class="fas fa-coins"></i> License Bus
                    </a>
                </li>
            @endcan
            @can('administrators_database_access')
                <li class="{{ Request::is('admin/admins*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.admins.index') }}">
                        <i class="fas fa-user-edit"></i> Register User
                    </a>
                </li>
            @endcan
            
            @can('permission_access')
                <li class="{{ Request::is('admin/permissions*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.permissions.index') }}">
                        <i class="far fa-hand-lizard"></i> Permission
                    </a>
                </li>
            @endcan
            @can('role_access')
                <li class="{{ Request::is('admin/roles*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.roles.index') }}">
                        <i class="far fa-handshake"></i> Roles
                    </a>
                </li>
            @endcan
            @can('auditlogs_access')
                <li class="{{ Request::is('admin/auditlogs*') ? 'active' : '' }}">
                    <a class="nav-link " href="{{ route('admin.auditlogs.index') }}">
                        <i class="fas fa-theater-masks"></i> AuditLogs
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan


   {{-- <ul class="dropdown-menu"> --}}
                    <a href="{{ url('/logout') }}" class="dropdown-item has-icon text-danger"
                    onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> SignOut
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                    {{ csrf_field() }}
                </form>
   {{-- </ul> --}}