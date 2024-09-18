<x-masterLayout>
    @section('title', $invoice->customerInfo->customer_name. ' - Invoice')

    <div class="pt-4 container-xxl flex-grow-1 container-p-y">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="mb-4 col-xl-9 col-md-8 col-12 mb-md-0">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div  class="p-sm-3 row">
                            <div class="gap-2 d-flex svg-illustration align-items-baseline">
                                <img src="{{ asset('storage/company_logo') }}/{{ $invoice->company->logo }}"
                                    alt="company logo" class="w-20 h-20 rounded" style="width: auto; height: 50px;">
                            </div>
                        </div>
                        
                        <div
                            class="p-0 d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3">
                            <div class="mb-4 mb-xl-0">
                               
                                <span class="mb-2 app-brand-text h5 fw-bold">{{ $invoice->company->name }}</span>
                                <p class="mb-1">{{ $invoice->company->email }}</p>
                                <p class="mb-1">{{ $invoice->company->address }}</p>
                                <p class="mb-1">{{ $invoice->company->website }}</p>
                                <p class="mb-0">{{ $invoice->company->phone }}</p>
                            </div>
                            <div>
                                <div class="mb-2">
                                    <span class="me-1">Invoice:</span>
                                    <span class="fw-semibold">{{ $invoice->invoice_number }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="me-1">Date Issues:</span>
                                    <span class="fw-semibold">{{ $invoice->created_at->format('Y-m-d') }}</span>
                                </div>
                                <div>
                                    <span class="me-1">Date Due:</span>
                                    <span class="fw-semibold">{{ $invoice->due_date }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="p-0 row p-sm-3">
                            <h6 class="pb-2">Invoice To:</h6>
                            <div class="mb-4 col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0">
                                <p class="mb-1">{{ $invoice->customerInfo->customer_name }}</p>
                                <p class="mb-1">{{ $invoice->customerInfo->customer_email }}</p>
                                <p class="mb-1">{{ $invoice->customerInfo->customer_address }}</p>
                                <p class="mb-1">{{ $invoice->customerInfo->customer_mobile }}</p>
                                <p class="mb-1">{{ $invoice->customerInfo->customer_phone }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col-4">Item/Service</th>
                                    <th scope="col-2">QTY</th>
                                    <th scope="col-3">Unit</th>
                                    <th scope="col-3">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $taxRate = 0; // Initialize total price variable
                                    $totalPrice = 0; // Initialize total price variable
                                    $totalTax = 0; // Initialize total tax variable
                                    //                                $discountRate = $invoice->discount / 100;
                                    $totalPrimaryTax = 0;
                                    $totalSecondaryTax = 0;
                                    $primaryTax = 0;
                                    $secondaryTax = 0;
                                    $newTotalPrice = 0;
                                    $totalDiscount = 0;
                                @endphp
                                @foreach ($invoice->catalogs as $catalog)
                                    @php
                                        //calculate rate on each item
                                        $discountRate = $catalog->pivot->discount_percent / 100;

                                        // Calculate subtotal for this catalog item
                                        $subtotalBeforeDiscount = $catalog->pivot->quantity * $catalog->price;

                                        //calculate the subtotal after discount is applied
                                        $subtotal = $subtotalBeforeDiscount - $subtotalBeforeDiscount * $discountRate;

                                        // Add subtotal to total price
                                        $totalPrice += $subtotal;

                                        // Calculate the discount amount
                                        $totalDiscount += $subtotalBeforeDiscount * $discountRate;
                                    @endphp
                                    <tr>
                                        <td class="text-nowrap col-4 " scope="row"><strong>{{ $catalog->name }}</strong> </td>
                                        <td class="col-2">{{ $catalog->pivot->quantity }}</td>
                                        <td class="col-3">GH₵{{ number_format($catalog->price, 2) }}</td>
                                        <td class="col-3">GH₵{{ number_format($subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="px-4 py-5 align-top">
                                        <p class="mb-2">
                                            <span class="me-1 fw-semibold">Salesperson:</span>
                                            <span>{{ $invoice->salesperson }}</span>
                                        </p>
                                    </td>
                                    <td class="px-4 py-5">
                                        <div class="d-flex justify-content-between">
                                            <p>Subtotal:</p>
                                            <p class="mb-2 fw-semibold">GH₵{{ number_format($totalPrice, 2) }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Discount:</p>
                                            <p class="mb-2 fw-semibold">GH₵{{ number_format($totalDiscount, 2) }}</p>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <p>Tax(es)</p>
                                            <p class="mb-2 fw-semibold"></p>
                                        </div>
                                        <div>
                                            @foreach ($invoice->taxes as $tax)
                                                @php
                                                    //calculate the taxes
                                                    if ($tax->type === 'PRIMARY') {
                                                        $primaryTax = $totalPrice * ($tax->tax_percentage / 100);
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
                                                        <div class="d-flex justify-content-between">
                                                            <p>{{ $tax->tax_name }}({{ $tax->tax_percentage }}%):</p>
                                                            <p class="mb-2 fw-semibold">
                                                                GH₵{{ number_format($primaryTax, 2) }}</p>
                                                        </div>
                                                    @else
                                                        <div class="d-flex justify-content-between">
                                                            <p>{{ $tax->tax_name }}({{ $tax->tax_percentage }}%):</p>
                                                            <p class="mb-2 fw-semibold">
                                                                GH₵{{ number_format($secondaryTax, 2) }}
                                                            </p>
                                                        </div>
                                                    @endif

                                                </div>
                                            @endforeach
                                        </div>
                                        @php
                                            // Calculate the final total price after adding the tax
                                            $finalTotalPrice = $totalPrice + $totalTax;
                                        @endphp
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0">Total:</p>
                                            <p class="mb-0 fw-semibold">GH₵{{ number_format($finalTotalPrice, 2) }}</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-semibold">Note:</span>
                                <span>{{ $invoice->notes }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Invoice -->

            <!-- Invoice Actions -->
            <div class="col-xl-3 col-md-4 col-12 invoice-actions">
                <div class="card">
                    <div class="card-body">
                        <button class="mb-3 btn btn-primary d-grid w-100" data-bs-toggle="offcanvas"
                            data-bs-target="#sendInvoiceOffcanvas">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="bx bx-paper-plane bx-xs me-3"></i>Send Invoice</span>
                        </button>
                        <a href="{{ route('invoice.download_pdf', ['id' => $invoice->id]) }}">
                            <button class="mb-3 btn btn-label-secondary d-grid w-100">Download</button>
                        </a>
                        <a class="mb-3 btn btn-label-secondary d-grid w-100" target="_blank"
                            href="./app-invoice-print.html">
                            Print
                        </a>
                        <a href="./app-invoice-edit.html" class="mb-3 btn btn-label-secondary d-grid w-100">
                            Edit Invoice
                        </a>
                        <button class="btn btn-primary d-grid w-100" data-bs-toggle="offcanvas"
                            data-bs-target="#addPaymentOffcanvas">
                            <span class="d-flex align-items-center justify-content-center text-nowrap"><i
                                    class="bx bx-dollar bx-xs me-3"></i>Add Payment</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>
    </div>
</x-masterLayout>
