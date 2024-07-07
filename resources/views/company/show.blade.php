<x-layout>
    <section class="p-12">
        <h1>{{ $company->name }}</h1>
        <a href="{{ route('catalog.create', ['company_id' => $company->id]) }}">Add an item to your catalog</a>
        <a href="{{ route('invoice.create', ['slug' => $company->slug]) }}">Create invoice</a>
        <div class="flex flex-row mx-auto flex-wrap gap-4">
            @foreach ( $companyCatalog as $catalog )
                <div class="flex justify-center items-center bg-gray-100 border-2 rounded-xl p-5">
                    <div class="max-w-sm  overflow-hidden ">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ $catalog->name }}</div>
                            <div class="font-bold text-xl mb-2">{{ $catalog->price }}</div>
                            <div class="font-bold text-xl mb-2">{{ $catalog->status }}</div>
                            <div class="font-bold text-xl mb-2">{{ $catalog->description }}</div>
                        </div>
{{--                        <form action="{{ route('cart.store') }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <input type="hidden" name="user_id" value="{{ $user->id }}">--}}
{{--                            <input type="hidden" name="item_id" value="{{ $catalog->id }}">--}}
{{--                            <input type="hidden" name="company_id" value="{{ $company->id }}">--}}
{{--                            <input type="hidden" name="quantity" value="1">--}}
{{--                            <button type="submit" class="add-to-cart-btn">Add to Cart</button>--}}
{{--                        </form>--}}
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-layout>
