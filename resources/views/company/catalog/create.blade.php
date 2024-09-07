<x-masterLayout :company="$company">

    @section('title', 'Create Stock')
    @push('styles')
    <style>
        .input-group-text {
            padding: 0.269rem 0.285rem;
            font-size: 0.8375rem;

        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
        .error {
        color: red;
        font-size: 5px;
    }
    </style>
@endpush
    <div class="container-xxl flex-grow-1 container-p-y">
        
        <h4 class="py-3 mb-4 breadcrumb-wrapper">
            <span class="text-muted fw-light"><a href="{{ route('catalog.index', ['slug' => $company->slug]) }} " style="color: #A8B1BB">All Catalog</a>
                /</span>
            Create Catalog
        </h4>
        <div class="row">
            <!-- Basic -->
            <div class="mx-auto col-md-6">
                <div class="mb-4 card">
                    <h5 class="card-header">Add New Stock</h5>
                    <form method="POST" action="{{ route('catalog.store', ['company_id' => $company->id]) }}" class="mt-10 space-y-6"
                        enctype="multipart/form-data">
                      @csrf
                        <div class="card-body demo-vertical-spacing demo-only-element">
                            <div class="form-group">
                                <label class="form-label" for="stock_name">Stock Name</label>
                                <div class="input-group">
                                    <input type="text" name="stock_name" class="form-control" placeholder="Enter the name of your item/service"
                                        aria-label="Enter the name of your item/service" aria-describedby="basic-addon11"  value=""  />
                                </div>
                                @error('stock_name')
                                <p class="error">{{ $message }}</p>
                            @enderror
                            </div>
                            <div class="form-password-toggle">
                                <label class="form-label" for="stock_price">Stock Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">GHC</span>
                                    <input type="number" class="form-control" placeholder="Enter your price" name="stock_price"
                                        aria-label="Amount (to the nearest Cedi)" value=""  />


                                </div>
                                @error('stock_price')
                                <p class="error">{{ $message }}</p>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="stock_description">Stock Description</label>
                                <div class="input-group">
                                    <span class="input-group-text">Brief Description</span>
                                    <textarea name="stock_description" class="form-control" aria-label="With textarea" placeholder="Describe your item/service"  ></textarea>
                                </div>
                                @error('stock_description')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="pb-3 float-end">
                                <button type="submit"  class="btn btn-primary">Submit</button>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

</x-masterLayout>
