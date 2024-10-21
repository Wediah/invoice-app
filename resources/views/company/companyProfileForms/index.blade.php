<x-masterLayout :company="$company">


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-0 breadcrumb-wrapper">
            <span class="text-muted fw-light">All Companies /</span>Company Profile
        </h4>
        <div class="mb-4 ">
            <small>Manage Company Details</small>

        </div>
        <div class="row gy-4">
            <!-- User Sidebar -->
            <div class="order-1 col-xl-4 col-lg-5 col-md-5 order-md-0">
                <!-- User Card -->
                <div class="mb-4 card">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class=" d-flex align-items-center flex-column">
                                <img class="my-4 rounded img-fluid" src="{{ asset('storage/company_logo') }}/{{ $company->logo }}"
                                    height="110" width="110" alt="User avatar" />
                                <div class="text-center user-info">
                                    <h5 class="mb-2">{{ $company->name }}</h5>
                                    <span class="badge bg-label-secondary">{{ $company->category->name ?? 'No Category Selected'}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex-wrap py-3 my-4 d-flex justify-content-around">
                            <div class="gap-3 mt-3 d-flex align-items-start me-4">
                                <span class="p-2 rounded badge bg-label-primary"><i
                                        class='bx bx-check bx-sm'></i></span>
                                <div>
                                    <h5 class="mb-0">1.23k</h5>
                                    <span>Total Invoices</span>
                                </div>
                            </div>
                            <div class="gap-3 mt-3 d-flex align-items-start">
                                <span class="p-2 rounded badge bg-label-primary"><i
                                        class='bx bx-customize bx-sm'></i></span>
                                <div>
                                    <h5 class="mb-0">568</h5>
                                    <span>Total Active Stock</span>
                                </div>
                            </div>
                        </div>
                        <h5 class="pb-2 mb-4 border-bottom">Details</h5>
                        <div class="info-container">
                            <ul class="list-unstyled">

                                <li class="mb-3">
                                    <span class="fw-bold me-2">Email:</span>
                                    <span>{{ $company->email }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Status:</span>
                                    <span class="badge bg-label-success">Active</span>
                                </li>

                                <li class="mb-3">
                                    <span class="fw-bold me-2">Tax id:</span>
                                    <span>{{ $company->tax_identification_number }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Contact:</span>
                                    <span>{{ $company->phone }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Currency:</span>
                                    <span>{{ $company->currency }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-bold me-2">Address:</span>
                                    <span>{{ $company->address }}</span>
                                </li>
                            </ul>
                            <div class="pt-3 d-flex justify-content-center">
                                {{-- <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser"
                                    data-bs-toggle="modal">Edit</a> --}}
                                <a href="javascript:;" class="btn btn-label-danger suspend-user">Deactivate</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->

            </div>
            <!--/ User Sidebar -->


            <!-- User Content -->
            <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                <!-- User Pills -->

                <div x-data="{ selected: 'basic-info' }">
                    <ul class="mb-3 nav nav-pills flex-column flex-md-row">
                        <li class="nav-item">
                            <a href="#basic-info" x-on:click="selected = 'basic-info'"
                                :class="{ 'active': selected === 'basic-info' }" class="nav-link ">
                                <i class="bx bx-user me-1"></i>Basic Information</a>
                        </li>
                        <li class="nav-item">
                            <a href="#advanced-info" x-on:click="selected = 'advanced-info'"
                                :class="{ 'active': selected === 'advanced-info' }"c class="nav-link">
                                <i class="bx bx-lock-alt me-1"></i>Advance Information</a>
                        </li>
                        <li class="nav-item">
                            <a href="#financial-info"
                                x-on:click="selected = 'financial-info'":class="{ 'active': selected === 'financial-info' }"
                                class="nav-link">
                                <i class="bx bx-detail me-1"></i>Financial Information</a>
                        </li>
                        <li class="nav-item">
                            <a href="#settings-pref" x-on:click="selected = 'settings-pref'":class="{ 'active': selected === 'settings-pref' }" class="nav-link" >
                                <i class="bx bx-bell me-1"></i>Settings and Preference</a>
                        </li>

                    </ul>
                    <!--/ User Pills -->

                    <!-- Basic Information -->
                    <div class="mb-4 card" x-show="selected === 'basic-info'">
                        <h5 class="card-header">Basic Projects List</h5>
                        <div class="mb-3 table-responsive">
                            @include('company.companyProfileForms.basicInfoForm')

                        </div>
                    </div>
                    <!-- /Project table -->
                    <!-- Advanced Information -->
                    <div class="mb-4 card" x-show="selected === 'advanced-info'">
                        <h5 class="card-header">Advanced Projects List</h5>
                        <div class="mb-3 table-responsive">
                            @include('company.companyProfileForms.advanceInfoForm')

                        </div>
                    </div>
                    <!-- /Project table -->
                    <!-- Financial Information -->
                    <div class="mb-4 card" x-show="selected === 'financial-info'">
                        <h5 class="card-header">Financial Projects List</h5>
                        <div class="mb-3 table-responsive">
                            @include('company.companyProfileForms.financialInfoForm')

                        </div>
                    </div>
                    <!-- /Project table -->
                    <!-- settings and pref  -->
                    <div class="mb-4 card" x-show="selected === 'settings-pref'" >
                        <h5 class="card-header">Settings and preferences</h5>
                        <div class="mb-3 table-responsive">
                            @include('company.companyProfileForms.preferencesForm')

                        </div>
                    </div>
                    <!-- /Project table -->

                </div>


                <!-- Activity Timeline -->
                <div class="mb-4 card">
                    <h5 class="card-header">Company Activity Timeline</h5>
                    <div class="card-body">
                        <ul class="timeline">
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="mb-1 timeline-header">
                                        <h6 class="mb-0">12 Invoices have been paid</h6>
                                        <small class="text-muted">12 min ago</small>
                                    </div>
                                    <p class="mb-2">Invoices have been paid to the company</p>
                                    <div class="d-flex">
                                        <a href="javascript:void(0)" class="me-3">
                                            <img src="{{ asset('assets/img/icons/misc/pdf.png') }}" alt="PDF image"
                                                width="20" class="me-2">
                                            <span class="fw-bold text-body">invoices.pdf</span>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-warning"></span>
                                <div class="timeline-event">
                                    <div class="mb-1 timeline-header">
                                        <h6 class="mb-0">Client Meeting</h6>
                                        <small class="text-muted">45 min ago</small>
                                    </div>
                                    <p class="mb-2">Project meeting with john @10:15am</p>
                                    <div class="flex-wrap d-flex">
                                        <div class="avatar me-3">
                                            <img src="{{ asset('assets/img/avatars/3.png') }}" alt="Avatar"
                                                class="rounded-circle" />
                                        </div>
                                        <div>
                                            <h6 class="mb-0">Lester McCarthy (Client)</h6>
                                            <span>CEO of {{ config('variables.creatorName') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-info"></span>
                                <div class="timeline-event">
                                    <div class="mb-1 timeline-header">
                                        <h6 class="mb-0">Create a new project for client</h6>
                                        <small class="text-muted">2 Day Ago</small>
                                    </div>
                                    <p class="mb-2">5 team members in a project</p>
                                    <div class="d-flex align-items-center avatar-group">
                                        <div class="avatar pull-up" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom" data-bs-placement="top"
                                            title="Vinnie Mostowy">
                                            <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                                class="rounded-circle">
                                        </div>
                                        <div class="avatar pull-up" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom" data-bs-placement="top" title="Marrie Patty">
                                            <img src="{{ asset('assets/img/avatars/12.png') }}" alt="Avatar"
                                                class="rounded-circle">
                                        </div>
                                        <div class="avatar pull-up" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom" data-bs-placement="top"
                                            title="Jimmy Jackson">
                                            <img src="{{ asset('assets/img/avatars/9.png') }}" alt="Avatar"
                                                class="rounded-circle">
                                        </div>
                                        <div class="avatar pull-up" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom" data-bs-placement="top"
                                            title="Kristine Gill">
                                            <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                                class="rounded-circle">
                                        </div>
                                        <div class="avatar pull-up" data-bs-toggle="tooltip"
                                            data-popup="tooltip-custom" data-bs-placement="top"
                                            title="Nelson Wilson">
                                            <img src="{{ asset('assets/img/avatars/14.png') }}" alt="Avatar"
                                                class="rounded-circle">
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-success"></span>
                                <div class="timeline-event">
                                    <div class="mb-1 timeline-header">
                                        <h6 class="mb-0">Design Review</h6>
                                        <small class="text-muted">5 days Ago</small>
                                    </div>
                                    <p class="mb-0">Weekly review of freshly prepared design for our new app.</p>
                                </div>
                            </li>
                            <li class="timeline-end-indicator">
                                <i class="bx bx-check-circle"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Activity Timeline -->

                <!-- Invoice table -->
                <div class="card">
                    <div class="mb-3 table-responsive">
                        <table class="table datatable-invoice border-top">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th><i class='bx bx-trending-up'></i></th>
                                    <th>Total</th>
                                    <th>Issued Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- /Invoice table -->
            </div>
            <!--/ User Content -->
        </div>
    </div>


    @push('alpine-plugins')
        <!-- Alpine Plugins -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>

        {{-- <!-- Alpine Core -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    @endpush
</x-masterLayout>
