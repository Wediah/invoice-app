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
                            <label for="logo" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload Logo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="logo" class="account-file-input" hidden
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
                                  <label for="name" class="form-label blabel ">Company Name</label>
                                  <input type="text" id="name" name="name" class="form-control"
                                      value="" placeholder="Enter Company Name"/>
                                  @error('name')
                                      <p class="error">{{ $message }}</p>
                                  @enderror
                              </div>
                              <div class="mb-4 col-md-6">
                                  <label for="email" class="form-label blabel">Company Email</label>
                                  <input class="form-control" type="email" id="email" name="email"
                                      value="" placeholder="Enter Company Email"/>
                                  @error('email')
                                      <p class="error ">{{ $message }}</p>
                                  @enderror
                              </div>
                              <div class="col-md-6">
                                  <div class="row">


                                      <div class="mb-2 col-sm-6">
                                          <label for="phone" class="form-label blabel">Company Phone</label>
                                          <div class="input-group input-group-merge">
                                              <span class="input-group-text">
                                                  <i class="fi fi-gh fis rounded-circle fs-3 me-1"></i> &nbsp
                                                  (+233)</span>
                                              <input class="form-control mobile-number" type="text" id="phone"
                                                  name="phone" placeholder="202 555 0111" value="" />
                                          </div>
                                          @error('phone')
                                              <p class="error">{{ $message }}</p>
                                          @enderror
                                      </div>



                                      <div class="mb-4 col-sm-6">
                                          <label for="gps_address" class="form-label blabel">Google Map
                                              address</label>

                                            <div class="input-group input-group-merge">
                                                {{-- <span class="input-group-text">
                                                      Address
                                                  </span> --}}
                                              <input type="text" id="gps_address" name="gps_address"
                                                  class="form-control" placeholder=" Enter longitude Coordinates"
                                                  value="" />
                                          </div>
                                          @error('gps_address')
                                              <p class="error">{{ $message }}</p>
                                          @enderror
                                      </div>



                                  </div>
                              </div>

                              <div class=" col-md-6">
                                  <div class="row">


                                      <div class=" col-sm-6">
                                          <label for="website" class="form-label blabel">Website URL</label>

                                            <div class="input-group input-group-merge">
                                                {{-- <span class="input-group-text">
                                                      Website
                                                  </span> --}}
                                              <input type="text" id="website" name="website"
                                                  class="form-control" placeholder="Enter Company Website"
                                                  value="" />
                                          </div>
                                          @error('website')
                                              <p class="error">{{ $message }}</p>
                                          @enderror
                                      </div>



                                      <div class="mb-4 col-sm-6">
                                          <label for="address" class="form-label blabel">Box Address</label>

                                            <div class="input-group input-group-merge">
                                                {{-- <span class="input-group-text">
                                                      Address
                                                  </span> --}}
                                              <input type="text" id="address" name=address"
                                                  class="form-control" placeholder="Enter Company Address"
                                                  value="" />
                                          </div>
                                          @error('address')
                                              <p class="error">{{ $message }}</p>
                                          @enderror
                                      </div>


                                  </div>
                              </div>
                              <div class="mb-4 col-md-6">
                                  <label for="category" class="form-label blabel">Company Category</label>

                                  <div class="input-group input-group-merge">
                                      <input type="text" id="category" name=category"
                                             class="form-control" placeholder=" Enter Company Category"
                                             value="" />
                                  </div>
                                  @error('category')
                                      <p class="error">{{ $message }}</p>
                                  @enderror
                              </div>
                              <div class="mb-4 col-md-6">
                                  <label for="description" class="form-label blabel">company
                                      description</label>
                                  <textarea class="form-control" id="description" rows="3" maxlength="150"
                                      name="description">

                                      </textarea>
                                  @error('description')
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
                      </div>
                  </div>
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
