<div class="max-w-lg p-6 mx-auto">
    <form action="{{ route('company.info',['slug'=>$company->slug]) }}" method="POST">
        @csrf
        @method('PATCH')
        <x-form.input name="registration_number" label="Registration Number" value="{{ $company->registration_number
        }}"/>
        <x-form.input name="description" label="Company Description" value="{{ $company->description }}"/>
        <x-form.input name="website" label="Company Website" value="{{ $company->website }}"/>
        <x-form.input name="instagram" label="instagram" value="{{ $company->instagram }}"/>
        <x-form.input name="twitter" label="X(twitter)" value="{{ $company->twitter }}"/>
        <x-form.input name="facebook" label="Facebook" value="{{ $company->facebook }}"/>
        <x-form.input name="tiktok" label="tiktok" value="{{ $company->tiktok }}"/>
        <x-form.input name="linkedin" label="LinkedIn" value="{{ $company->linkedin }}"/>

        <div class="mb-6 mt-4">
            <input
                type="submit"
                class="bg-blue-400 text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"
                value="Save Changes"
            >
        </div>
    </form>
</div>
