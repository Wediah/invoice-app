<x-masterLayout>

    <style>
        .blabel {
            font-weight: 700;
        }

        .error {
            color: red;
            font-size: 5px;
        }

        .mb-3 {
            margin-bottom: 1.18rem !important;
        }
    </style>





    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light"><a href="{{ route('dashboard') }}" style="color: #A8B1BB">All Companies</a>
                /</span>
            Create Company
        </h4>
        <div class="card mb-4 px-0">
            <h5 class="card-header">Add a new company</h5>
            <!-- Account -->

            <form method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="" alt="user-avatar"
                            class="d-block  h-auto ms-0 ms-sm-4 rounded-3 user-profile-img" height="100"
                            width="100" id="uploadedAvatar" name="company_logo_path"
                            onerror="this.onerror=null; this.src='{{ asset('assets/img/avatars/logo-placeholder.png') }}';" />
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload Logo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" class="account-file-input" hidden
                                    accept="image/png, image/jpeg" name="co_logo_path" value="" />
                            </label>

                            {{-- <button type="button" class="btn btn-label-secondary account-image-reset mb-4"
                              onclick="document.getElementById('upload').value = null; return false;">
                                  <i class="bx bx-reset d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Reset</span>
                              </button> --}}

                            {{-- <p class="mb-0">{{ $laboratories->company_logo_path }}</p> --}}
                            <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                            @error('company_logo_path')
                                <p class="error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div id="company-info" class="content">

                    <div class="row g-4" style="margin: 0rem 1rem">
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="co_name" class="form-label blabel ">Company Name</label>
                                    <input type="text" id="co_name" name="co_name" class="form-control"
                                        value="" />
                                    @error('co_name')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="co_email" class="form-label blabel">Company Email</label>
                                    <input class="form-control" type="email" id="co_email" name="co_email"
                                        value="" />
                                    @error('co_email')
                                        <p class="error ">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="row">


                                        <div class="mb-2 col-sm-6">
                                            <label for="co_phone" class="form-label blabel">Company Phone</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">
                                                    <i class="fi fi-gh fis rounded-circle fs-3 me-1"></i> &nbsp
                                                    (+233)</span>
                                                <input class="form-control mobile-number" type="text" id="co_phone"
                                                    name="co_phone" placeholder="202 555 0111" value="" />
                                            </div>
                                            @error('co_phone')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <div class="mb-4 col-sm-6">
                                            <label for="GPS" class="form-label blabel">Google Map
                                                address</label>

                                            <div class="input-group input-group-merge">
                                                {{-- <span class="input-group-text">
                                                      Address
                                                  </span> --}}
                                                <input type="text" id="longitude" name="longitude"
                                                    class="form-control" placeholder=" Enter longitude Cordinates"
                                                    value="" />
                                            </div>
                                            @error('longitude')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>



                                    </div>
                                </div>

                                <div class=" col-md-6">
                                    <div class="row">


                                        <div class=" col-sm-6">
                                            <label for="GPS" class="form-label blabel">Website URL</label>

                                            <div class="input-group input-group-merge">
                                                {{-- <span class="input-group-text">
                                                      Website
                                                  </span> --}}
                                                <input type="text" id="latitude" name="latitude"
                                                    class="form-control" placeholder="Enter Logitude Cordinates"
                                                    value="" />
                                            </div>
                                            @error('latitude')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <div class="mb-4 col-sm-6">
                                            <label for="GPS" class="form-label blabel">Box Address</label>

                                            <div class="input-group input-group-merge">
                                                {{-- <span class="input-group-text">
                                                      Address
                                                  </span> --}}
                                                <input type="text" id="longitude" name="longitude"
                                                    class="form-control" placeholder=" Enter longitude Cordinates"
                                                    value="" />
                                            </div>
                                            @error('longitude')
                                                <p class="error">{{ $message }}</p>
                                            @enderror
                                        </div>


                                    </div>
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="co_phone" class="form-label blabel">Company Category</label>

                                    <select id="multicol-country" class="select2 form-select"
                                        data-allow-clear="true">
                                        <option value="">Select</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="Canada">Canada</option>
                                        <option value="China">China</option>
                                        <option value="France">France</option>
                                        <option value="Germany">Germany</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Korea">Korea, Republic of</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Russia">Russian Federation</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                    </select>
                                    @error('co_phone')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-4 col-md-6">
                                    <label for="exampleFormControlTextarea1" class="form-label blabel">company description</label>
            



                                    <div class="input-group">
                                        <span class="input-group-text">Brief Description</span>
                                        <textarea class="form-control" aria-label="With textarea" placeholder="Comment" name="company_description"></textarea>
                                    </div>


                                    @error('company_description')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>


                            </div>
                            <br>
                            <div class="mt-1" style="float: right">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Save
                                    Changes</button>
                                <a href="" class="btn btn-label-secondary">Cancel Edit</a>
                            </div>
            </form>

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
</x-masterLayout>
