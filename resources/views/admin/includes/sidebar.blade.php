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

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user-plus"></i>
                        <span key="t-users">Manager</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.userRegister')}}" key="t-register">Create</a></li>
                        <li><a href="{{route('admin.userManagersShow')}}" key="t-register">Manage</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user-plus"></i>
                        <span key="t-staff">Staff</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
<<<<<<< Updated upstream
                        <li><a href="#" key="t-create">Create</a></li>
                        <li><a href="#" key="t-manage">Manage</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user-plus"></i>
                        <span key="t-customer">Customer</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('admin.customer.create')}}" key="t-manage">Create</a></li>
                        <li><a href="{{route('admin.customer.index')}}" key="t-create">Manage</a></li>
=======
                        <li><a href="{{route('admin.staff.index')}}" key="t-register">Create</a></li>
                        <li><a href="{{route('admin.staff.create')}}" key="t-register">Manage</a></li>
>>>>>>> Stashed changes
                    </ul>
                </li>
                <li>
                    <a href="{{route('admin.loan-type.index')}}" class="waves-effect">
                        <i class="bx bx-chat"></i>
                        <span key="t-chat">Loan Type</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
