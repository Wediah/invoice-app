<x-layout>
    <section class="p-20 flex flex-row mx-auto flex-wrap gap-4">
        @foreach ($companies as $company)
            <a href="{{ route('company.show', ['slug' => $company->slug])}}">
                <div class="flex justify-center items-center bg-gray-100 border-2 rounded-xl p-5">
                    <div class="max-w-sm  overflow-hidden ">
                        <img class="w-full"
                             alt="CardImage" src="{{ asset('storage/company_logo') }}/{{
                                                    $company->logo }}"
                        >
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $company->name }}</div>
                            <p>see more</p>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </section>
</x-layout>
