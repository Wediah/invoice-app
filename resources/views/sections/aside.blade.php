<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="javascript:void" class="app-brand-link">
            <img src="{{ asset('assets/img/pages/logo.png') }}" alt="logo logo" width="20%">

            <span class="app-brand-text demo menu-text fw-bold ms-2" style="font-size: 24px">Apollo</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
            <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Company -->
        <li class="menu-item">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="My Companies">My Companies</div>
            </a>
        </li>




        <!-- Apps & Pages -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Invoices &amp; Stock</span></li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div data-i18n="Invoice">Invoice</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-invoice-list.html" class="menu-link">
                        <div data-i18n="List">List</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-invoice-preview.html" class="menu-link">
                        <div data-i18n="Create New">Create New</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-invoice-edit.html" class="menu-link">
                        <div data-i18n="Edit">Pending</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-invoice-add.html" class="menu-link">
                        <div data-i18n="Add">Paid</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-carousel"></i>
                <div data-i18n="Stock">Stocks</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="form-wizard-numbered.html" class="menu-link">
                        <div data-i18n="Active">In-Stock</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="form-wizard-icons.html" class="menu-link">
                        <div data-i18n="Icons">Out Of Stock</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Payments & Taxes -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Payments &amp; Taxes</span></li>

        <li class="menu-item">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Payment Terms">Payment Terms</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div data-i18n="Taxes">Taxes</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-invoice-list.html" class="menu-link">
                        <div data-i18n="List">List</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-invoice-preview.html" class="menu-link">
                        <div data-i18n="Create New">Create New</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-invoice-edit.html" class="menu-link">
                        <div data-i18n="Edit">Primary</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-invoice-add.html" class="menu-link">
                        <div data-i18n="Add">Secondary</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Users & Permissions -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Users &amp; Permissions</span></li>


        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-access-roles.html" class="menu-link">
                        <div data-i18n="User Management">User Management</div>
                    </a>
                </li>
             
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-check-shield"></i>
                <div data-i18n="Roles & Permissions">Roles & Permissions</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-access-roles.html" class="menu-link">
                        <div data-i18n="Roles">Roles</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-access-permission.html" class="menu-link">
                        <div data-i18n="Permission">Permission</div>
                    </a>
                </li>
            </ul>
        </li>


       <!-- Configs & Settings -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Configs &amp; Settings</span></li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-check-shield"></i>
                <div data-i18n="Settings">Settings</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-access-roles.html" class="menu-link">
                        <div data-i18n="User Management">User Settings</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-access-permission.html" class="menu-link">
                        <div data-i18n="Roles">Roles Settings</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-access-permission.html" class="menu-link">
                        <div data-i18n="Permission">Permission Settings</div>
                    </a>
                </li>
            </ul>
        </li>


     

      






    </ul>
</aside>
