<x-masterLayout :company="$company">
    @section('title', 'Your Stock')

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
                font-size: 12px;
            }
        </style>
    @endpush


    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Form Repeater -->
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Add New Stock</h5>
                @if ($errors->any())
                    <span class="error">
                        <ol>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ol>
                    </span>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('catalog.store', ['company_id' => $company->id]) }}"
                          class="stock-repeater" id="stock-repeater" enctype="multipart/form-data">
                        @csrf
                        <div data-repeater-list="group_a">
                            <div data-repeater-item>


                                <div class="row">
                                    <table class="table">

                                        <thead>
                                        <tr>
                                            <th class="mb-3 col-lg-6 col-xl-4 col-12">Stock Name<br></th>
                                            <th class="mb-3 col-lg-6 col-xl-4 col-12">Stock Price</th>
                                            <th class="mb-3 col-lg-6 col-xl-2 col-12">Stock Description</th>
                                            {{-- <th class="mb-3 col-lg-6 col-xl-3 col-12" data-bs-toggle="tooltip"
                                                data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                title=" Amount of time you must wait from exposure to testing">TAF
                                                <i class="fa-solid fa-circle-question"></i></th> --}}
                                        </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                        <tr>
                                            <div>

                                            </div>
                                            <td class="mb-3 col-lg-6 col-xl-4 col-12" style="min-height: 100%">
                                                <div>
                                                    <input type="text" id="form-repeater-1-1"
                                                           class="form-control {{ $errors->first('stock_name') ? ' form-error' : '' }}"
                                                           placeholder="Enter the name of your item/service"
                                                           name="stock_name"  />
                                                </div>


                                                @error('stock_name')
                                                <span class="error">{{ $message }}</span>
                                                @enderror

                                            </td>

                                            <td class="mb-3 col-lg-6 col-xl-4 col-12">

                                                <div>
                                                    <div class="input-group">
                                                        <span class="input-group-text">GHC</span>

                                                        <input type="number" id="form-repeater-1-1"
                                                               class="form-control {{ $errors->first('stock_price') ? ' form-error' : '' }}"
                                                               placeholder="Enter the price of your item/service"
                                                               name="stock_price"  />

                                                    </div>
                                                </div>

                                                @error('stock_price')
                                                <span class="error">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td class="mb-3 col-lg-6 col-xl-4 col-12">
                                                <div class="input-group">
                                                    <span class="input-group-text">Brief Description</span>
                                                    <textarea name="stock_description" class="form-control" aria-label="With textarea"
                                                              placeholder="Describe your item/service" {{ $errors->first('stock_description') ? ' form-error' : '' }}>
                                                        </textarea>

                                                </div>
                                                @error('stock_description')
                                                <p class="error">{{ $message }}</p>
                                                @enderror

                                            </td>


                                            <td class="mb-4 col-lg-6 col-xl-2 col-12">
                                                <button type="button" class="btn btn-label-danger mt-4x"
                                                        data-repeater-delete>
                                                    <i class="bx bx-x"></i>
                                                    <span class="align-middle"></span>
                                                </button>
                                            </td>

                                        </tr>


                                        </tbody>
                                    </table>



                                </div>
                                <hr />
                            </div>
                        </div>
                        <div class="mb-0 d-flex justify-content-between">
                            <button type="button" class="btn btn-primary me-2" data-repeater-create>
                                <i class="bx bx-plus"></i>
                                Add New Row
                            </button>
                            <button type="submit" class="btn btn-label-success">Save Changes</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Form Repeater -->
        <br>
        <hr class="my-3" />

        <br>

        <div class="card">
            <div class="pt-0 card-datatable table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="card-header d-flex justify-content-between">
                        <div class="text-center head-label">
                            <h5 class="mb-0 card-title">Company: {{ $company->name }}</h5>
                        </div>

                    </div>
                    <div class="px-4 mb-4 row">
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
                    <table class="table datatables-basic table-bordered dataTable no-footer dtr-column "
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

                        @foreach ($companyCatalogInstock as $catalog)
                            <tr class="odd">
                                <td valign="top" class="">{{ $catalog->name }}</td>
                                <td valign="top" class="">GH₵{{ number_format($catalog->price, 2) }}</td>
                                <td valign="top" class="">{{ $catalog->description }}</td>
                                <td><span class="badge bg-label-primary me-1">{{ $catalog->status }}</span></td>


                                {{-- <td valign="top"  class=""></td> --}}
                                <td valign="top" class="d-flex">
                                    <div>
                                        <a class="p-0 dropdown-item"
                                           href="{{ route('catalog.edit', ['slug' => $company->slug, 'id' => $catalog->id]) }}"><i
                                                class="bx bx-edit"></i></a>



                                    </div>

                                    <div class="dropdown">

                                        <button type="button" class="py-0 btn pe-1 dropdown-toggle hide-arrow"
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

                    <div class="px-4 mt-4 d-flex justify-content-between">
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


<script>
    'use strict';

    $(function() {
        var maxlengthInput = $('.bootstrap-maxlength-example'),
            formRepeater = $('#stock-repeater');

        // Bootstrap Max Length
        // --------------------------------------------------------------------
        if (maxlengthInput.length) {
            maxlengthInput.each(function() {
                $(this).maxlength({
                    warningClass: 'label label-success bg-success text-white',
                    limitReachedClass: 'label label-danger',
                    separator: ' out of ',
                    preText: 'You typed ',
                    postText: ' chars available.',
                    validate: true,
                    threshold: +this.getAttribute('maxlength')
                });
            });
        }

        // Form Repeater
        // ! Using jQuery each loop to add dynamic id and class for inputs. You may need to improve it based on form fields.
        // -----------------------------------------------------------------------------------------------------------------

        if (formRepeater.length) {
            var row = 2;
            var col = 1;
            // formRepeater.on('submit', function (e) {
            //   e.preventDefault();
            // });
            formRepeater.repeater({
                show: function() {
                    var fromControl = $(this).find('.form-control, .form-select');
                    var formLabel = $(this).find('.form-label');

                    fromControl.each(function(i) {
                        var id = 'form-repeater-' + row + '-' + col;
                        $(fromControl[i]).attr('id', id);
                        $(formLabel[i]).attr('for', id);
                        col++;
                    });

                    row++;

                    $(this).slideDown();
                },
                // hide: function(e) {
                //     confirm('Are you sure you want to delete this element?') && $(this).slideUp(e);
                // }
            });
        }
    });
</script>
