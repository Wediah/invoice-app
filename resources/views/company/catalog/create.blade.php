<x-masterLayout :company="$company">
    <main class="max-w-lg p-6 mx-auto">
        <h1 class="text-center font-bold text-xl">Catalog</h1>
        <p class="text-sm font-md text-center">Add a new catalog</p>
        <form method="POST" action="{{ route('catalog.store', ['company_id' => $company->id]) }}" class="mt-10 space-y-6"
              enctype="multipart/form-data">
            @csrf

            <x-form.input name="name" placeholder="Enter the name of your item/service"/>
            <x-form.input name="description" placeholder="Describe your item/service"/>
            <x-form.input name="price" placeholder="Enter your price"/>
{{--            <x-form.input name="catalog_images[]" type="file" multiple="" accept="image/png, image/jpeg, image/jpg"/>--}}

            <div class="mb-6 mt-4">
                <input
                    type="submit"
                    class="bg-black text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"
                    value="Submit"
                >
            </div>

        </form>
    </main>
</x-masterLayout>
