<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-no-customizer">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Invoice | @yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/logo.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href=".{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }} ">


    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-invoice.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}">

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--alpine-js -->
    @stack('alpine-plugins')
    {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('sections.aside')
            <!-- / Menu -->
            <div class="layout-page">
                <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme no-print"
                    id="layout-navbar">
                    <div class="container-fluid">
                        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                            <a class="px-0 nav-item nav-link me-xl-4" href="javascript:void(0)">
                                <i class="bx bx-menu bx-sm"></i>
                            </a>
                        </div>

                        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                            <!-- Search -->
                            <div class="navbar-nav align-items-center">
                                <div class="mb-0 nav-item navbar-search-wrapper">
                                    <a class="px-0 nav-item nav-link search-toggler" href="javascript:void(0);">
                                        <i class="bx bx-search-alt bx-sm"></i>
                                        <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
                                    </a>
                                </div>
                            </div>
                            <!-- /Search -->

                            <ul class="flex-row navbar-nav align-items-center ms-auto">






                                <!-- Notification -->
                                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                        data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                        <i class="bx bx-bell bx-sm"></i>
                                        <span class="badge bg-danger rounded-pill badge-notifications">5</span>
                                    </a>
                                    <ul class="py-0 dropdown-menu dropdown-menu-end">
                                        <li class="dropdown-menu-header border-bottom">
                                            <div class="py-3 dropdown-header d-flex align-items-center">
                                                <h5 class="mb-0 text-body me-auto">Notification</h5>
                                                <a href="javascript:void(0)"
                                                    class="dropdown-notifications-all text-body"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Mark all as read"><i
                                                        class="bx fs-4 bx-envelope-open"></i></a>
                                            </div>
                                        </li>
                                        <li class="dropdown-notifications-list scrollable-container">
                                            <ul class="list-group list-group-flush">
                                                <li
                                                    class="list-group-item list-group-item-action dropdown-notifications-item">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar">
                                                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                                                    class="h-auto w-px-40 rounded-circle" />
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">Congratulation Lettie 🎉</h6>
                                                            <p class="mb-0">Won the monthly best seller gold badge</p>
                                                            <small class="text-muted">1h ago</small>
                                                        </div>
                                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-read"><span
                                                                    class="badge badge-dot"></span></a>
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-archive"><span
                                                                    class="bx bx-x"></span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item list-group-item-action dropdown-notifications-item">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar">
                                                                <span
                                                                    class="avatar-initial rounded-circle bg-label-danger">CF</span>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">Charles Franklin</h6>
                                                            <p class="mb-0">Accepted your connection</p>
                                                            <small class="text-muted">12hr ago</small>
                                                        </div>
                                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-read"><span
                                                                    class="badge badge-dot"></span></a>
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-archive"><span
                                                                    class="bx bx-x"></span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar">
                                                                <img src="{{ asset('assets/img/avatars/2.png') }}" alt
                                                                    class="h-auto w-px-40 rounded-circle" />
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">New Message ✉️</h6>
                                                            <p class="mb-0">You have new message from Natalie</p>
                                                            <small class="text-muted">1h ago</small>
                                                        </div>
                                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-read"><span
                                                                    class="badge badge-dot"></span></a>
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-archive"><span
                                                                    class="bx bx-x"></span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item list-group-item-action dropdown-notifications-item">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar">
                                                                <span
                                                                    class="avatar-initial rounded-circle bg-label-success"><i
                                                                        class="bx bx-cart"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">Whoo! You have new order 🛒</h6>
                                                            <p class="mb-0">ACME Inc. made new order $1,154</p>
                                                            <small class="text-muted">1 day ago</small>
                                                        </div>
                                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-read"><span
                                                                    class="badge badge-dot"></span></a>
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-archive"><span
                                                                    class="bx bx-x"></span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar">
                                                                <img src="{{ asset('assets/img/avatars/9.png') }}" alt
                                                                    class="h-auto w-px-40 rounded-circle" />
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">Application has been approved 🚀</h6>
                                                            <p class="mb-0">Your ABC project application has been
                                                                approved.
                                                            </p>
                                                            <small class="text-muted">2 days ago</small>
                                                        </div>
                                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-read"><span
                                                                    class="badge badge-dot"></span></a>
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-archive"><span
                                                                    class="bx bx-x"></span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar">
                                                                <span
                                                                    class="avatar-initial rounded-circle bg-label-success"><i
                                                                        class="bx bx-pie-chart-alt"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">Monthly report is generated</h6>
                                                            <p class="mb-0">July monthly financial report is
                                                                generated
                                                            </p>
                                                            <small class="text-muted">3 days ago</small>
                                                        </div>
                                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-read"><span
                                                                    class="badge badge-dot"></span></a>
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-archive"><span
                                                                    class="bx bx-x"></span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar">
                                                                <img src="{{ asset('assets/img/avatars/5.png') }}" alt
                                                                    class="h-auto w-px-40 rounded-circle" />
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">Send connection request</h6>
                                                            <p class="mb-0">Peter sent you connection request</p>
                                                            <small class="text-muted">4 days ago</small>
                                                        </div>
                                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-read"><span
                                                                    class="badge badge-dot"></span></a>
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-archive"><span
                                                                    class="bx bx-x"></span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item list-group-item-action dropdown-notifications-item">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar">
                                                                <img src="{{ asset('assets/img/avatars/6.png') }}" alt
                                                                    class="h-auto w-px-40 rounded-circle" />
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">New message from Jane</h6>
                                                            <p class="mb-0">Your have new message from Jane</p>
                                                            <small class="text-muted">5 days ago</small>
                                                        </div>
                                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-read"><span
                                                                    class="badge badge-dot"></span></a>
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-archive"><span
                                                                    class="bx bx-x"></span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li
                                                    class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar">
                                                                <span
                                                                    class="avatar-initial rounded-circle bg-label-warning"><i
                                                                        class="bx bx-error"></i></span>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">CPU is running high</h6>
                                                            <p class="mb-0">CPU Utilization Percent is currently at
                                                                88.63%,
                                                            </p>
                                                            <small class="text-muted">5 days ago</small>
                                                        </div>
                                                        <div class="flex-shrink-0 dropdown-notifications-actions">
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-read"><span
                                                                    class="badge badge-dot"></span></a>
                                                            <a href="javascript:void(0)"
                                                                class="dropdown-notifications-archive"><span
                                                                    class="bx bx-x"></span></a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-menu-footer border-top">
                                            <a href="javascript:void(0);"
                                                class="p-3 dropdown-item d-flex justify-content-center">
                                                View all notifications
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <!--/ Notification -->

                                <!-- User -->
                                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                    @auth
                                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                            data-bs-toggle="dropdown">
                                            <div class="avatar avatar-online">
                                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                                    class="rounded-circle" />
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="pages-account-settings-account.html">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar avatar-online">
                                                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                                                    class="rounded-circle" />
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <span class="fw-semibold d-block lh-1">John Doe</span>
                                                            <small>Admin</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="dropdown-divider"></div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="pages-profile-user.html">
                                                    <i class="bx bx-user me-2"></i>
                                                    <span class="align-middle">My Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="pages-account-settings-account.html">
                                                    <i class="bx bx-cog me-2"></i>
                                                    <span class="align-middle">Settings</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="pages-account-settings-billing.html">
                                                    <span class="align-middle d-flex align-items-center">
                                                        <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                        <span class="align-middle flex-grow-1">Billing</span>
                                                        <span
                                                            class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="dropdown-divider"></div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="pages-help-center-landing.html">
                                                    <i class="bx bx-support me-2"></i>
                                                    <span class="align-middle">Help</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="pages-faq.html">
                                                    <i class="bx bx-help-circle me-2"></i>
                                                    <span class="align-middle">FAQ</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="pages-pricing.html">
                                                    <i class="bx bx-dollar me-2"></i>
                                                    <span class="align-middle">Pricing</span>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="dropdown-divider"></div>
                                            </li>
                                            <li>

                                                <form action="{{ route('logout') }}" method="Post">
                                                    @csrf
                                                    <button type="submit" class=" dropdown-item">
                                                        <i class="bx bx-power-off me-2"></i>
                                                        <span class="align-middle">Log Out</span>
                                                    </button>
                                                </form>


                                            </li>
                                        </ul>
                                    @else
                                        <ul class="dropdown-menu dropdown-menu-end">



                                            <li>
                                                <a class="dropdown-item" href="pages-help-center-landing.html">
                                                    <i class="bx bx-support me-2"></i>
                                                    <span class="align-middle">Help</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="pages-faq.html">
                                                    <i class="bx bx-help-circle me-2"></i>
                                                    <span class="align-middle">FAQ</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="pages-pricing.html">
                                                    <i class="bx bx-dollar me-2"></i>
                                                    <span class="align-middle">Pricing</span>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="dropdown-divider"></div>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="auth-login-cover.html" target="_blank">
                                                    <i class="bx bx-power-off me-2"></i>
                                                    <span class="align-middle">Log In</span>
                                                </a>
                                            </li>
                                        </ul>
                                    @endauth
                                </li>
                                <!--/ User -->
                            </ul>
                        </div>

                        <!-- Search Small Screens -->
                        <div class="navbar-search-wrapper search-input-wrapper d-none">
                            <input type="text" class="border-0 form-control search-input container-fluid"
                                placeholder="Search..." aria-label="Search..." />
                            <i class="cursor-pointer bx bx-x bx-sm search-toggler"></i>
                        </div>
                    </div>
                </nav>
                <div class="content-wrapper">
                    {{ $slot }}
                </div>

            </div>
        </div>
    </div>

    <footer class="mt-auto content-footer footer bg-footer-theme no-print">
        <div
            class="{{ !empty($containerNav) ? $containerNav : 'container-fluid' }} d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
            <div class="mb-2 mb-md-0">
                Apollo Invoice ©
                <script>
                    document.write(new Date().getFullYear())
                </script>

            </div>
            <div>
                <a href="{{ config('variables.licenseUrl') ? config('variables.licenseUrl') : '#' }}"
                    class="footer-link me-4" target="_blank">License</a>
                <a href="{{ config('variables.moreThemes') ? config('variables.moreThemes') : '#' }}" target="_blank"
                    class="footer-link me-4">More Themes</a>
                <a href="{{ config('variables.documentation') ? config('variables.documentation') : '#' }}"
                    target="_blank" class="footer-link me-4">Documentation</a>
                <a href="{{ config('variables.support') ? config('variables.support') : '#' }}" target="_blank"
                    class="footer-link d-none d-sm-inline-block">Support</a>
            </div>
        </div>
    </footer>
    </div>

    <!-- / Layout wrapper -->
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
    <script src="{{ asset('assets/js/app-invoice-add.js') }}"></script>
    <script src="{{ asset('assets/js/pages-auth.js') }}"></script>
    @stack('scripts')


</body>

</html>
