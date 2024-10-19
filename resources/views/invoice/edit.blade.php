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
                                                    value="{{ $invoice->created_at->format('d-m-Y') }}" />
                                            </div>
                                        </dd>
                                        <dt class="mb-2 col-sm-6 mb-sm-0 text-md-end">
                                            <span class="fw-normal">Due Date:</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                            <div class="w-px-150">
                                                <input type="date" name="due_date" class="form-control date-picker"
                                                    placeholder="YYYY-MM-DD" value="{{ $invoice->due_date }}"
                                                    required />
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
                                                                aria-describedby="basic-addon11"
                                                                value="{{ $invoice->customerInfo->customer_name }}" />
                                                        </div>
                                                        <div class="mb-0 col">
                                                            <label for="customer_email" class="form-label">Customer
                                                                Email</label>
                                                            <input type="text" class="form-control no-border"
                                                                name="customer_email" placeholder="Enter Customer Email"
                                                                aria-label="Enter Customer Email"
                                                                aria-describedby="basic-addon11"
                                                                value="{{ $invoice->customerInfo->customer_email }}" />
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
                                                                aria-describedby="basic-addon11"
                                                                value="{{ $invoice->customerInfo->customer_address }}" />
                                                        </div>
                                                        <div class="mb-0 col">
                                                            <label for="customer_mobile" class="form-label">Customer
                                                                Mobile</label>
                                                            <input type="text" class="form-control no-border"
                                                                placeholder="Enter Customer Mobile"
                                                                aria-label="Enter Customer Mobile"
                                                                name="customer_mobile"
                                                                aria-describedby="basic-addon11"
                                                                value="{{ $invoice->customerInfo->customer_mobile }}" />
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
                                                                aria-describedby="basic-addon11"
                                                                value="{{ $invoice->customerInfo->customer_phone }}" />
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
                            <div class="p-3 mt-3 ">
                                <!-- Information will be displayed here -->
                            </div>
                            <div class="p-0 row p-sm-3">
                                <h5 class="pb-2">Invoice To:</h5>

                                <div id="displayArea" class="mb-4 col-md-12 col-sm-5 col-12 mb-sm-0 ">
                                    <p class="mb-1 ">Customer Name:&nbsp;{{ $invoice->customerInfo->customer_name }}
                                    </p>
                                    <p class="mb-1 ">Customer
                                        Email:&nbsp;{{$invoice->customerInfo->customer_email }}</p>
                                    <p class="mb-1 ">Customer
                                        Address:&nbsp;{{ $invoice->customerInfo->customer_address }}</p>
                                    <p class="mb-1 ">Customer
                                        Mobile:&nbsp;{{ $invoice->customerInfo->customer_phone }}</p>
                                </div>

                            </div>

                            <hr class="mx-n4" />

                            <div class="px-4 table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col-4">Item/Service</th>
                                            <th scope="col-2">QTY</th>
                                            <th scope="col-2">UOM</th>
                                            <th scope="col-3">Unit Price</th>
                                            <th scope="col-3">Sub Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $taxRate = 0; // Initialize total price variable
                                            $totalPrice = 0; // Initialize total price variable
                                            $totalTax = 0; // Initialize total tax variable
                                            //$discountRate = $invoice->discount / 100;
                                            $totalPrimaryTax = 0;
                                            $totalSecondaryTax = 0;
                                            $primaryTax = 0;
                                            $secondaryTax = 0;
                                            $newTotalPrice = 0;
                                            $totalDiscount = 0;
                                        @endphp
                                        @foreach ($invoice->catalogs as $index => $catalog)
                                            @php
                                                //calculate rate on each item
                                                $discountRate = $catalog->pivot->discount_percent / 100;

                                                // Calculate subtotal for this catalog item
                                                $subtotalBeforeDiscount = $catalog->pivot->quantity * $catalog->price;

                                                //calculate the subtotal after discount is applied
                                                $subtotal =
                                                    $subtotalBeforeDiscount - $subtotalBeforeDiscount * $discountRate;

                                                // Add subtotal to total price
                                                $totalPrice += $subtotal;

                                                // Calculate the discount amount
                                                $totalDiscount += $subtotalBeforeDiscount * $discountRate;
                                            @endphp
                                            <tr>
                                                <td class="text-nowrap col-4 " scope="row">
                                                    <strong>{{ $catalog->name }}</strong>
                                                    <input name="group-a[{{ $index }}][catalog_id]"
                                                        value="{{ $catalog->id }}" hidden />
                                                </td>
                                                <td class="col-2">{{ $catalog->pivot->quantity }}
                                                    <input name="group-a[{{ $index }}][quantity]"
                                                        value="{{ $catalog->pivot->quantity }}" hidden />
                                                </td>
                                                <td class="col-2">{{ $catalog->unit_of_measurement }}
                                                    <input name="group-a[{{ $index }}][unit_of_measurement]"
                                                        value="{{ $catalog->unit_of_measurement }}" hidden />
                                                </td>

                                                <td class="col-3">GH₵{{ number_format($catalog->price, 2) }}
                                                    <input name="group-a[{{ $index }}][price]"
                                                        value="{{ $catalog->price }}" hidden />
                                                </td>
                                                <td class="col-3">GH₵{{ number_format($subtotal, 2) }}</td>
                                                <td>
                                                    <input name="group-a[0][discount_percent]"
                                                        value="{{ $catalog->pivot->discount_percent }}" hidden />
                                                </td>
                                            </tr>
                                        @endforeach
                                     
                                    </tbody>
                                </table>

                                <div class="row py-sm-3 mt-4">
                                    <div class="mb-3 col-md-6 mb-md-0">
                                        <div class="mb-3 d-flex align-items-center">
                                            <label for="salesperson"
                                                class="form-label me-1 fw-semibold">Salesperson: <span>{{ $invoice->salesperson }}</span></label>
                                                

    
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-flex justify-content-end ">
                                        <!-- Totals Display -->
                                        <div class="invoice-calculations">
                                            <div class="mb-2 d-flex justify-content-between">
                                                <span class="me-5">Subtotal:</span>
                                                <span>{{ $company->currency ?? 'GHS' }}&nbsp;<span class="fw-semibold">{{ number_format($totalPrice, 2) }}</span>
                                            </span>
                                            </div>
                                            <div class="mb-2 d-flex justify-content-between">
                                                <span>Discount:</span>
                                                <span>{{ $company->currency ?? 'GHS' }}&nbsp;<span class="fw-semibold">{{ number_format($totalDiscount, 2) }}</span>
                                            </div>
                                          
                                            <div class="mb-2">
                                                 @foreach ($invoice->taxes as $tax)
                                                        @php
                                                            //calculate the taxes
                                                            if ($tax->type === 'PRIMARY') {
                                                                $primaryTax =
                                                                    $totalPrice * ($tax->tax_percentage / 100);
                                                                $totalPrimaryTax += $primaryTax;
                                                            } else {
                                                                $secondaryTax =
                                                                    ($totalPrimaryTax + $totalPrice) *
                                                                    ($tax->tax_percentage / 100);
                                                                $totalSecondaryTax += $secondaryTax;
                                                            }

                                                            //total tax
                                                            $totalTax = $totalPrimaryTax + $totalSecondaryTax;
                                                        @endphp
                                                        <div>
                                                            @if ($tax->type == 'PRIMARY')
                                                                <div class="gap-5 d-flex justify-content-between">
                                                                    <span>{{ $tax->tax_name }}({{ $tax->tax_percentage }}%):
                                                                    </span>
                                                                    <span class="mb-2 fw-semibold">
                                                                        GH₵{{ number_format($primaryTax, 2) }}</span>
                                                                </div>
                                                            @else
                                                                <div class="gap-5 d-flex justify-content-between">
                                                                    <span>{{ $tax->tax_name }}({{ $tax->tax_percentage }}%):
                                                                    </span>
                                                                    <span class="mb-2 fw-semibold">
                                                                        GH₵{{ number_format($secondaryTax, 2) }}
                                                                    </span>
                                                                </div>
                                                            @endif

                                                        </div>
                                                    @endforeach
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                @php
                                                // Calculate the final total price after adding the tax
                                                $finalTotalPrice = $totalPrice + $totalTax;
                                            @endphp
                                                <span>Total:</span>
                                                <span>{{ $company->currency ?? 'GHS'}}&nbsp;<span class="total">{{ number_format($finalTotalPrice, 2) }}</span>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="note" class="form-label fw-semibold">Note:</label>
                                        <textarea class="form-control" rows="2" id="note" name="notes">{{ $invoice->notes }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Invoice Add-->

                <!-- Invoice Actions -->
                <div class="col-lg-3 col-12 invoice-actions">

                    <div class="mb-4 card">
                        <div class="card-body">

                            <div class="my-3 d-flex">
                                <button type="submit" class="btn btn-label-success w-100">Save Invoice</button>
                            </div>
                     

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
    <!-- / Content -->
    <script></script>

</x-masterLayout>
