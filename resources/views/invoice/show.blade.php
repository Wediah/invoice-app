<x-masterLayout>
    @section('title', $invoice->customerInfo->customer_name . ' - Invoice')

    @push('styles')
        <style>
            /* Normal styles */


            .print-only {
                display: none;
            }



            /* Print styles */
            @media print {
                body {
                    font-size: 12pt;
                    background: transparent none;
                    box-shadow: none;
                    width: 100%;
                    height: 100%;
                    border-radius: 0;
                    page-break-inside: avoid;
                    page-break-before: avoid;
                    page-break-after: avoid;
                }

                .print-only {
                    display: block;
                }

                thead {
                    display: table-row-group;
                    /* Forces the thead to behave like part of the table body */
                }

                /* Optionally, you can also control page breaks to improve the print layout */
                table,
                tr,
                td,
                th {
                    page-break-inside: avoid;
                }

                header,
                footer {
                    display: none;
                }

                * {
                    margin: 0;
                    padding: 0;
                    box-shadow: none;
                    page-break-inside: avoid;
                    page-break-before: avoid;
                    page-break-after: avoid;
                }

                .no-print {
                    display: none;
                }

                .page-break {
                    page-break-before: avoid;
                }
            }
        </style>
    @endpush
    <div class="pt-4 container-xxl flex-grow-1 container-p-y no-print">
        <div class="row invoice-preview">
            <div class="mb-4 col-xl-9 col-md-8 col-12 mb-md-0">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div class="p-sm-3 row">
                            <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0">
                                <img src="{{ asset('storage/company_logo') }}/{{ $invoice->company->logo }}"
                                    alt="company logo" class="w-20 h-20 rounded" style="width: auto; height: 50px;">
                            </div>
                            <div class="col-xl-6 col-md-12 col-sm-7 col-12 text-end">
                                <span class="mb-2 app-brand-text h5 fw-bold">{{ $invoice->company->name }}</span>
                                <p class="mb-1">{{ $invoice->company->email }}</p>
                                <p class="mb-1">{{ $invoice->company->address }}</p>
                                <p class="mb-1">{{ $invoice->company->website }}</p>
                                <p class="mb-0">{{ $invoice->company->phone }}</p>
                            </div>
                        </div>


                    </div>
                    <hr class="my-0" />
                    <div class="card-body" >
                        <div class="p-0 rounded row p-sm-3" style="background: #f3f4f4;
">
                            <div class="mb-4 col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0">
                                <h6 class="pb-2">Invoice To:</h6>
                                <p class="mb-1">{{ $invoice->customerInfo->customer_name }}</p>
                                <p class="mb-1">{{ $invoice->customerInfo->customer_email }}</p>
                                <p class="mb-1">{{ $invoice->customerInfo->customer_address }}</p>
                                <p class="mb-1">{{ $invoice->customerInfo->customer_mobile }}</p>
                            </div>
                            <div class="col-xl-6 col-md-12 col-sm-7 col-12 text-end">
                                <h6 class="pb-2">Invoice Details:</h6>
                                <p class="mb-1">Invoice Number: {{ $invoice->invoice_number }}</p>
                                <p class="mb-1">Issue Date: {{ $invoice->created_at->format('Y-m-d') }}</p>
                                <p class="mb-1">Due Date: {{ $invoice->due_date }}</p>
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
                                    //$discountRate = $invoice->discount / 100;
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
                                        <td class="text-nowrap col-4 " scope="row">
                                            <strong>{{ $catalog->name }}</strong> </td>
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
                                        <div class="gap-5 d-flex justify-content-between">
                                            <p>Subtotal:</p>
                                            <p class="mb-2 fw-semibold">GH₵{{ number_format($totalPrice, 2) }}</p>
                                        </div>
                                        <div class="gap-5 d-flex justify-content-between">
                                            <p>Discount:</p>
                                            <p class="mb-2 fw-semibold">GH₵{{ number_format($totalDiscount, 2) }}</p>
                                        </div>
                                        <div class="gap-5 d-flex justify-content-between">
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
                                                        <div class="gap-5 d-flex justify-content-between">
                                                            <p>{{ $tax->tax_name }}({{ $tax->tax_percentage }}%):</p>
                                                            <p class="mb-2 fw-semibold">
                                                                GH₵{{ number_format($primaryTax, 2) }}</p>
                                                        </div>
                                                    @else
                                                        <div class="gap-5 d-flex justify-content-between">
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
                                        <div class="gap-5 d-flex justify-content-between">
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
            <div class="bg-transparent col-xl-3 col-md-4 col-12 invoice-actions no-print">
                <div class="card">
                    <div class="card-body">
                        <button onclick="window.print()" class="mb-3 btn btn-primary d-grid w-100">Download</button>
                        <button onclick="window.print()" class="mb-3 btn btn-secondary d-grid w-100">Print</button>
                        <a href="{{ route('invoice.edit', ['slug' => $company->slug, 'id' => $invoice->id]) }}"
                            class="mb-3 btn btn-label-secondary d-grid w-100">
                            Edit Invoice
                        </a>
                        <a href="{{ route('invoice.index', ['slug' => $invoice->company->slug]) }}"
                            class="mb-3 btn btn-label-secondary d-grid w-100">
                            All Invoices
                        </a>
                        <a href="{{ route('invoice.create', ['slug' => $invoice->company->slug]) }}"
                            class="mb-3 btn btn-label-secondary d-grid w-100">
                            Create New Invoice
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>
    </div>
    <div class="pt-0 mt-0 print-only">
        <div class="card-body">
            <div class="p-sm-3 row">
                <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0">
                    <img src="{{ asset('storage/company_logo') }}/{{ $invoice->company->logo }}"
                        alt="company logo" class="w-20 h-20 rounded" style="width: auto; height: 50px;">
                        
                </div>
                <div class="col-xl-6 col-md-12 col-sm-7 col-12 text-end">
                    <span class="mb-2 app-brand-text h5 fw-bold">{{ $invoice->company->name }}</span>
                    <p class="mb-1">{{ $invoice->company->email }}</p>
                    <p class="mb-1">{{ $invoice->company->address }}</p>
                    <p class="mb-1">{{ $invoice->company->website }}</p>
                    <p class="mb-0">{{ $invoice->company->phone }}</p>
                </div>
            </div>
   
   
        </div>
        <hr class="my-0" />
        <div class="card-body">
                           <div class="p-0 row p-sm-3">
                               <div class="mb-4 col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0">
                                   <h6 class="pb-2">Invoice To:</h6>
                                   <p class="mb-1">{{ $invoice->customerInfo->customer_name }}</p>
                                   <p class="mb-1">{{ $invoice->customerInfo->customer_email }}</p>
                                   <p class="mb-1">{{ $invoice->customerInfo->customer_address }}</p>
                                   <p class="mb-1">{{ $invoice->customerInfo->customer_mobile }}</p>
                               </div>
                               <div class="col-xl-6 col-md-12 col-sm-7 col-12 text-end">
                                   <h6 class="pb-2">Invoice Details:</h6>
                                   <p class="mb-1">Invoice Number: {{ $invoice->invoice_number }}</p>
                                   <p class="mb-1">Issue Date: {{ $invoice->created_at->format('Y-m-d') }}</p>
                                   <p class="mb-1">Due Date: {{ $invoice->due_date }}</p>
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
                    //$discountRate = $invoice->discount / 100;
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
                            <div class="gap-5 d-flex justify-content-between">
                                <p>Subtotal:</p>
                                <p class="mb-2 fw-semibold">GH₵{{ number_format($totalPrice, 2) }}</p>
                            </div>
                            <div class="gap-5 d-flex justify-content-between">
                                <p>Discount:</p>
                                <p class="mb-2 fw-semibold">GH₵{{ number_format($totalDiscount, 2) }}</p>
                            </div>
                            <div class="gap-5 d-flex justify-content-between">
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
                                ($totalPrimaryTax + $totalPrice) * ($tax->tax_percentage / 100);
                                $totalSecondaryTax += $secondaryTax;
                                }
   
                                //total tax
                                $totalTax = $totalPrimaryTax + $totalSecondaryTax;
                                @endphp
                                <div>
                                    @if ($tax->type == 'PRIMARY')
                                    <div class="gap-5 d-flex justify-content-between">
                                        <p>{{ $tax->tax_name }}({{ $tax->tax_percentage }}%):</p>
                                        <p class="mb-2 fw-semibold">
                                            GH₵{{ number_format($primaryTax, 2) }}</p>
                                    </div>
                                    @else
                                    <div class="gap-5 d-flex justify-content-between">
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
                            <div class="gap-5 d-flex justify-content-between">
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
   
</x-masterLayout>
