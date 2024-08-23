<x-layout>
    <div class="container-xxl flex-grow-1 container-p-y pt-4">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div
                            class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0"
                        >
                            <div class="mb-xl-0 mb-4">
                                <div class="d-flex svg-illustration mb-3 gap-2 align-items-baseline">
                                    <img src="{{ asset('storage/company_logo') }}/{{$invoice->company->logo}}" alt="company logo" class="h-20
                                        w-20 rounded"
                                    >
                                    <span class="app-brand-text h3 mb-0 fw-bold">{{ $invoice->company->name }}</span>
                                </div>
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
                        <div class="row p-sm-3 p-0">
                            <h6 class="pb-2">Invoice To:</h6>
                            <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                                <p class="mb-1">{{ $invoice->customer_name }}</p>
                                <p class="mb-1">{{ $invoice->email }}</p>
                                <p class="mb-1">{{ $invoice->address }}</p>
                            </div>
                            <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                                <p class="mb-1">{{ $invoice->phone }}</p>
                                <p class="mb-1">{{ $invoice->fax }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive px-4">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Item/Service</th>
                                <th scope="col">QTY</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $taxRate = 0; // Initialize total price variable
                                 $totalPrice = 0; // Initialize total price variable
                                 $totalTax = 0; // Initialize total tax variable
                                $discountRate = $invoice->discount / 100;
                                $totalPrimaryTax = 0;
                                $totalSecondaryTax = 0;
                                $primaryTax = 0;
                                $secondaryTax = 0;
                                $newTotalPrice = 0;
                            @endphp
                            @foreach ($invoice->catalogs as $catalog)
                                @php
                                    // Calculate subtotal for this catalog item
                                    $subtotal = $catalog->pivot->quantity * $catalog->price;

                                    // Add subtotal to total price
                                    $totalPrice += $subtotal;

                                    // Calculate the discount amount
                                    $discountedAmount = $totalPrice * $discountRate;
                                    $newTotalPrice = $totalPrice - $discountedAmount
                                @endphp
                                <tr>
                                    <th class="text-nowrap" scope="row">{{ $catalog->name }}</th>
                                    <td>{{ $catalog->pivot->quantity }}</td>
                                    <td>GH₵{{ number_format($catalog->price, 2) }}</td>
                                    <td>GH₵{{ number_format($subtotal, 2 )}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="align-top px-4 py-5">
                                    <p class="mb-2">
                                        <span class="me-1 fw-semibold">Salesperson:</span>
                                        <span>{{ $invoice->salesperson }}</span>
                                    </p>
                                </td>
                                <td class="px-4 py-5">
                                    <div class="d-flex justify-content-between">
                                        <p>Subtotal:</p>
                                        <p class="fw-semibold mb-2">GH₵{{ number_format($totalPrice, 2) }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Discount:</p>
                                        <p class="fw-semibold mb-2">GH₵{{ number_format($discountedAmount, 2) }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <p>Tax(es)</p>
                                        <p class="fw-semibold mb-2"></p>
                                    </div>
                                    <div>
                                        @foreach($invoice->taxes as $tax)
                                            @php
                                                //calculate the taxes
                                                if ($tax->type === 'PRIMARY') {
                                                    $primaryTax = $newTotalPrice * ($tax->tax_percentage / 100);
                                                    $totalPrimaryTax += $primaryTax;
                                                }
                                                else {
                                                    $secondaryTax = ( $totalPrimaryTax + $newTotalPrice ) * ($tax->tax_percentage / 100);
                                                    $totalSecondaryTax += $secondaryTax;
                                                }

                                                //total tax
                                                $totalTax = $totalPrimaryTax + $totalSecondaryTax;
                                            @endphp
                                            <div>
                                                @if($tax->type == 'PRIMARY')
                                                    <div class="d-flex justify-content-between">
                                                        <p>{{ $tax->tax_name }}({{ $tax->tax_percentage}}%):</p>
                                                        <p class="fw-semibold mb-2">GH₵{{ number_format($primaryTax, 2) }}</p>
                                                    </div>
{{--                                                    {{ $tax->tax_name }}({{ $tax->tax_percentage}}%): GH₵{{ number_format($primaryTax, 2) }}--}}
                                                @else
                                                    <div class="d-flex justify-content-between">
                                                        <p>{{ $tax->tax_name }}({{ $tax->tax_percentage}}%):</p>
                                                        <p class="fw-semibold mb-2">GH₵{{ number_format($secondaryTax,
                                                         2) }}</p>
                                                    </div>
{{--                                                    {{ $tax->tax_name }}({{ $tax->tax_percentage}}%): GH₵{{ number_format($secondaryTax, 2) }}--}}
                                                @endif

                                            </div>
                                        @endforeach
                                    </div>
                                    @php
                                        // Calculate the discount amount
                                        $discountedAmount = $totalPrice * $discountRate;
                                        // Calculate the total price after applying the discount
                                        $totalPriceAfterDiscount = $totalPrice - $discountedAmount;
                                        // Calculate the final total price after adding the tax
                                        $finalTotalPrice = $totalPriceAfterDiscount + $totalTax;
                                    @endphp
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-0">Total:</p>
                                        <p class="fw-semibold mb-0">GH₵{{ number_format($finalTotalPrice, 2) }}</p>
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
                        <button
                            class="btn btn-primary d-grid w-100 mb-3"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#sendInvoiceOffcanvas"
                        >
                        <span class="d-flex align-items-center justify-content-center text-nowrap"
                        ><i class="bx bx-paper-plane bx-xs me-3"></i>Send Invoice</span
                        >
                        </button>
                        <a href="{{ route('invoice.download_pdf', ['id' => $invoice->id]) }}">
                            <button class="btn btn-label-secondary d-grid w-100 mb-3">Download</button>
                        </a>
                        <a
                            class="btn btn-label-secondary d-grid w-100 mb-3"
                            target="_blank"
                            href="./app-invoice-print.html"
                        >
                            Print
                        </a>
                        <a href="./app-invoice-edit.html" class="btn btn-label-secondary d-grid w-100 mb-3">
                            Edit Invoice
                        </a>
                        <button
                            class="btn btn-primary d-grid w-100"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#addPaymentOffcanvas"
                        >
                        <span class="d-flex align-items-center justify-content-center text-nowrap"
                        ><i class="bx bx-dollar bx-xs me-3"></i>Add Payment</span
                        >
                        </button>
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>
    </div>
</x-layout>
