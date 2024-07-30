<x-layout>
    <main class="max-w-lg p-6 mx-auto shadow-2xl rounded-xl">
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
{{--                <li>--}}
{{--                    {{ $catalog->name }} - Quantity: {{ $catalog->pivot->quantity }} - Unit Price: GH₵{{--}}
{{--                    number_format($catalog->price, 2) }} - Subtotal: GH₵{{ number_format($subtotal, 2 )}}--}}
{{--                </li>--}}
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
</x-layout>
