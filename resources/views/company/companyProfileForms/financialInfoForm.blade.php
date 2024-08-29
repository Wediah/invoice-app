<div class="max-w-lg p-6 mx-auto">
    <form action="{{ route('company.financial', ['slug' => $company->slug]) }}" method="POST">
        @csrf
        @method('PATCH')
        <x-form.input name="tax_identification_number" label="Tax Identification Number" value="{{
        $company->tax_identification_number
        }}"/>
        <x-form.input name="currency" label="Currency" value="{{ $company->currency }}"/>
        <x-form.input name="account_number" label="Account number" value="{{ $company->account_number }}"/>
        <x-form.input name="bank_name" label="Bank name" value="{{ $company->bank_name }}"/>
        <x-form.input name="bank_branch" label="Bank branch" value="{{ $company->bank_branch }}"/>
        <x-form.input name="swift_code" label="Swift code" value="{{ $company->swift_code }}"/>
        <x-form.input name="merchant_network" label="Merchant network" value="{{ $company->merchant_network }}"/>
        <x-form.input name="merchant_number" label="Merchant number" value="{{ $company->merchant_number }}"/>
        <x-form.input name="merchant_id" label="Merchant id" value="{{ $company->merchant_id }}"/>
        <x-form.input name="merchant_name" label="Merchant name" value="{{ $company->merchant_name }}"/>

        <div class="mb-6 mt-4">
            <input
                type="submit"
                class="bg-blue-400 text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"
                value="Save Changes"
            >
        </div>
    </form>
</div>
