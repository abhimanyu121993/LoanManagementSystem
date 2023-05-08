<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{route('admin.dashboard')}}" class=" waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>


            @hasrole('admin')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user-circle"></i>
                        <span key="t-role-&-permissions">Role & Permissions</span>
                    </a>

                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.role')}}" key="t-permission">Role</a></li>
                        <li><a href="{{route('admin.permission')}}" key="t-permission">Permission</a></li>
                        <li><a href="{{route('admin.hasPermission')}}" key="t-has-permissions">Has Permissions</a></li>
                    </ul>
                </li>
                @endcan
                @can('manager')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user-plus"></i>
                        <span key="t-users">Manager</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                       @can('manager_create')
                        <li><a href="{{route('admin.userRegister')}}" key="t-register">Create</a></li>
                        @endcan
                        @can('manager_read')
                        <li><a href="{{route('admin.userManagersShow')}}" key="t-register">Manage</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('staff')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user-plus"></i>
                        <span key="t-staff">Staff</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('staff_create')<li><a href="{{route('admin.staff.index')}}" key="t-create">Create</a></li>@endcan
                        @can('staff_read')<li><a href="{{route('admin.staff.create')}}" key="t-manage">Manage</a></li>@endcan
                    </ul>
                </li>
                @endcan
                @can('customer')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user-plus"></i>
                        <span key="t-customer">Customer</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('customer_create')<li><a href="{{route('admin.customer.create')}}" key="t-manage">Create</a></li>@endcan
                        @can('customer_read')<li><a href="{{route('admin.customer.index')}}" key="t-create">Manage</a></li>@endcan
                    </ul>
                </li>
                @endcan
                @hasrole('admin')
                <li>
                    <a href="{{route('admin.loan-type.index')}}" class="waves-effect">
                        <i class="bx bx-chat"></i>
                        <span key="t-chat">Loan Type</span>
                    </a>
                </li>
                @endhasrole
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
