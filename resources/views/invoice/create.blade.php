<x-layout>
    <main class="max-w-lg p-6 mx-auto">
        <h1 class="text-center font-bold text-xl">Invoice</h1>
        <p class="text-sm font-md text-center">Generate a new Invoice</p>
        <form method="POST" action="{{ route('invoice.store', ['slug' => $company->slug]) }}" class="mt-10 space-y-6"
              enctype="multipart/form-data">
            @csrf

            <div>
                <label for="customer_name" class="block text-sm font-medium leading-6 text-gray-900">Customer Name</label>
                <input type="text" name="customer_name" id="customer_name" class="border border-gray-400 rounded-lg p-2 w-full" required>
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

    //     newItemGroup.querySelector('.remove-item').addEventListener('click', function () {
    //         this.parentNode.remove();
    //     });
    //
    //     itemContainer.appendChild(newItemGroup);
    //
    //
    });
    //
    // document.querySelectorAll('.remove-item').forEach(function (button) {
    //     button.addEventListener('click', function() {
    //         this.parentNode.remove();
    //     });
    // });
</script>
