<div class="max-w-lg p-6 mx-auto">
    <form action="{{ route('company.update', ['slug'=> $company->slug]) }}" method="POST" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <x-form.input name="name" label="Name" value="{{ $company->name }}"/>
        <x-form.input name="email" label="Email" value="{{ $company->email }}"/>
        <x-form.input name="address" label="Address" value="{{ $company->address }}"/>
        <x-form.input name="phone" label="Phone" value="{{ $company->phone }}"/>
        <x-form.input name="logo" label="Logo" type="file" value="{{ $company->logo }}"/>
        <x-form.input name="category" label="Industry" value="{{ $company->category }}"/>

        <div class="mb-6 mt-4">
            <input
                type="submit"
                class="bg-blue-400 text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"
                value="Save Changes"
            >
        </div>
    </form>
</div>
