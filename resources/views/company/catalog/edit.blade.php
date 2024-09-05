<x-masterLayout :company="$company">

    @section('title', 'Edit Stock')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light"><a href="{{ route('catalog.index', ['slug' => $company->slug]) }} " style="color: #A8B1BB">All Catalog</a>
                /</span>
            Edit Catalog
        </h4>
        <div class="row">
            <!-- Basic -->
            <div class="col-md-6 mx-auto">
                <div class="card mb-4">
                    <h5 class="card-header">Edit {{ $catalog->name }}</h5>
                    <form method="POST" action="{{ route('catalog.update', ['slug' => $company->slug, 'id' => $catalog->id]) }}"
                        class="mt-10 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="card-body demo-vertical-spacing demo-only-element">
                            <div class="form-group">
                                <label class="form-label" for="basic-default-password12">Edit Stock Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Stock Name"
                                        aria-label="Enter Stock Name" aria-describedby="basic-addon11"  value="{{ $catalog->name }}"  />
                                </div>
                            </div>
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password12">Edit Stock Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">GHC</span>
                                    <input type="text" class="form-control" placeholder="Amount"
                                        aria-label="Amount (to the nearest Cedi)" value="{{ $catalog->price }}" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="basic-default-password12">Edit Stock Description</label>
                                <div class="input-group">
                                    <span class="input-group-text">Bried Description</span>
                                    <textarea class="form-control" aria-label="With textarea" >{{ $catalog->description }}</textarea>
                                </div>
                            </div>
                            <div class="float-end pb-3">
                                <button type="button" class="btn btn-primary">Submit</button>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

</x-masterLayout>
