<x-layout>
    <main class="max-w-lg p-6 mx-auto">
        <h1 class="text-center font-bold text-xl">Invoice</h1>
        <p class="text-sm font-md text-center">Generate a new Invoice</p>
        <form method="POST" action="{{ route('cart.store', ['slug' => $company->slug]) }}" class="mt-10 space-y-6"
              enctype="multipart/form-data">
            @csrf

            <div class="mt-6">
                <label for="catalog_id" class="block text-sm font-medium leading-6 text-gray-900">Item/Service</label>
                <select name="catalog_id" id="catalog_id" class="border border-gray-400 rounded-lg p-2 w-full">
                    @foreach($catalogs as $catalog)
                        <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>
                    @endforeach
                </select>
            </div>
            <x-form.input name="quantity" placeholder="Enter the quantity of your item/service"/>

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
