<div class="max-w-lg p-6 mx-auto">
    <form action="{{ route('company.preference', ['slug' => $company->slug]) }}" method="POST">
        @csrf
        @method('PATCH')
        <x-form.input name="invoice_prefix" label="Invoice Prefix"  value="{{ $company->invoice_prefix }}"/>
        <x-form.input name="invoice_numbering" label="Last Invoice Number" value="{{ $company->invoice_numbering }}"/>

        <div class="mb-6 mt-4">
            <input
                type="submit"
                class="bg-blue-400 text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"
                value="Save Changes"
            >
        </div>
    </form>
</div>
