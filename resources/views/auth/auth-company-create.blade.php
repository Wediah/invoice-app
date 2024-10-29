<x-guest-layout>
    @push('styles')
    <style>
        .authentication-wrapper {
        display: -ms-flexbox;
        display: block;
        -ms-flex-preferred-size: 100%;
        flex-basis: 100%;
        min-height: 100vh;
        width: 100%;
        }
    </style>
    @endpush

   <div class="row">
    <div class="col-12">
        <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme"
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
    </div>
   </div>
   <div class="row">
    <div class="mx-auto col-md-4">
        <div class="authentication-basic container-p-y">

            <div class="py-2 authentication-inner">
    
                <!-- Register Card -->
    
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 text-center">
                            <h3 class="mb-0 text-center ">Create Company</h3>
                            <small class="">Enter your company details</small>
                        </div>
    
                        <form id="companyFormAuthentication" class="mb-3" action="{{ route('company.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="gap-4 mb-4 d-flex align-items-start align-items-sm-center">
                                <img src="" alt="user-avatar" class="rounded d-block" height="100"
                                    width="100" id="uploadedAvatar"
                                    onerror="this.onerror=null; this.src='{{ asset('assets/img/avatars/logo-placeholder.png') }}';" />
                                <div class="button-wrapper">
                                    <label for="upload" class="mb-4 btn btn-primary me-2" tabindex="0">
                                        <span class="d-none d-sm-block">Upload new photo</span>
                                        <i class="bx bx-upload d-block d-sm-none"></i>
                                        <input type="file" id="upload" class="account-file-input" hidden
                                            accept="image/png, image/jpeg" name="logo" value="{{ old('logo') }}"
                                            required />
                                    </label>
                                    <button type="button" class="mb-4 btn btn-label-secondary account-image-reset">
                                        <i class="bx bx-reset d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Reset</span>
                                    </button>
    
                                    <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    @error('logo')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
    
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your company name" value="{{ old('name') }}" autofocus />
                                @error('name')
                                    <p class="error">{{ $message }}</p>
                                @enderror
    
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Company Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" value="{{ old('email') }}" />
                                @error('email')
                                    <p class="error ">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 ">
                                <label class="form-label" for="phone">Company Phone</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">
                                        <i class="fi fi-gh fis rounded-circle fs-3 me-1"></i> &nbsp;
                                        (+233)</span> <input type="text" id="phone" name="phone"
                                        class="form-control" placeholder="202 555 0111" value="{{ old('phone') }}" />
                                </div>
                                @error('phone')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="company_category_id">Company Category</label>
                                <div class="input-group">
                                    <select name="company_category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('company_category_id')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 ">
                                <label for="address" class="form-label blabel">Box Address</label>
    
                                <div class="input-group input-group-merge">
                                    {{-- <span class="input-group-text">
                                            Address
                                        </span> --}}
                                    <input type="text" id="address" name="address" class="form-control"
                                        placeholder="Enter Company Address" value="" />
                                </div>
                                @error('address')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 ">
                                <label for="gps_address" class="form-label blabel">Google Map
                                    address</label>
    
                                <div class="input-group input-group-merge">
                                    {{-- <span class="input-group-text">
                                            Address
                                        </span> --}}
                                    <input type="text" id="gps_address" name="gps_address" class="form-control"
                                        placeholder=" Enter longitude Coordinates" value="{{ old('gps_address') }}" />
                                </div>
                                @error('gps_address')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
    
                            <div class="mb-3 ">
                                <label for="website" class="form-label">Website URL</label>
                                <input type="text" class="form-control" id="website" name="website"
                                    placeholder="https://example.com" value="{{ old('website') }}" />
    
                                @error('website')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label blabel">company
                                    description</label>
    
                                <textarea class="form-control" id="basic-default-biox" name="description" rows="3" maxlength="150" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
    
    
    
    
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions"
                                        name="terms" />
                                    <label class="form-check-label" for="terms-conditions">
    
                                        <a href="javascript:void(0);">I agree to privacy policy & terms</a>
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100">Save</button>
                        </form>
    
    
    
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>
   </div>

    <script>
        // Update/reset user image of account page
        let accountUserImage = document.getElementById('uploadedAvatar');
        const fileInput = document.querySelector('.account-file-input'),
            resetFileInput = document.querySelector('.account-image-reset');

        if (accountUserImage) {
            const resetImage = accountUserImage.src;
            fileInput.onchange = () => {
                if (fileInput.files[0]) {
                    accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
                }
            };
            resetFileInput.onclick = () => {
                fileInput.value = '';
                accountUserImage.src = resetImage;
            };
        }
    </script>
</x-guest-layout>
