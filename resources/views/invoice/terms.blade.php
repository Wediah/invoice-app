<x-masterLayout :company="$company">
    <div class="max-w-lg p-6 mx-auto">
        <form action="{{ route('invoice.store_terms', ['slug' => $company->slug]) }}" method="POST">
            @csrf
            <x-form.input name="name" label="Name"/>

            <div class="mb-6 mt-4">
                <input
                    type="submit"
                    class="bg-blue-400 text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"
                    value="Save Changes"
                >
            </div>
        </form>
    </div>
</x-masterLayout>
