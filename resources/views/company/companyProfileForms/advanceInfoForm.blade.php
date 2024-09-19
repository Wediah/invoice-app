<div class=" card-body demo-vertical-spacing demo-only-element">
    <form action="{{ route('company.info',['slug'=>$company->slug]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-2 row">
            <div class="form-group col-6">
                <label class="form-label" for="name">Registration Number</label>
                <div class="input-group">
                    <input type="text" name="registration_number" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->registration_number }}" />
                </div>
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6 form-group">
                <label class="form-label" for="description">Company Description</label>
                <div class="input-group">
                    <input type="text" name="description" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->description }}" />
                </div>
                @error('description')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-2 row">
            <div class="form-group col-6">
                <label class="form-label" for="address">Company Address</label>
                <div class="input-group">
                    <input type="text" name="address" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->address }}" />
                </div>
                @error('address')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6 form-group">
                <label class="form-label" for="website">Company Website</label>
                <div class="input-group">
                    <input type="text" name="website" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->website }}" />
                </div>
                @error('website')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-2 row">
            <div class="form-group col-6">
                <label class="form-label" for="instagram">Instagram</label>
                <div class="input-group">
                    <input type="text" name="instagram" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->instagram }}" />
                </div>
                @error('instagram')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6 form-group">
                <label class="form-label" for="category">X (Twitter)</label>
                <div class="input-group">
                    <input type="text" name="twitter" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->twitter }}" />
                </div>
                @error('twitter')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6 form-group">
                <label class="form-label" for="linkedin">Linkedin</label>
                <div class="input-group">
                    <input type="text" name="linkedin" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->linkedin }}" />
                </div>
                @error('twitter')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6 form-group">
                <label class="form-label" for="category">Facebook</label>
                <div class="input-group">
                    <input type="text" name="facebook" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->facebook }}" />
                </div>
                @error('facebook')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="pt-4 float-end">
            <button type="submit"  class="btn btn-success">Submit</button>

        </div>
     

    
    </form>
</div>
