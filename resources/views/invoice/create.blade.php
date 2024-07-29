<x-layout>
    <main class="max-w-lg p-6 mx-auto">
        <h1 class="text-center font-bold text-xl">Invoice</h1>
        <p class="text-sm font-md text-center">Generate a new Invoice</p>
        <form method="POST" action="{{ route('invoice.store', ['slug' => $company->slug]) }}" class="mt-10 space-y-6"
              enctype="multipart/form-data">
            @csrf

            <div class="flex flex-row gap-6">
                <div>
                    <h1>From</h1>
                    <x-form.input name="name" disabled label="Name" placeholder="Enter customer name" value="{{
                    $company->name
                    }}"></x-form.input>
                    <x-form.input name="email" disabled label="Email" placeholder="Enter email" value="{{ $company->email
                    }}"></x-form.input>
                    <x-form.input name="address" disabled label="Address" placeholder="Enter address" value="{{
                    $company->address }}"></x-form.input>
                    <x-form.input name="phone" disabled label="Phone" placeholder="Enter phone number" value="{{ $company->phone
                    }}"></x-form.input>
                    <x-form.input name="mobile" disabled label="Mobile" placeholder="Enter mobile number"></x-form.input>
                    <x-form.input name="fax" disabled label="Fax" placeholder="Enter fax number"></x-form.input>
                </div>
                <div>
                    <h1>To</h1>
                    <x-form.input name="customer_name" label="Name" placeholder="Enter customer name"></x-form.input>
                    <x-form.input name="email" label="Email" placeholder="Enter email"></x-form.input>
                    <x-form.input name="address" label="Address" placeholder="Enter address"></x-form.input>
                    <x-form.input name="phone" label="Phone" placeholder="Enter phone number"></x-form.input>
                    <x-form.input name="mobile" label="Mobile" placeholder="Enter mobile number"></x-form.input>
                    <x-form.input name="fax" label="Fax" placeholder="Enter fax number"></x-form.input>
                </div>
            </div>


            <div class="mt-6">
                <label for="term_id" class="block text-sm font-medium leading-6 text-gray-900">Payment Term</label>
                <div class="mt-2">
                    <select name="term_id" class="border border-gray-400 rounded-lg p-2 w-full">
                        @foreach($company->paymentTerms as $terms)
                            <option value="{{ $terms->id }}">{{ $terms->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div id="itemContainer">
                <div class="flex flex-row gap-3 items-center item-group">
                    <div class="mt-6">
                        <label for="catalog_id" class="block text-sm font-medium leading-6 text-gray-900">Item/Service</label>
                        <div class="mt-2">
                            <select name="catalog_id[]" class="catalog_id border border-gray-400 rounded-lg p-2 w-full">
                                @foreach($catalogs as $catalog)
                                    <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <x-form.input name="quantity[]" placeholder="Enter the quantity " class="quantity"/>
{{--                    <button type="button" class="remove-item bg-red-500 text-white rounded-lg px-2 py-1">Remove</button>--}}
                </div>
            </div>

            <div class="mb-6 mt-4">
                <input
                    type="button"
                    id="addItem"
                    class="bg-black text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"
                    value="Add another item"
                >
            </div>

            <div id="taxContainer">
                <div class="flex flex-row gap-3 items-center tax-group">
                    <div class="mt-6">
                        <label for="tax_id" class="block text-sm font-medium leading-6 text-gray-900">Tax</label>
                        <div class="mt-2">
                            <select name="tax_id[]" class="tax_id border border-gray-400 rounded-lg p-2 w-full">
                                @foreach($taxes as $tax)
                                    <option value="{{ $tax->id }}">{{ $tax->tax_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{--                    <button type="button" class="remove-item bg-red-500 text-white rounded-lg px-2 py-1">Remove</button>--}}
                </div>
            </div>

            <div class="mb-6 mt-4">
                <input
                    type="button"
                    id="addTax"
                    class="bg-black text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"
                    value="Add another tax"
                >
            </div>

            <x-form.input name="discount" placeholder="Enter discount" class="discount"/>

            <div class="mb-6 mt-4">
                <input
                    type="submit"
                    class="bg-black text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"
                    value="Submit"
                >
            </div>
        </form>
    </main>
</x-layout>

<script>
    document.getElementById('addItem').addEventListener('click', function () {
        var itemContainer = document.getElementById('itemContainer');
        var itemGroup = document.querySelector('.item-group');
        var newItemGroup = itemGroup.cloneNode(true);

        // Clear the values of the cloned elements
        var selects = newItemGroup.getElementsByTagName('select');
        for (var i = 0; i < selects.length; i++) {
            selects[i].selectedIndex = 0;
        }

        var inputs = newItemGroup.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type === 'text') {
                inputs[i].value = '';
            }
        }

        if (!newItemGroup.querySelector('.remove-item')) {
            var removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'remove-item bg-red-500 text-white rounded-lg px-2 py-1';
            removeButton.textContent = 'Remove';
            removeButton.addEventListener('click', function() {
                this.parentNode.remove();
            });
            newItemGroup.appendChild(removeButton);
        }

        itemContainer.appendChild(newItemGroup);
    });

    document.getElementById('addTax').addEventListener('click', function () {
        var taxContainer = document.getElementById('taxContainer');
        var taxGroup = document.querySelector('.tax-group');
        var newTaxGroup = taxGroup.cloneNode(true);

        // Clear the values of the cloned elements
        var selects = newTaxGroup.getElementsByTagName('select');
        for (var i = 0; i < selects.length; i++) {
            selects[i].selectedIndex = 0;
        }

        var inputs = newTaxGroup.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type === 'text') {
                inputs[i].value = '';
            }
        }

        if (!newTaxGroup.querySelector('.remove-tax')) {
            var removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'remove-tax bg-red-500 text-white rounded-lg px-2 py-1';
            removeButton.textContent = 'Remove';
            removeButton.addEventListener('click',
                function() {
                    this.parentNode.remove();
            });
            newTaxGroup.appendChild(removeButton);
        }

        taxContainer.appendChild(newTaxGroup);
    });
</script>
