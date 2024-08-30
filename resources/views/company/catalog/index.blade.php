<x-masterLayout :company="$company">
    @section('title', 'Your Stock')
    <style>

    </style>

    <div class="container-xxl flex-grow-1 container-p-y">


        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="card-header  d-flex justify-content-between">
                        <div class="head-label text-center">
                            <h5 class="card-title mb-0">Comapny: {{ $company->name }}</h5>
                        </div>
                        <div class="dt-action-buttons text-end pt-3 pt-md-0">
                            <div class="dt-buttons">
                                <button class="dt-button buttons-collection btn btn-label-primary dropdown-toggle me-2"
                                    tabindex="0" aria-controls="DataTables_Table_0" type="button"
                                    aria-haspopup="true" aria-expanded="false"><span><i
                                            class="bx bx-export me-sm-2"></i> <span
                                            class="d-none d-sm-inline-block">Export</span></span></button>
                                <a href="{{ route('catalog.create', ['company_id' => $company->id]) }}"
                                    class="dt-button create-new btn btn-primary" tabindex="0"
                                    aria-controls="DataTables_Table_0" type="button"><span><i
                                            class="bx bx-plus me-sm-2"></i>
                                        <span class="d-none d-sm-inline-block">Add New Record</span></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row px-4 mb-4">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="DataTables_Table_0_length"><label>Show entries <select
                                        name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                        class="form-select">
                                        <option value="7">7</option>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="75">75</option>
                                        <option value="100">100</option>
                                    </select> </label></div>
                        </div>
                        <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                            <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input
                                        type="search" class="form-control" placeholder=""
                                        aria-controls="DataTables_Table_0"></label></div>
                        </div>
                    </div>
                    <table class="datatables-basic table table-bordered dataTable no-footer dtr-column "
                        id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info"
                        style="width: 1382px;">
                        <thead>
                            <tr role="row">


                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 133px;"
                                    aria-label="Name: activate to sort column ascending">Item</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 141px;"
                                    aria-label="Email: activate to sort column ascending">Price</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="2"
                                    colspan="1" style="width: 124px;"
                                    aria-label="Date: activate to sort column ascending">Description</th>
                                <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 161px;"
                                    aria-label="Salary: activate to sort column ascending">Status</th>
                                {{-- <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1"
                                    colspan="1" style="width: 157px;"
                                    aria-label="Status: activate to sort column ascending">Actions</th> --}}
                                <th class="sorting_disabled" style="width:10px;" aria-label="Actions">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($companyCatalog as $catalog)
                                <tr class="odd">
                                    <td valign="top" class="">{{ $catalog->name }}</td>
                                    <td valign="top" class="">GH₵{{ number_format($catalog->price, 2) }}</td>
                                    <td valign="top" class="">{{ $catalog->description }}</td>
                                    <td><span class="badge bg-label-primary me-1">{{ $catalog->status }}</span></td>


                                    {{-- <td valign="top"  class=""></td> --}}
                                    <td valign="top" class="d-flex">
                                        <div>
                                            <a class="dropdown-item p-0"
                                                href="{{ route('catalog.edit', ['slug' => $company->slug, 'id' => $catalog->id]) }}"><i
                                                    class="bx bx-edit-alt"></i> edit</a>

                                        </div>

                                        <div class="dropdown">

                                            <button type="button" class="btn py-0 pe-1 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <form
                                                    action="{{ route('catalog.instock', ['slug' => $company->slug, 'id' => $catalog->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="dropdown-item" type="submit">
                                                        <i class="bx bx-trash me-1"></i>
                                                        In Stock
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('catalog.outstock', ['slug' => $company->slug, 'id' => $catalog->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="dropdown-item" type="submit">
                                                        <i class="bx bx-trash me-1"></i>
                                                        Out of Stock
                                                    </button>
                                                </form>
                                                <form
                                                    action="{{ route('catalog.limited', ['slug' => $company->slug, 'id' => $catalog->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button class="dropdown-item" type="submit">
                                                        <i class="bx bx-trash me-1"></i>
                                                        Limited
                                                    </button>
                                                </form>

                                                </a>
                                                <form
                                                    action="{{ route('catalog.delete', ['slug' => $company->slug, 'id' => $catalog->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit">
                                                        <i class="bx bx-trash me-1"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>


                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between px-4 mt-4">
                        <div class="">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status"
                                aria-live="polite">Showing 0 to 0 of 0 entries</div>
                        </div>
                        <div class="">
                            <div class="" id="">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled"
                                        id="DataTables_Table_0_previous"><a href="#"
                                            aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0"
                                            class="page-link">Previous</a></li>
                                    <li class="paginate_button page-item next disabled" id="DataTables_Table_0_next">
                                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1"
                                            tabindex="0" class="page-link">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-masterLayout>
