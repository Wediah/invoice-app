<x-masterLayout>
<main class="max-w-lg p-6 mx-auto">
    <h1 class="text-center font-bold text-xl">Company Category</h1>
    <p class="text-sm font-md text-center">Add a new category</p>
    <form method="POST" action="{{ route('company.category.store') }}" class="mt-10 space-y-6"
          enctype="multipart/form-data">
        @csrf

        <x-form.input name="name" placeholder="Enter the name of your item/service"/>

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
