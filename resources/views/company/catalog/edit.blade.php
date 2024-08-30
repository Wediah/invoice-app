<x-masterLayout :company="$company">

    @section('title', 'Edit Stock')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Basic -->
            <div class="col-md-6 mx-auto">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Catalog</h5>
                    <form method="POST" action="{{ route('catalog.update', ['slug' => $company->slug, 'id' => $catalog->id]) }}"
                        class="mt-10 space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="card-body demo-vertical-spacing demo-only-element">
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password12">Stock Name</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Enter Stock Name"
                                        aria-label="Enter Stock Name" aria-describedby="basic-addon11" required />
                                </div>
                            </div>
                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password12">Stock Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">GHC</span>
                                    <input type="text" class="form-control" placeholder="Amount"
                                        aria-label="Amount (to the nearest dollar)" required />
                                </div>
                            </div>

                            <div class="form-password-toggle">
                                <label class="form-label" for="basic-default-password12">Stock Description</label>
                                <div class="input-group">
                                    <span class="input-group-text">With textarea</span>
                                    <textarea class="form-control" aria-label="With textarea" placeholder="Comment" required></textarea>
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
