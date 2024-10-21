<div class="card-body">
    <div class="p-sm-3 row">
        <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0">
            <img src="{{ asset('storage/company_logo') }}/{{ $invoice->company->logo }}" alt="company logo"
                class="w-20 h-20 rounded" style="width: auto; height: 150px;">
        </div>
        <div class="col-xl-6 col-md-12 col-sm-7 col-12 text-end font-12">
            <span class="mb-2 app-brand-text h6 fw-bold">{{ $invoice->company->name }}</span>
            <p class="mb-1">{{ $invoice->company->email }}</p>
            <p class="mb-1">{{ $invoice->company->address }}</p>
            <p class="mb-1">{{ $invoice->company->website }}</p>
            <p class="mb-0">{{ $invoice->company->phone }}</p>
        </div>
    </div>


</div>
<hr class="my-0" />
<div class="card-body">
    <div class="p-0 rounded row p-sm-3" style="background: #f3f4f4;">
        <div class="mb-4 col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 font-12">
            <h6 class="pb-2">Invoice To:</h6>
            <p class="mb-1">{{ $invoice->customerInfo->customer_name }}</p>
            <p class="mb-1">{{ $invoice->customerInfo->customer_email }}</p>
            <p class="mb-1">{{ $invoice->customerInfo->customer_address }}</p>
            <p class="mb-1">{{ $invoice->customerInfo->customer_mobile }}</p>
        </div>
        <div class="col-xl-6 col-md-12 col-sm-7 col-12 text-end font-12">
            <h6 class="pb-2">Invoice Details:</h6>
            <p class="mb-1">Invoice Number: {{ $invoice->invoice_number }}</p>
            <p class="mb-1">Issue Date: {{ $invoice->created_at->format('Y-m-d') }}</p>
            <p class="mb-1">Due Date: {{ $invoice->due_date }}</p>
        </div>
    </div>
</div>
<div class="px-4 table-responsive">
    <table class="table font-12">
        <thead>
            <tr>
                <th scope="col-4">Item/Service</th>
                <th scope="col-2">QTY</th>
                <th scope="col-2">UOM</th>
                <th scope="col-3">Unit</th>
                <th scope="col-3">Cost</th>
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
                {{-- @php
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
                @endphp --}}
                <tr>
                    <td class="text-nowrap col-4 " scope="row">
                        <strong>{{ $catalog->name }}</strong>
                    </td>
                    <td class="col-2">{{ $catalog->pivot->quantity }}</td>
                    <td class="col-2">{{ $catalog->unit_of_measurement }}</td>
                    <td class="col-3">
                        {{ $company->currency ?? 'GHS' }}&nbsp;{{ number_format($catalog->price, 2) }}
                    </td>
                    <td class="col-3">
                        {{ $company->currency ?? 'GHS' }}&nbsp;{{ number_format($catalog->pivot->total, 2) }}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <div class="d-flex justify-content-between font-12">

        <div class="px-4 py-5 align-top">
            <p class="mb-2">
                <span class="me-1 fw-semibold">Salesperson:</span>
                <span>{{ $invoice->salesperson }}</span>
            </p>
        </div>
        <div class="px-4 py-5">
            <div class="gap-5 d-flex justify-content-between">
                <p>Subtotal:</p>
                <span
                    class="mb-2 fw-semibold">{{ $company->currency ?? 'GHS' }}&nbsp;{{ number_format($invoice->subtotal, 2) }}</span>
            </div>
            <div class="gap-5 d-flex justify-content-between">
                <p>Discount:</p>
                <p class="mb-2 fw-semibold">
                    {{ $company->currency ?? 'GHS' }}&nbsp;{{ number_format($invoice->discount_total, 2) }}
                </p>
            </div>
            {{-- <div class="gap-5 d-flex justify-content-between">
                           <p>Tax(es)</p>
                           <p class="mb-2 fw-semibold"></p>
                       </div> --}}
            <div>
                {{-- @foreach ($invoice->taxes as $tax)
                    @php
                        //calculate the taxes
                        if ($tax->type === 'PRIMARY') {
                            $primaryTax = $totalPrice * ($tax->tax_percentage / 100);
                            $totalPrimaryTax += $primaryTax;
                        } else {
                            $secondaryTax = ($totalPrimaryTax + $totalPrice) * ($tax->tax_percentage / 100);
                            $totalSecondaryTax += $secondaryTax;
                        }

                        //total tax
                        $totalTax = $totalPrimaryTax + $totalSecondaryTax;
                    @endphp
                    <div class="gap-5 d-flex justify-content-between">
                        @if ($tax->type == 'PRIMARY')
                            <p>{{ $tax->tax_name }} ({{ $tax->tax_percentage }}%):</p>
                            <p class="mb-2 fw-semibold">
                                {{ $company->currency ?? 'GHS' }}&nbsp;{{ number_format($primaryTax, 2) }}
                            </p>
                        @elseif ($tax->type == 'SECONDARY')
                            <p>{{ $tax->tax_name }} ({{ $tax->tax_percentage }}%):</p>
                        @endif
                    </div>
                @endforeach --}}
              
                <div class="gap-5 ">
                    <p class="fw-bold underline mb-0">Taxes</p>
                    @foreach ($invoice->taxes->sortBy('type') as $tax)
                    <div class="d-flex justify-content-between mb-0">
                        <p class="mb-0">{{ $tax->tax_name }} :</p>

                        <p class="mb-0 fw-semibold"> {{ $company->currency ?? 'GHS' }} {{ number_format($tax->pivot->tax_amount, 2) }}</p>
                    </div>
             
                @endforeach
                   
                </div>
            </div>
            @php
                // Calculate the final total price after adding the tax
                $finalTotalPrice = $totalPrice + $totalTax;
            @endphp
            <div class="gap-5 d-flex justify-content-between mt-3">
                <p class="mb-0 ">Total:</p>
                <p><strong> {{ $company->currency ?? 'GHS' }} {{ number_format($invoice->final_total, 2) }}</strong></p>

            </div>
        </div>


    </div>
</div>

<div class="card-body">
    <div class="row">
        <div class="col-12">
            <span class="fw-semibold">Note:</span>
            <span>{{ $invoice->notes }}</span>
        </div>
    </div>
</div>
