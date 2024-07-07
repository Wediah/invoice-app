<x-layout>
    <main class="max-w-lg p-6 mx-auto">
        <h1 class="text-center font-bold text-xl">Company</h1>
        <p class="text-sm font-md text-center">Add a new company</p>
        <form method="POST" action="{{ route('company.store') }}" class="mt-10 space-y-6" enctype="multipart/form-data">
            @csrf

            <x-form.input name="name" placeholder="Enter your name"/>
            <x-form.input name="email" placeholder="Enter your email address"/>
            <x-form.input name="address" placeholder="Enter your address"/>
            <x-form.input name="phone" placeholder="Enter your business phone number"/>
            <x-form.input name="logo" type="file"/>
            <x-form.input name="website" placeholder="Enter your website"/>
            <x-form.input name="description" placeholder="Write a brief description about your company"/>
            <x-form.input name="category" placeholder="Which classification does your company fall into"/>

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
