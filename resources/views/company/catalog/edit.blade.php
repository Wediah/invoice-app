<x-masterLayout :company="$company">

    @section('title', 'Edit Stock')
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
        </style>
    @endpush
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4 breadcrumb-wrapper">
            <span class="text-muted fw-light"><a href="{{ route('catalog.index', ['slug' => $company->slug]) }} "
                    style="color: #A8B1BB">All Catalog</a>
                /</span>
            Edit Catalog
        </h4>
        <div class="row">
            <!-- Basic -->
            <div class="mx-auto col-md-6">
                <div class="mb-4 card">
                    <h5 class="card-header">Edit {{ $catalog->name }}</h5>
                    <form method="POST"
                        action="{{ route('catalog.update', ['slug' => $company->slug, 'id' => $catalog->id]) }}"
                        class="mt-10 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="card-body demo-vertical-spacing demo-only-element">
                            <div class="form-group">
                                <label class="form-label" for="basic-default-password12">Edit Stock Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Stock Name"
                                        aria-label="Enter Stock Name" aria-describedby="basic-addon11" name="name"
                                        value="{{ $catalog->name }}" />
                                </div>
                                @error('name')
                                <p class="error">{{ $message }}</p>
                            @enderror
                            </div>
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password12">Edit Stock Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">GHC</span>
                                    <input type="number" class="form-control" placeholder="Amount"
                                        aria-label="Amount (to the nearest Cedi)" name="price" value="{{ $catalog->price }}" />
                                </div>
                                @error('price')
                                <p class="error">{{ $message }}</p>
                            @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="basic-default-password12">Edit Stock Description</label>
                                <div class="input-group">
                                    <span class="input-group-text">Brief Description</span>
                                    <textarea class="form-control" aria-label="With textarea" name="description">{{ $catalog->description }}</textarea>
                                </div>
                                @error('description')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                <a href="{{ route('catalog.index', ['slug' => $company->slug]) }}">
                                    <button
                                        type="button"
                                        class="btn btn-label-secondary"
                                    >
                                        Cancel
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

</x-masterLayout>
