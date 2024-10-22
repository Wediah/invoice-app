<div class=" card-body demo-vertical-spacing demo-only-element">
    <form action="{{ route('company.update', ['slug' => $company->slug]) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf

        <div class="mb-2 row">
            <div class="form-group col-6">
                <label class="form-label" for="name">Company Name</label>
                <div class="input-group">
                    <input type="text" name="name" class="form-control" placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->name }}" />
                </div>
                @error('name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6 form-group">
                <label class="form-label" for="email">Company Email</label>
                <div class="input-group">
                    <input type="text" name="email" class="form-control" placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->email }}" />
                </div>
                @error('email')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-2 row">
            <div class="form-group col-6">
                <label class="form-label" for="address">Company Address</label>
                <div class="input-group">
                    <input type="text" name="address" class="form-control" placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->address }}" />
                </div>
                @error('address')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6 form-group">
                <label class="form-label" for="phone">Company Phone</label>
                <div class="input-group">
                    <input type="text" name="phone" class="form-control" placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->phone }}" />
                </div>
                @error('phone')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-2 row">
            <div class="form-group col-6">
                <label class="form-label" for="logo">Company Logo</label>
                <div class="input-group">
                    <input type="file" name="logo" class="form-control" placeholder="" aria-label=""
                        accept="image/*" aria-describedby="basic-addon11" value="{{ $company->logo }}" />
                </div>
                @error('logo')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6 form-group">
                <label class="form-label" for="category">Company Category</label>
                <div class="input-group">
                    <select name="category" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('company_category_id', $company->company_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('category')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="pt-4 float-end">
            <button type="submit" class="btn btn-success">Submit</button>

        </div>


    </form>
</div>
