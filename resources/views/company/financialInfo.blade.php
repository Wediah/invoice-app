<div class="max-w-lg p-6 mx-auto">
    <form action="{{ route('company.financial', ['slug' => $company->slug]) }}" method="POST">
        @csrf
        @method('PATCH')
        <x-form.input name="bank_details" label="Bank details" value="{{ $company->bank_details }}"/>
        <x-form.input name="currency" label="Currency" value="{{ $company->currency }}"/>
        <x-form.input name="tax_identification_number" label="Tax Identification Number" value="{{
        $company->tax_identification_number
        }}"/>

        <div class="mb-6 mt-4">
            <input
                type="submit"
                class="bg-blue-400 text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"
                value="Save Changes"
            >
        </div>
    </form>
</div>
