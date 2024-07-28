<x-layout>
    <section class="p-12">
        <h1>{{ $company->name }}</h1>
        <a href="{{ route('catalog.create', ['company_id' => $company->id]) }}">Add an item to your catalog</a>
        <a href="{{ route('invoice.create', ['slug' => $company->slug]) }}">Create invoice</a>
        <a href="{{ route('tax.create', ['slug' => $company->slug]) }}">Create taxes</a>
        <a href="{{ route('company.profile', ['slug' => $company->slug]) }}">Profile</a>
{{--        <a href="{{ route('tax.create', ['slug' => $company->slug]) }}">Create terms</a>--}}
        <div class="flex flex-row mx-auto flex-wrap gap-4">
            @foreach ( $companyCatalog as $catalog )
                <div class="flex justify-center items-center bg-gray-100 border-2 rounded-xl p-5">
                    <div class="max-w-sm  overflow-hidden ">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $catalog->name }}</div>
                            <div class="font-bold text-xl mb-2">GH₵{{ number_format($catalog->price, 2) }}</div>
                            <div class="font-bold text-xl mb-2">{{ $catalog->status }}</div>
                            <div class="font-bold text-xl mb-2">{{ $catalog->description }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-layout>
