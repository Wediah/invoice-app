<x-masterLayout :company="$company">
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

        <div class="mt-4 mb-6">
            <input
                type="submit"
                class="px-4 py-2 w-full text-white bg-black rounded-lg cursor-pointer hover:bg-blue-800"
                value="Submit"
            >
        </div>
    </form>
</x-masterLayout>
