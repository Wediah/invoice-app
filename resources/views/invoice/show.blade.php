<x-layout>
    <main class="max-w-lg p-6 shadow-2xl rounded-xl">
        <div class="flex justify-between">
            <div class="flex flex-col text-left">
                <h1 class="font-bold text-2xl">Invoice</h1>
                <h1 class="font-bold text-xl">Invoice No: {{ $invoice->invoice_number }}</h1>
                <p class="text-sm font-md">Generated on: {{ $invoice->created_at->format('Y-m-d') }}</p>
                <p class="text-sm font-md">Term: {{ $invoice->paymentTerms->name }} </p>
                <p class="text-sm font-md">Due on: {{ $invoice->due_date }}</p>
            </div>

            <div class="">
                <img src="{{ asset('storage/company_logo') }}/{{$invoice->company->logo}}" alt="company logo" class="h-20
             w-20 rounded-xl shadow-lg">
            </div>
        </div>

        <div class="flex justify-between pt-8">
            <div class="text-left">
                <h1 class="font-bold text-lg">Company's Address</h1>
                <p class="text-sm font-md">{{ $invoice->company->name }}</p>
                <p class="text-sm font-md">{{ $invoice->company->email}}</p>
                <p class="text-sm font-md">{{ $invoice->company->address }}</p>
                <p class="text-sm font-md">{{ $invoice->company->email }}</p>
                <p class="text-sm font-m">{{ $invoice->company->website }}</p>
                <p class="text-sm font-md">{{ $invoice->company->phone }}</p>
            </div>

            <div class="text-right">
                <h1 class="font-bold text-lg">Customer's Information</h1>
                <p class="text-sm font-md">{{ $invoice->customer_name }}</p>
                <p class="text-sm font-md">{{ $invoice->email }}</p>
                <p class="text-sm font-md">{{ $invoice->address }}</p>
                <p class="text-sm font-md">{{ $invoice->phone }}</p>
                <p class="text-sm font-md">{{ $invoice->fax }}</p>
            </div>
        </div>

        <table class="w-full text-sm text-left rtl:text-right">
            <thead class="text-xs uppercase">
                <tr>
                    <th scope="col" class="px-3 py-3 rounded-s-lg">Product/Service</th>
                    <th scope="col" class="px-6 py-3">Qty</th>
                    <th scope="col" class="px-6 py-3">Unit Price</th>
                    <th scope="col" class="px-3 py-3 rounded-e-lg">Total</th>
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
                    <th class="px-6 py-4 font-medium">{{ $catalog->name }}</th>
                    <th class="px-6 py-4">{{ $catalog->pivot->quantity }}</th>
                    <th class="px-6 py-4">GH₵{{ number_format($catalog->price, 2) }}</th>
                    <th class="px-6 py-4">GH₵{{ number_format($subtotal, 2 )}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
        @php
            // Calculate the discount amount
            $discountedAmount = $totalPrice * $discountRate;
            // Calculate the total price after applying the discount
            $totalPriceAfterDiscount = $totalPrice - $discountedAmount;
            // Calculate the final total price after adding the tax
            $finalTotalPrice = $totalPriceAfterDiscount + $totalTax;
        @endphp
        <div class="flex flex-col gap-2 text-right justify-end">
            <hr/>
            <p>Total: GH₵{{ number_format($totalPrice, 2) }}</p>
            <p>Discount Applied ({{ $discountRate * 100}}%): -GH₵{{ number_format($discountedAmount, 2) }}</p>
            <p>Total After Discount: GH₵{{ number_format($totalPriceAfterDiscount, 2) }}</p>
            <ul>
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
                    <li>
                        @if($tax->type == 'PRIMARY')
                            {{ $tax->tax_name }}({{ $tax->tax_percentage}}%): GH₵{{ number_format($primaryTax, 2) }}
                        @else
                            {{ $tax->tax_name }}({{ $tax->tax_percentage}}%): GH₵{{ number_format($secondaryTax, 2) }}
                        @endif

                    </li>
                @endforeach
            </ul>
    {{--        <p>Total Tax: GH₵{{ number_format($totalTax, 2) }}</p>--}}
            <p>Total Price To Paid: GH₵{{ number_format($finalTotalPrice, 2) }}</p>
        </div>
    </main>
    <a href="{{ route('invoice.download_pdf', ['id' => $invoice->id]) }}">download</a>

    <div class="container-xxl flex-grow-1 container-p-y">
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
                                <h4>Invoice #3492</h4>
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
                    <div class="table-responsive mx-auto">
                        <table class="table border-top m-0">
                            <thead>
                            <tr>
                                <th>Item/Service</th>
                                <th>QTY</th>
                                <th>Unit</th>
                                <th>Price</th>
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
                                    <th class="text-nowrap">{{ $catalog->name }}</th>
                                    <th>{{ $catalog->pivot->quantity }}</th>
                                    <th>GH₵{{ number_format($catalog->price, 2) }}</th>
                                    <th>GH₵{{ number_format($subtotal, 2 )}}</th>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3" class="align-top px-4 py-5">
                                    <p class="mb-2">
                                        <span class="me-1 fw-semibold">Salesperson:</span>
                                        <span>{{ $user->first_name }}</span>
                                    </p>
                                </td>
                                <td class="px-4 py-5">
                                    <div class="d-flex gap-4">
                                        <p>Subtotal:</p>
                                        <p class="fw-semibold mb-2">GH₵{{ number_format($totalPrice, 2) }}</p>
                                    </div>
                                    <div class="d-flex gap-4">
                                        <p>Discount:</p>
                                        <p class="fw-semibold mb-2">GH₵{{ number_format($discountedAmount, 2) }}</p>
                                    </div>
                                    <ul>
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
                                            <li class="fw-semibold mb-2">
                                                @if($tax->type == 'PRIMARY')
                                                    {{ $tax->tax_name }}({{ $tax->tax_percentage}}%): GH₵{{ number_format($primaryTax, 2) }}
                                                @else
                                                    {{ $tax->tax_name }}({{ $tax->tax_percentage}}%): GH₵{{ number_format($secondaryTax, 2) }}
                                                @endif

                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="d-flex gap-4">
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
                        <button class="btn btn-label-secondary d-grid w-100 mb-3">Download</button>
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
