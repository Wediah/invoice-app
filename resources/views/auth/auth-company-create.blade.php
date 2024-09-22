<x-guest-layout>

    <div class="mx-auto authentication-basic container-p-y">
        <div class="py-4 authentication-inner">
            <!-- Register Card -->

            <div class="card">
                <div class="card-body">
                    <div class="mb-4 text-center">
                        <h4 class="mb-0 text-center ">Create Company</h4>
                        <small class="">Enter your company details</small>
                    </div>

                    <form id="companyFormAuthentication" class="mb-3" action="{{ route('company.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="gap-4 mb-4 d-flex align-items-start align-items-sm-center">
                            <img src="" alt="user-avatar" class="rounded d-block" height="100" width="100"
                                id="uploadedAvatar"
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
