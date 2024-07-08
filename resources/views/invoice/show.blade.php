<x-layout>
    <main class="max-w-lg p-6 mx-auto">
        <h1 class="text-center font-bold text-xl">Invoice {{ $invoice->invoice_number }}</h1>
        <p class="text-sm font-md text-center">Generated on {{ $invoice->created_at->format('Y-m-d') }}</p>


        <p class="text-sm font-md text-center">From {{ $invoice->company->name }}</p>
        <p class="text-sm font-md text-center">From {{ $invoice->user->name }}</p>
        <h2 class="mt-6 text-lg font-bold">Items:</h2>
        <ul>
            @php
                $taxRate = 0.10; // 10% tax rate (0.10)
                 $totalPrice = 0; // Initialize total price variable
                 $totalTax = 0; // Initialize total tax variable
                $discountRate = 0.05; // 5% discount rate (0.05)

            @endphp
            @foreach ($invoice->catalogs as $catalog)
                @php
                    // Calculate subtotal for this catalog item
                    $subtotal = $catalog->pivot->quantity * $catalog->price;

                    // Calculate tax for this catalog item
                    $tax = $subtotal * $taxRate;
                    $totalTax += $tax; // Accumulate total tax

                    $discountedAmount = $totalPrice * $discountRate; // Calculate discount amount
                    $totalPriceAfterDiscount = $totalPrice - $discountedAmount; // Calculate total price after discount

                    // Add subtotal to total price
                    $totalPrice += $subtotal;
                @endphp
                <li>
                    {{ $catalog->name }} - Quantity: {{ $catalog->pivot->quantity }} - Unit Price: GH₵{{
                    $catalog->price }} - Subtotal: GH₵{{ $subtotal }}
                </li>
            @endforeach
        </ul>


        <h3>Total Invoice Amount: GH₵{{ $totalPrice }}</h3>
        <h3>Tax (10%): GH₵{{ $totalTax }}</h3>
        <h3>Total Invoice Amount (including tax): GH₵{{ $totalPrice + $totalTax }}</h3>
        <h3>Discount (5%): GH₵{{ $discountedAmount }}</h3>
        <h3>Total Invoice Amount (after discount): GH₵{{ $totalPriceAfterDiscount }}</h3>
    </main>
</x-layout>
