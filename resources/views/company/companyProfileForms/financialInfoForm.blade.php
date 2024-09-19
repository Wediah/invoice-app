<div class="card-body demo-vertical-spacing demo-only-element">
    <form action="{{ route('company.financial', ['slug' => $company->slug]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-2 row">
            <div class="mb-3 form-group col-md-6">
                <label class="form-label" for="tax_identification_number">Tax Identification Number</label>
                <div class="input-group">
                    <input type="text" name="tax_identification_number" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->tax_identification_number }}" />
                </div>
                @error('tax_identification_number')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 col-md-6 form-group">
                <label class="form-label" for="description">Company Currency</label>
                <div class="input-group">
                    <input type="text" name="currency" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->currency }}" />
                </div>
                @error('currency')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-2 row">
            <div class="mb-3 form-group col-md-6">
                <label class="form-label" for="account_number">Company Account Number</label>
                <div class="input-group">
                    <input type="text" name="account_number" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->account_number }}" />
                </div>
                @error('account_number')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 col-md-6 form-group">
                <label class="form-label" for="bank_name">Company Bank Name</label>
                <div class="input-group">
                    <input type="text" name="bank_name" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->bank_name }}" />
                </div>
                @error('bank_name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="mb-2 row">
            <div class="mb-3 col-md-6 form-group">
                <label class="form-label" for="bank_branch">Bank Branch</label>
                <div class="input-group">
                    <input type="text" name="bank_branch" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->bank_branch }}" />
                </div>
                @error('bank_branch')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 form-group col-md-6">
                <label class="form-label" for="swift_code">Swift Code</label>
                <div class="input-group">
                    <input type="text" name="swift_code" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->swift_code }}" />
                </div>
                @error('swift_code')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>

        </div>
        <div class="mb-2 row">
            <div class="mb-3 form-group col-md-4">
                <label class="form-label" for="merchant_network">Mobile Money Merchant</label>
                <div class="input-group">
                    <input type="text" name="merchant_network" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->merchant_network }}" />
                </div>
                @error('merchant_network')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 col-md-4 form-group">
                <label class="form-label" for="merchant_number">Merchant Number</label>
                <div class="input-group">
                    <input type="text" name="merchant_number" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->merchant_number }}" />
                </div>
                @error('merchant_number')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 col-md-4 form-group">
                <label class="form-label" for="merchant_id">Merchant ID</label>
                <div class="input-group">
                    <input type="text" name="merchant_id" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->merchant_id }}" />
                </div>
                @error('merchant_id')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 col-md-5 form-group">
                <label class="form-label" for="merchant_name">Merchant Name</label>
                <div class="input-group">
                    <input type="text" name="merchant_name" class="form-control"
                        placeholder="" aria-label=""
                        aria-describedby="basic-addon11" value="{{ $company->merchant_name }}" />
                </div>
                @error('merchant_name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
        </div>
      
        <div class="pt-4 float-end">
            <button type="submit"  class="btn btn-success">Submit</button>

        </div>
    </form>
</div>
