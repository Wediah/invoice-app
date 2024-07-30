<x-layout>
    <form method="POST" action="{{ route('tax.store', ['slug' => $company->slug]) }}" >
        @csrf
        <x-form.input name="tax_name" placeholder="Enter Tax Name"/>
        <x-form.input name="tax_percentage" placeholder="Enter tax percentage"/>
        <div>
            <label>Type:</label>
            <div>
                <input type="radio" id="primary" name="type" value="primary" required>
                <label for="primary">Primary</label>
            </div>
            <div>
                <input type="radio" id="secondary" name="type" value="secondary" required>
                <label for="secondary">Secondary</label>
            </div>
        </div>

        <div class="mb-6 mt-4">
            <input
                type="submit"
                class="bg-black text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"
                value="Submit"
            >
        </div>
    </form>
</x-layout>
