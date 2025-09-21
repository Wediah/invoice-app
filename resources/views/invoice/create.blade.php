@php use Carbon\Carbon; @endphp
<x-masterLayout :company="$company">
    <!-- Content -->

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

            .form-control[readonly] {
                background-color: #fff;
                opacity: 1;
            }

            .epmty-field-color {
                color: #ff5b5c !important;
            }

            .error-2,
            .required {
                color: #ff5b5c;
            }

            .error {
                color: #ff5b5c !important;
                font-size: 12px;
                display: block;
            }

            /* Select2 Custom Styling */
            .select2-container--default .select2-selection--single {
                height: 38px;
                border: 1px solid #d9dee3;
                border-radius: 0.375rem;
            }

            .select2-container--default .select2-selection--single .select2-selection__rendered {
                line-height: 36px;
                padding-left: 12px;
                color: #697a8d;
            }

            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 36px;
                right: 8px;
            }

            .select2-container--default .select2-results__option--highlighted[aria-selected] {
                background-color: #696cff;
            }

            .select2-result-item__title {
                font-weight: 500;
                color: #566a7f;
            }

            .select2-result-item__description {
                margin-top: 2px;
                font-size: 0.875rem;
            }

            .select2-dropdown {
                border: 1px solid #d9dee3;
                border-radius: 0.375rem;
                box-shadow: 0 0.25rem 1rem rgba(165, 163, 174, 0.45);
            }

            .select2-results__option {
                padding: 12px 16px;
                border-bottom: 1px solid #f5f5f9;
            }

            .select2-results__option:last-child {
                border-bottom: none;
            }

            .select2-results__option--highlighted[aria-selected] {
                background-color: #5a8dee;
                color: #ffffff;
            }

            .select2-results__option--highlighted[aria-selected] .text-muted {
                color: rgba(255, 255, 255, 0.8) !important;
            }

            .select2-results__option--highlighted[aria-selected] .text-primary {
                color: #fff !important;
            }

            .select2-result-item {
                padding: 0;
            }

            .select2-result-item__title {
                font-size: 0.95rem;
                line-height: 1.4;
            }

            .select2-result-item__description {
                font-size: 0.8rem;
                line-height: 1.3;
                max-width: 200px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
        </style>
    @endpush

    <div class="container-xxl flex-grow-1 container-p-y">
        <form method="POST" action="{{ route('invoice.store', ['slug' => $company->slug]) }}" class="mt-10 space-y-6"
            enctype="multipart/form-data">
            @csrf
            <div class="row invoice-add">
                <!-- Invoice Add-->
                <div class="mb-4 col-lg-9 col-12 mb-lg-0">
                    <div class="card invoice-preview-card">
                        <div class="card-body">
                            <div class="row p-sm-3">
                                <div class="gap-2 d-flex svg-illustration">
                                    <img src="{{ asset('storage/company_logo') }}/{{ $company->logo }}"
                                        alt="company logo" class="w-12 h-12 rounded shadow-lg"
                                        style="width: auto; height: 50px;">

                                </div>
                            </div>

                            <div class="p-0 row p-sm-3">
                                @if ($errors->any())
                                    <span class="error">
                                        <ol>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ol>
                                    </span>
                                @endif
                                <div class="mb-4 col-md-6 mb-md-0">

                                    <span class="mb-2 app-brand-text h5 fw-bold">{{ $company->name }}</span>

                                    <p class="mb-1">{{ $company->gps_address }}</p>
                                    <p class="mb-1">{{ $company->address }}</p>
                                    <p class="mb-0">{{ $company->phone }}</p>
                                </div>
                                <div class="col-md-6">
                                    <dl class="mb-2 row">
                                        <dt class="mb-2 col-sm-6 mb-sm-0 text-md-end">
                                            <span class="mb-0 h5 text-capitalize text-nowrap">Invoice #</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                            <div class="w-px-150">
                                                <input type="text" class="form-control" disabled
                                                    value="{{ $invoiceNumber }}" />
                                            </div>
                                        </dd>
                                        <dt class="mb-2 col-sm-6 mb-sm-0 text-md-end">
                                            <span class="fw-normal">Date:</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                            <div class="w-px-150">
                                                <input type="text" class="form-control date-picker" disabled
                                                    value="{{ Carbon::now()->toDateString() }}" required />
                                            </div>
                                        </dd>
                                        <dt class="mb-2 col-sm-6 mb-sm-0 text-md-end">
                                            <span class="fw-normal due-date-label">Due Date:</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                            <div class="w-px-150">
                                                <input type="date" name="due_date"
                                                    class="form-control date-picker due-date-input"
                                                    placeholder="YYYY-MM-DD" required />
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>

                            <hr class="my-4 mx-n4" />
                            <div class="col-lg-12 col-md-6">
                                <div class="col-lg-12 col-md-6">
                                    @if (session('error'))
                                        <div class="error">
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="mt-3" style="float: right;">
                                    <!-- Button trigger modal -->

                                    <div data-bs-toggle="modal" data-bs-target="#modalCenter">
                                        <span class="p-2 rounded badge bg-label-secondary"><i
                                                class="bx bx-edit"></i>Edit</span>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalCenterTitle">Invoice TO</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

                                                    <div class="mb-3 row g-4">
                                                        <div class="mb-0 col">
                                                            <label for="customer_name" class="form-label">Customer
                                                                Name
                                                                <span class="required">&#42;</span>
                                                            </label>

                                                            <input type="text" class="form-control no-border"
                                                                name="customer_name" placeholder="Enter Customer Name"
                                                                aria-label="Enter Customer Name"
                                                                aria-describedby="basic-addon11" required
                                                                value="{{ old('customer_name') }}" />
                                                        </div>
                                                        <div class="mb-0 col">
                                                            <label for="customer_email" class="form-label">Customer
                                                                Email
                                                            </label>
                                                            <input type="text" class="form-control no-border"
                                                                name="customer_email" placeholder="Enter Customer Email"
                                                                aria-label="Enter Customer Email"
                                                                aria-describedby="basic-addon11"
                                                                value="{{ old('customer_email') }}" />
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row g-4">
                                                        <div class="mb-0 col">
                                                            <label for="customer_address" class="form-label">Customer
                                                                Address
                                                                <span class="required">&#42;</span>
                                                            </label>
                                                            <input type="text" class="form-control no-border"
                                                                name="customer_address"
                                                                placeholder="Enter Customer Address"
                                                                aria-label="Enter Enter Customer Address"
                                                                aria-describedby="basic-addon11"
                                                                value="{{ old('customer_address') }}" required />
                                                        </div>
                                                        <div class="mb-0 col-md-6">
                                                            <label for="customer_phone" class="form-label">Customer
                                                                Phone <span class="required">&#42;</span>
                                                            </label>
                                                            <input type="tel" class="form-control no-border"
                                                                name="customer_phone"
                                                                placeholder="Enter Customer Phone"
                                                                aria-label="Enter Customer Phone"
                                                                aria-describedby="basic-addon11"
                                                                value="{{ old('customer_phone') }}" required />
                                                        </div>
                                                        {{-- <div class="mb-0 col">
                                                            <label for="fax_number" class="form-label">Fax
                                                                Number</label>
                                                            <input type="text" class="form-control no-border"
                                                                name="fax_number" placeholder="Enter fax number"
                                                                aria-label="Enter fax number"
                                                                aria-describedby="basic-addon11" value="" />
                                                        </div> --}}
                                                    </div>
                                                    <div class="mb-3 row g-4">

                                                        <div class="mb-0 col-md-6">
                                                            <label for="customer_mobile" class="form-label">
                                                                Customer Mobile
                                                            </label>
                                                            <input type="tel" class="form-control no-border"
                                                                placeholder="Enter Customer Mobile"
                                                                aria-label="Enter Customer Mobile"
                                                                name="customer_mobile"
                                                                aria-describedby="basic-addon11"
                                                                value="{{ old('customer_mobile') }}" />
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer d-flex justify-content-between">
                                                    <button type="button" class="btn btn-label-secondary"
                                                        data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="button" id="invoiceTo"
                                                        class="btn btn-primary">Apply
                                                        changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-3 mt-3">
                                <!-- Information will be displayed here -->
                            </div>
                            <div class="p-0 row p-sm-3">
                                <h5 class="pb-2">Invoice To:</h5>

                                <div id="displayArea" class="mb-4 col-md-12 col-sm-5 col-12 mb-sm-0">
                                    <p class="mb-1 error-2">Customer Name:</p>
                                    <p class="mb-1 error-2">Customer Email:</p>
                                    <p class="mb-1 error-2">Customer Address:</p>
                                    <p class="mb-1 error-2">Customer Mobile:</p>
                                    <p class="mb-1 error-2">Customer Phone:</p>
                                    {{-- <p class="mb-0">Fax Number:</p> --}}
                                </div>

                            </div>

                            <hr class="mx-n4" />

                            <div class="source-item py-sm-3">
                                <div class="mb-3" data-repeater-list="group-a">
                                    <div class="pt-0 repeater-wrapper pt-md-4" data-repeater-item>
                                        <div class="rounded border d-flex position-relative pe-0">
                                            <div class="p-3 m-0 row w-100">
                                                <div class="mb-3 col-md-4 col-12 mb-md-0 ps-md-0">
                                                    <p class="mb-2 repeater-title">Item</p>
                                                    <select  name="group-a[0][catalog_id]"
                                                        class="mb-2 catalog_id form-select item-detailsX">
                                                        <option value="">Search for an item...</option>
                                                    </select>

                                                </div>

                                                <div class="col-md-3 col-12 pe-0">
                                                    <p class="mb-2 repeater-title">Unit Cost</p>
                                                    <div class="input-group">
                                                        <span
                                                            class="input-group-text">{{ $company->currency ?? 'GHS' }}</span>
                                                        <input type="number" name="price"
                                                            class="form-control invoice-item-price" required
                                                            readonly />
                                                    </div>

                                                </div>
                                                <div class="mb-3 col-md-2 col-12 mb-md-0">
                                                    <p class="mb-2 repeater-title">Qty</p>
                                                    <input type="number" name="group-a[0][quantity]"
                                                        class="form-control quantity invoice-item-qty" min="1"
                                                        required value="{{ old('quantity') }}" />
                                                </div>
                                                <div class="col-md-3 col-12 pe-0">
                                                    <p class="mb-2 repeater-title">Sub Total</p>
                                                    <div class="input-group">
                                                        <span
                                                            class="input-group-text">{{ $company->currency ?? 'GHS' }}</span>
                                                        <input type="number" name="group-a[0][item-sub_total]"
                                                            class="form-control invoice-item-sub_total"
                                                            aria-label="Amount" required readonly
                                                            value="{{ old('item-sub_total') ?? 0 }}" />

                                                    </div>
                                                    <div>
                                                        <span>Discount:</span>
                                                        <span class="discount me-2">0%</span>

                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="p-2 d-flex flex-column align-items-center justify-content-between border-start">

                                                <div>
                                                    <button style="border: none;background:none" id="hide-repeater"
                                                        data-bs-toggle="tooltip"
                                                        title="To hide this row, Please clear quantity first"
                                                        data-bs-placement="top" data-repeater-delete>
                                                        <i class="cursor-pointer bx bx-x fs-4 text-muted">
                                                        </i>
                                                    </button>
                                                </div>


                                                <div class="dropdown">

                                                    <i class="cursor-pointer bx bx-cog bx-xs text-muted more-options-dropdown"
                                                        role="button" id="dropdownMenuButton"
                                                        data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                                        aria-expanded="false">
                                                    </i>


                                                    <div class="p-3 dropdown-menu dropdown-menu-end w-px-300"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <div class="row g-3">
                                                            <div class="col-12">
                                                                <label for="discount_percent[]"
                                                                    class="form-label">Discount(%)</label>
                                                                <input type="number" class="form-control"
                                                                    id="discountInput" min="1"
                                                                    name="group-a[0][discount_percent]"
                                                                    max="100" />
                                                            </div>

                                                        </div>
                                                        <div class="my-3 dropdown-divider"></div>
                                                        <button type="button"
                                                            class="btn btn-label-primary btn-apply-changes">Apply
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary" data-repeater-create>Add
                                            Item
                                        </button>

                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 mx-n4" />

                            <div class="row py-sm-3">
                                <div class="mb-3 col-md-6 mb-md-0">
                                    <div class="mb-3 d-flex align-items-center">
                                        <label for="salesperson"
                                            class="form-label me-1 fw-semibold">Salesperson:</label>
                                        <input type="text" hidden="" name="salesperson"
                                            value="{{ $user->first_name }}">
                                        <p class="mb-1">{{ $user->first_name }}</p>

                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <!-- Totals Display -->
                                    <div class="invoice-calculations">
                                        <div class="mb-2 d-flex justify-content-between">
                                            <span class="me-5">Subtotal:</span>
                                            <span>{{ $company->currency ?? 'GHS' }}&nbsp;<span
                                                    class="subtotal">0.00</span>
                                            </span>
                                        </div>
                                        <div class="mb-2 d-flex justify-content-between">
                                            <span>Discount:</span>
                                            <span>{{ $company->currency ?? 'GHS' }}&nbsp;<span
                                                    class="discount">0.00</span>
                                        </div>
                                        <div class="mb-2 d-flex justify-content-between">
                                            {{-- <span>Primary Tax:</span> --}}
                                            <div id="tax-list"></div>
                                        </div>

                                        {{-- <div class="mb-2 d-flex justify-content-between">
                                            <span>Total Tax:</span>
                                            <span class="total-tax">$0.00</span>
                                        </div> --}}
                                        <div class="d-flex justify-content-between">
                                            <span>Total:</span>
                                            <span>{{ $company->currency ?? 'GHS' }}&nbsp;<span
                                                    class="total">0.00</span>
                                        </div>
                                        <input type="hidden" id="total_hidden_input" name="total" value="0.00">
                                        <input type="hidden" id="subtotal_hidden_input" name="subtotal"
                                            value="0.00">
                                        <input type="hidden" id="subtotalAfterDiscount_hidden_input"
                                            name="subtotalAfterDiscount" value="0.00">
                                        <input type="hidden" id="discount_total_hidden_input" name="total_discount"
                                            value="0.00">
                                        <input type="hidden" id="tax_total_hidden_input" name="tax_total"
                                            value="0.00">
                                    </div>

                                </div>
                            </div>

                            <hr class="my-4" />

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="note" class="form-label fw-semibold">Note:</label>
                                        <textarea class="form-control" rows="2" id="note" placeholder="Invoice note" name="notes">{{ $company->invoice_footnote }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Invoice Add-->

                <!-- Invoice Actions -->
                <div class="col-lg-3 col-12 invoice-actions">




                    {{-- List all taxes here and let users toggle to apply tax --}}
                    <div class="mb-5 card">
                        <div class="card-body">
                            <h6 class="mb-2">Taxes</h6>
                            @forelse ($taxes as $tax)
                            @empty
                                <span class="mb-2 app-brand-text h6 fw-bold text-danger">No Taxes Added</span>
                            @endforelse
                            @foreach ($taxes as $tax)
                                <div class="gap-2 mb-2 d-flex justify-content-between align-items-center">
                                    <label for="tax-{{ $tax->id }}"
                                        class="mb-0 badge bg-label-{{ $tax->type === 'SECONDARY' ? 'warning' : 'primary' }} text-wrap">
                                        {{ $tax->tax_name }} {{ $tax->tax_percentage }}%
                                    </label>
                                    <label class="switch switch-primary">
                                        <input type="checkbox" class="switch-input" id="tax-{{ $tax->id }}"
                                            name="tax_ids[]" value="{{ $tax->id }}" />
                                        <span class="switch-toggle-slider">
                                            <span class="switch-on"><i class="bx bx-check"></i></span>
                                            <span class="switch-off"><i class="bx bx-x"></i></span>
                                        </span>
                                        <span class="switch-label"></span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-4 card">
                        <div class="card-body">

                            <div class="my-3 d-flex">
                                <button type="submit" class="btn btn-label-success w-100">Save Invoice</button>
                            </div>
                            {{-- <span class="btn btn-primary d-grid w-100" data-bs-toggle="offcanvas"
                                data-bs-target="#sendInvoiceOffcanvas">
                                <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                        class="bx bx-paper-plane bx-xs me-3"></i>Send Invoice</span>
                            </span> --}}

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </form>



    </div>

    <!-- Offcanvas -->
    <!-- Send Invoice Sidebar -->
    {{-- <div class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">
        <div class="offcanvas-header border-bottom">
            <h6 class="offcanvas-title">Send Invoice</h6>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body flex-grow-1">
            <form>
                <div class="mb-3">
                    <label for="invoice-from" class="form-label">From</label>
                    <input type="text" class="form-control" id="invoice-from" value="shelbyComapny@email.com"
                        placeholder="company@email.com" />
                </div>
                <div class="mb-3">
                    <label for="invoice-to" class="form-label">To</label>
                    <input type="text" class="form-control" id="invoice-to" value="qConsolidated@email.com"
                        placeholder="company@email.com" />
                </div>
                <div class="mb-3">
                    <label for="invoice-subject" class="form-label">Subject</label>
                    <input type="text" class="form-control" id="invoice-subject"
                        value="Invoice of purchased Admin Templates" placeholder="Invoice regarding goods" />
                </div>
                <div class="mb-3">
                    <label for="invoice-message" class="form-label">Message</label>
                    <textarea class="form-control" name="invoice-message" id="invoice-message" cols="3" rows="8">
                                Dear Queen Consolidated,
                                Thank you for your business, always a pleasure to work with you!
                                We have generated a new invoice in the amount of $95.59
                                We would appreciate payment of this invoice by 05/11/2021</textarea>
                </div>
                <div class="mb-4">
                    <span class="badge bg-label-primary">
                        <i class="bx bx-link bx-xs"></i>
                        <span class="align-middle">Invoice Attached</span>
                    </span>
                </div>
                <div class="flex-wrap mb-3 d-flex">
                    <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel
                    </button>
                </div>
            </form>
        </div>
    </div> --}}
    <!-- /Send Invoice Sidebar -->
    <!-- /Offcanvas -->
    </div>
    <!-- / Content -->

    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const inputs = document.querySelectorAll('.due-date-input'); // Select all inputs with this class
                const labels = document.querySelectorAll('.due-date-label'); // Select all labels with this class

                inputs.forEach((input, index) => {
                    const label = labels[index]; // Match label with its corresponding input

                    // Initialize label color on page load
                    if (!input.value) {
                        label.classList.add('epmty-field-color');
                    } else {
                        label.classList.add('normal-color');
                    }

                    // Add event listener for each input to check its value
                    input.addEventListener('input', function() {
                        if (!input.value) {
                            label.classList.add('epmty-field-color');
                            label.classList.remove('normal-color');
                        } else {
                            label.classList.remove('epmty-field-color');
                            label.classList.add('normal-color');
                        }
                    });
                });
            });
        </script>

        <!-- Select2 Initialization for Searchable Item Dropdown -->
        <script>
            $(document).ready(function() {
                // Initialize Select2 on existing item dropdowns
                initializeSelect2();
                
                // Re-initialize Select2 when new items are added via repeater
                $(document).on('DOMNodeInserted', '.repeater-wrapper', function() {
                    setTimeout(() => {
                        initializeSelect2();
                    }, 100);
                });
                
                // Also initialize Select2 when repeater shows new items
                $(document).on('shown.bs.repeater', '.source-item', function() {
                    setTimeout(() => {
                        initializeSelect2();
                    }, 100);
                });
            });

            function initializeSelect2() {
                $('.item-detailsX').each(function() {
                    if (!$(this).hasClass('select2-hidden-accessible')) {
                        $(this).select2({
                            placeholder: 'Search or select an item...',
                            allowClear: true,
                            width: '100%',
                            ajax: {
                                url: '{{ route("catalog.search", ["slug" => $company->slug]) }}',
                                dataType: 'json',
                                delay: 250,
                                data: function (params) {
                                    return {
                                        q: params.term || '', // search term (empty string shows all items)
                                        page: params.page || 1
                                    };
                                },
                                processResults: function (data, params) {
                                    params.page = params.page || 1;
                                    
                                    return {
                                        results: data.results.map(function(item) {
                                            return {
                                                id: item.id,
                                                text: item.name + ' - ' + item.price + ' ' + '{{ $company->currency ?? "GHS" }}',
                                                name: item.name,
                                                price: item.price,
                                                description: item.description,
                                                unit: item.unit_of_measurement,
                                                status: item.status
                                            };
                                        }),
                                        pagination: {
                                            more: data.pagination.more
                                        }
                                    };
                                },
                                cache: true
                            },
                            minimumInputLength: 0, // Show all items initially
                            templateResult: formatItem,
                            templateSelection: formatItemSelection,
                            escapeMarkup: function (markup) {
                                return markup;
                            }
                        });
                    }
                });
            }

            function formatItem(item) {
                if (item.loading) {
                    return '<div class="select2-result-item"><div class="select2-result-item__title">Loading...</div></div>';
                }

                var statusColor = '';
                var statusText = '';
                if (item.status) {
                    switch(item.status) {
                        case 'in_stock':
                            statusColor = 'text-success';
                            statusText = 'In Stock';
                            break;
                        case 'out_of_stock':
                            statusColor = 'text-danger';
                            statusText = 'Out of Stock';
                            break;
                        case 'limited':
                            statusColor = 'text-warning';
                            statusText = 'Limited';
                            break;
                        default:
                            statusColor = 'text-muted';
                            statusText = item.status;
                    }
                }

                var markup = '<div class="select2-result-item d-flex justify-content-between align-items-start">' +
                    '<div class="flex-grow-1">' +
                        '<div class="select2-result-item__title fw-semibold">' + item.name + '</div>';
                
                if (item.description) {
                    markup += '<div class="mt-1 select2-result-item__description text-muted small">' + item.description + '</div>';
                }
                
                if (item.unit) {
                    markup += '<div class="text-muted small">Unit: ' + item.unit + '</div>';
                }
                
                markup += '</div>' +
                    '<div class="text-end">' +
                        '<div class="fw-bold text-primary">' + item.price + ' {{ $company->currency ?? "GHS" }}</div>';
                
                if (statusText) {
                    markup += '<div class="small' + statusColor + '">' + statusText + '</div>';
                }
                
                markup += '</div></div>';
                return markup;
            }

            function formatItemSelection(item) {
                return item.text || item.name;
            }

            // Handle item selection to update price - integrates with existing logic
            $(document).on('select2:select', '.item-detailsX', function (e) {
                var data = e.params.data;
                var $row = $(this).closest('.repeater-wrapper');
                var itemId = data.id;
                
                // Update the select value to trigger the existing change event
                $(this).val(itemId).trigger('change');
                
                // Also directly update the price field for immediate feedback
                if (data.price) {
                    $row.find('.invoice-item-price').val(data.price);
                    // Trigger the existing calculation functions if they exist
                    if (typeof updateTotalPrice === 'function') {
                        updateTotalPrice($row);
                    }
                    if (typeof debouncedUpdateCalculations === 'function') {
                        debouncedUpdateCalculations();
                    }
                }
            });
        </script>

 @endpush


</x-masterLayout>
