<x-layout>
    <main class="max-w-lg p-6 mx-auto">
        <h1 class="text-center font-bold text-xl">Invoice {{ $invoice->invoice_number }}</h1>
        <p class="text-sm font-md text-center">Generated on {{ $invoice->created_at->format('Y-m-d') }}</p>


        <p class="text-sm font-md text-center">From {{ $invoice->company->name }}</p>
        <p class="text-sm font-md text-center">To {{ $invoice->customer_name }}</p>
        <h2 class="mt-6 text-lg font-bold">Items:</h2>
        <ul>
            @php
                $taxRate = 0; // Initialize total price variable
                 $totalPrice = 0; // Initialize total price variable
                 $totalTax = 0; // Initialize total tax variable
                $discountRate = $invoice->discount / 100;

            @endphp
            @foreach ($invoice->catalogs as $catalog)
                @php
                    // Calculate subtotal for this catalog item
                    $subtotal = $catalog->pivot->quantity * $catalog->price;

                    // Add subtotal to total price
                    $totalPrice += $subtotal;
                @endphp
                <li>
                    {{ $catalog->name }} - Quantity: {{ $catalog->pivot->quantity }} - Unit Price: GH₵{{
                    number_format($catalog->price, 2) }} - Subtotal: GH₵{{ number_format($subtotal, 2 )}}
                </li>
            @endforeach

            @foreach($invoice->taxes as $tax)
                @php
                    //calculate the taxes
                $taxAmount = $totalPrice * ($tax->tax_percentage / 100);
                $totalTax += $taxAmount; //total tax
                @endphp
                <li>
                    {{ $tax->tax_name }}({{ $tax->tax_percentage}}%): GH₵{{ number_format($taxAmount, 2) }}
                </li>
            @endforeach

            @php
                    // Calculate the discount amount
                    $discountedAmount = $totalPrice * $discountRate;
                    // Calculate the total price after applying the discount
                    $totalPriceAfterDiscount = $totalPrice - $discountedAmount;
                    // Calculate the final total price after adding the tax
                    $finalTotalPrice = $totalPriceAfterDiscount + $totalTax;
            @endphp
        </ul>


        <p>Total Price Before Discount: GH₵{{ number_format($totalPrice, 2) }}</p>
        <p>Discount ({{ $discountRate * 100}}%): -GH₵{{ number_format($discountedAmount, 2) }}</p>
        <p>Total Price After Discount: GH₵{{ number_format($totalPriceAfterDiscount, 2) }}</p>
        <p>Total Tax: GH₵{{ number_format($totalTax, 2) }}</p>
        <p>Final Total Price: GH₵{{ number_format($finalTotalPrice, 2) }}</p>
    </main>
</x-layout>
