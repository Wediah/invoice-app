<x-masterLayout>
    @section('title', 'Your Companies')

    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="mb-4 py-3 d-flex justify-content-between align-items-center">
            <div>
                <h4 class=" mb-1 breadcrumb-wrapper">
                    {{-- <span class="text-muted fw-light">UI Elements /</span> --}}
                    Welcome,&nbsp;{{ auth()->user()->first_name }}
                </h4>
                <small> this is what you want or now nks niuehr iuji dfielhuiguiefkj</small>
            </div>


            <div class="demo-inline-spacing">
                <a href="{{ route('company.create') }}" class="btn btn-label-primary">
                    <span class="tf-icons bx bx-plus"></span>&nbsp; New Company
                </a>

            </div>
        </div>

        <!-- Connection Cards -->
        <div class="row g-4">
            @forelse  ($companies as $company)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <a href="{{ route('catalog.index', ['slug' => $company->slug]) }} " class="">

                        <div class="card h-100">
                            <div class="card-body text-center d-flex flex-column">

                                <div class="mx-auto mb-3 d-flex justify-content-center">
                                    <img src="{{ asset('storage/company_logo') }}/{{ $company->logo }}"
                                        alt="Avatar Image" class=" w-px-100 object-fit-cover"
                                        style="height:120px; width:auto" />
                                </div>

                                <h5 class="mb-1 card-title">{{ $company->name }}</h5>
                                <div class="d-flex align-items-center justify-content-center my-3 gap-2">
                                    {{-- <a href="javascript:;" class="me-1"><span class="badge bg-label-secondary"></span></a> --}}
                                    <a href="javascript:;">
                                        <span class="badge bg-label-warning">
                                            {{ optional($company->companyCategory)->name ?? 'No Category' }}
                                        </span>
                                    </a>
                                </div>

                                <div class="d-flex align-items-center justify-content-around my-4 py-2 ">
                                    <div>
                                        <h4 class="mb-1">{{ $company->invoices_count }}</h4>
                                        <span>Invoices</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-1">834</h4>
                                        <span>Product Categories</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-1">{{ $company->catalogs_count }}</h4>
                                        <span>Products</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mt-auto">
                                    <a href="{{ route('catalog.index', ['slug' => $company->slug]) }} "
                                        class="btn btn-primary d-flex align-items-center me-3"><i
                                            class="bx bx-view me-1"></i>View Company</a>
                                    {{-- <a href="javascript:;" class="btn btn-label-secondary btn-icon"><i
                                class="bx bx-envelope"></i></a> --}}
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            @empty
                no company listed
            @endforelse
        </div>
    </div>


        <!--/ Connection Cards -->
</x-masterLayout>
