<div class="card-body demo-vertical-spacing demo-only-element">
    <form action="{{ route('company.preference', ['slug' => $company->slug]) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="mx-auto col-11">
                <div class="row">
                    <div class="mb-3 form-group col-6">
                        <label class="form-label" for="invoice_prefix">Invoice Prefix</label>
                        <div class="input-group">
                            <input type="text" name="invoice_prefix" class="form-control" placeholder="Enter the name of your item/service"
                                aria-label="Enter the name of your item/service" aria-describedby="basic-addon11"  value="{{ $company->invoice_prefix }}"  />
                        </div>
                        @error('invoice_prefix')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    </div>
                    <div class="mb-3 form-group col-6">
                        <label class="form-label" for="invoice_numbering">Last Invoice Number</label>
                        <div class="input-group">
                            <input type="text" name="invoice_numbering" class="form-control" placeholder="Enter the name of your item/service"
                                aria-label="Enter the name of your item/service" aria-describedby="basic-addon11"  value="{{ $company->invoice_numbering }}"  />
                        </div>
                        @error('invoice_numbering')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                </div>
                <div class="form-group">
                    <label for="invoice_footnote" class="form-label">Invoice Footnote</label>
                    <textarea class="form-control" rows="2" id="invoice_footnote"
                              name="invoice_footnote" placeholder="Invoice Footnote">{{ $company->invoice_footnote
                              }}</textarea>
                    @error('invoice_footnote')
                    <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        <div class="pt-4 float-end">
            <button type="submit"  class="btn btn-success">Submit</button>

        </div>

    </form>
</div>
