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
            <span class="text-muted fw-light">
                <a href="{{ route('tax.index', ['slug' => $company->slug]) }} " style="color: #A8B1BB">All Taxes</a>
            </span>
            Edit Tax
        </h4>
        <div class="row">
            <!-- Basic -->
            <div class="mx-auto col-md-6">
                <div class="mb-4 card">
                    <h5 class="card-header">Edit {{ $tax->name }}</h5>

                    <form method="POST" action="{{ route('tax.update', ['slug' => $company->slug, 'id' => $tax->id]) }}" >
                        @csrf
                        @method('PATCH')
                        <x-form.input name="tax_name" value="{{ $tax->tax_name }}"/>
                        <x-form.input name="tax_percentage" value="{{ $tax->tax_percentage }}"/>
                        <div>
                            <label>Type:</label>
                            <div>
                                <input type="radio" id="primary" name="type" value="primary" required>
                                <label for="primary">Primary</label>
                            </div>
                            <div>
                                <input type="radio" id="secondary" name="type" value="secondary" required>
                                <label for="secondary">Secondary</label>
                            </div>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <a href="{{ route('tax.index', ['slug' => $company->slug]) }}">
                                <button
                                    type="button"
                                    class="btn btn-label-secondary"
                                >
                                    Cancel
                                </button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-masterLayout>
