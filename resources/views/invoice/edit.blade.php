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

            .error-2 {
                color: #ff5b5c
            }
        </style>
    @endpush

    <div class="container-xxl flex-grow-1 container-p-y">
        <form method="POST" action="{{ route('invoice.update', ['id' => $invoice->id]) }}" class="mt-10 space-y-6"
            enctype="multipart/form-data">
          @csrf
          @method('PATCH')
            <div class="row invoice-add">
                <!-- Invoice Add-->
                <div class="mb-4 col-lg-9 col-12 mb-lg-0">
                    <div class="card invoice-preview-card">
                        <div class="card-body">
                            <div class="row p-sm-3">
                                <div class="gap-2 d-flex svg-illustration">
                                    <img src="{{ asset('storage/company_logo') }}/{{ $company->logo }}"
                                        alt="company logo" class="w-12 h-12 rounded shadow-lg "
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
                                                <input type="text" class="form-control" disabled readonly
                                                value="{{ $invoice->invoice_number }}" />
                                            </div>
                                        </dd>
                                        <dt class="mb-2 col-sm-6 mb-sm-0 text-md-end">
                                            <span class="fw-normal">Date:</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                            <div class="w-px-150">
                                                <input type="text" class="form-control date-picker" disabled readonly
                                                value="{{ $invoice->created_at->format('d-m-Y') }}"/>
                                            </div>
                                        </dd>
                                        <dt class="mb-2 col-sm-6 mb-sm-0 text-md-end">
                                            <span class="fw-normal">Due Date:</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                            <div class="w-px-150">
                                                <input type="date" name="due_date" class="form-control date-picker"
                                                    placeholder="YYYY-MM-DD" value="{{ $invoice->due_date }}" required />
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>

                            <hr class="my-4 mx-n4" />
                            <div class="col-lg-12 col-md-6 ">
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
                                                                Name</label>
                                                            <input type="text" class="form-control no-border"
                                                                name="customer_name" placeholder="Enter Customer Name"
                                                                aria-label="Enter Customer Name"
                                                                aria-describedby="basic-addon11" value="" />
                                                        </div>
                                                        <div class="mb-0 col">
                                                            <label for="customer_email" class="form-label">Customer
                                                                Email</label>
                                                            <input type="text" class="form-control no-border"
                                                                name="customer_email" placeholder="Enter Customer Email"
                                                                aria-label="Enter Customer Email"
                                                                aria-describedby="basic-addon11" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row g-4">
                                                        <div class="mb-0 col">
                                                            <label for="customer_address" class="form-label">Customer
                                                                Address</label>
                                                            <input type="text" class="form-control no-border"
                                                                name="customer_address"
                                                                placeholder="Enter Customer Address"
                                                                aria-label="Enter Enter Customer Address"
                                                                aria-describedby="basic-addon11" value="" />
                                                        </div>
                                                        <div class="mb-0 col">
                                                            <label for="customer_mobile" class="form-label">Customer
                                                                Mobile</label>
                                                            <input type="text" class="form-control no-border"
                                                                placeholder="Enter Customer Mobile"
                                                                aria-label="Enter Customer Mobile"
                                                                name="customer_mobile"
                                                                aria-describedby="basic-addon11" value="" />
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 row g-4">
                                                        <div class="mb-0 col-md-6">
                                                            <label for="customer_phone" class="form-label">Customer
                                                                Phone</label>
                                                            <input type="text" class="form-control no-border"
                                                                name="customer_phone"
                                                                placeholder="Enter Customer Phone"
                                                                aria-label="Enter Customer Phone"
                                                                aria-describedby="basic-addon11" value="" />
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
                            <div class="p-3 mt-3 ">
                                <!-- Information will be displayed here -->
                            </div>
                            <div class="p-0 row p-sm-3">
                                <h5 class="pb-2">Invoice To:</h5>

                                <div id="displayArea" class="mb-4 col-md-12 col-sm-5 col-12 mb-sm-0 ">
                                    <p class="mb-1 ">Customer Name:&nbsp;{{ $invoice->customerInfo->customer_email }}</p>
                                    <p class="mb-1 ">Customer Email:&nbsp;{{$invoice->customerInfo->customer_address }}</p>
                                    <p class="mb-1 ">Customer Address:&nbsp;{{ $invoice->customerInfo->customer_phone }}</p>
                                    <p class="mb-1 ">Customer Mobile:&nbsp;{{ $invoice->customerInfo->customer_mobile }}</p>
                                </div>

                            </div>

                            <hr class="mx-n4" />

                            <div class="source-item py-sm-3">
                                <div class="mb-3" data-repeater-list="group-a">
                                    <div class="pt-0 repeater-wrapper pt-md-4" data-repeater-item>
                                        <div class="border rounded d-flex position-relative pe-0">
                                            <div class="p-3 m-0 row w-100">
                                                <div class="mb-3 col-md-4 col-12 mb-md-0 ps-md-0">
                                                    <p class="mb-2 repeater-title">Item</p>
                                                    <select name="group-a[0][catalog_id]"
                                                        class="mb-2 catalog_id form-select item-detailsX">
                                                        <option selected disabled>Select Item</option>
                                                        @foreach ($catalogs as $catalog)
                                                            <option value="{{ $catalog->id }}">
                                                                {{ $catalog->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-3 col-12 pe-0">
                                                    <p class="mb-2 repeater-title">Unit Cost</p>
                                                    <div class="input-group">
                                                        <span class="input-group-text">{{ $company->currency ?? 'GHS' }}</span>
                                                        <input type="number" name="price"
                                                            class="form-control invoice-item-price " required
                                                            readonly />
                                                    </div>

                                                </div>
                                                <div class="mb-3 col-md-2 col-12 mb-md-0">
                                                    <p class="mb-2 repeater-title">Qty</p>
                                                    <input type="number" name="group-a[0][quantity]"
                                                        class="form-control quantity invoice-item-qty" min="1"
                                                        required />
                                                </div>
                                                <div class="col-md-3 col-12 pe-0">
                                                    <p class="mb-2 repeater-title">Sub Total</p>
                                                    <div class="input-group">
                                                        <span class="input-group-text">{{ $company->currency ?? 'GHS'}}</span>
                                                        <input type="number" name="total[]"
                                                            class="form-control invoice-item-sub_total "
                                                            aria-label="Amount " required readonly />
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
                                        value="{{ $invoice->salesperson }}" >
                                        <p class="mb-1">{{ $invoice->salesperson }}</p>

                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end ">
                                    <!-- Totals Display -->
                                    <div class="invoice-calculations">
                                        <div class="mb-2 d-flex justify-content-between">
                                            <span class="me-5">Subtotal:</span>
                                            <span>{{ $company->currency }}&nbsp;<span class="subtotal">0.00</span>
                                        </span>
                                        </div>
                                        <div class="mb-2 d-flex justify-content-between">
                                            <span>Discount:</span>
                                            <span>{{ $company->currency ?? 'GHS' }}&nbsp;<span class="discount">0.00</span>
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
                                            <span>{{ $company->currency ?? 'GHS'}}&nbsp;<span class="total">0.00</span>
                                        </div>
                                        <input type="hidden" id="total_hidden_input" name="total" value="0.00">
                                    </div>

                                </div>
                            </div>

                            <hr class="my-4" />

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="note" class="form-label fw-semibold">Note:</label>
                                        <textarea class="form-control" rows="2" id="note" placeholder="Invoice note" name="notes"></textarea>
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
                            <span class="btn btn-primary d-grid w-100" data-bs-toggle="offcanvas"
                                data-bs-target="#sendInvoiceOffcanvas">
                                <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                        class="bx bx-paper-plane bx-xs me-3"></i>Send Invoice</span>
                            </span>

                        </div>
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </form>

    </div>

    <!-- Offcanvas -->
    <!-- Send Invoice Sidebar -->
    <div class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">
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
    </div>
    <!-- /Send Invoice Sidebar -->
    <!-- /Offcanvas -->
    </div>
    <!-- / Content -->
    <script></script>

</x-masterLayout>
