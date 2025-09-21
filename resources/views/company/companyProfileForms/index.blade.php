<x-masterLayout :company="$company">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-0 breadcrumb-wrapper">
            <span class="text-muted fw-light">All Companies /</span>Company Profile
        </h4>
        <div class="mb-4">
            <small>Manage Company Details</small>

        </div>
        <div class="row gy-4">
            <!-- User Sidebar -->
            <div class="order-1 col-xl-4 col-lg-5 col-md-5 order-md-0">
                <!-- User Card -->
                <div class="mb-4 card">
                    <div class="card-body">
                        <div class="user-avatar-section">
                            <div class="d-flex align-items-center flex-column">
                                <img class="my-4 rounded img-fluid"
                                    src="{{ $company && $company->logo ? asset('storage/company_logo/' . $company->logo) : asset('path/to/default/logo.png') }}"
                                    height="110" width="110" alt="User avatar" />
                                <div class="text-center user-info">
                                    <h5 class="mb-2">{{ $company->name }}</h5>
                                    <span
                                        class="badge bg-label-secondary">{{ $company->category->name ?? 'No Category Selected' }}</span>
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
                                :class="{ 'active': selected === 'basic-info' }" class="nav-link">
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
                            <a href="#settings-pref"
                                x-on:click="selected = 'settings-pref'":class="{ 'active': selected === 'settings-pref' }"
                                class="nav-link">
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
                    <div class="mb-4 card" x-show="selected === 'settings-pref'">
                        <h5 class="card-header">Settings and preferences</h5>
                        <div class="mb-3 table-responsive">
                            @include('company.companyProfileForms.preferencesForm')

                        </div>
                    </div>
                    <!-- /Project table -->

                </div>


                <!-- Profile Completion Timeline -->
                <x-profile-completion-timeline :company="$company" />
                <!-- /Profile Completion Timeline -->

           
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
