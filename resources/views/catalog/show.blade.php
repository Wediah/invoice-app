<x-company-layout :company="$company">
    <section class="p-12">
        <h1>{{ $company->name }}</h1>

{{--        <a href="{{ route('tax.create', ['slug' => $company->slug]) }}">Create taxes</a>--}}
{{--        <a href="{{ route('invoice.show_terms', ['slug' => $company->slug]) }}">Create terms</a>--}}

        <div class="d-flex justify-content-between">
            <span>All Products</span>
            <a href="{{ route('catalog.create', ['company_id' => $company->id]) }}">
                <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>Add an item to your catalog</button>
            </a>
        </div>

        <hr>

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Item/Service</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach ( $companyCatalog as $catalog )
                        <tr>
                            <td> <strong>{{ $catalog->name }}</strong></td>
                            <td>GH₵{{ number_format($catalog->price, 2) }}</td>
                            <td>
                                {{ $catalog->description }}
                            </td>
                            <td><span class="badge bg-label-primary me-1">{{ $catalog->status }}</span></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
{{--                                        <form--}}
{{--                                            action="{{ route('catalog.instock', ['slug' => $company->slug, 'id'--}}
{{--                                            =>$catalog->id]) }}" method="POST" class="dropdown-item"--}}
{{--                                        >--}}
{{--                                            @csrf--}}
{{--                                            @method('PATCH')--}}
{{--                                            <button type="submit">--}}
{{--                                                <i class="bx bx-trash me-1"></i>--}}
{{--                                                Delete--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                        <form--}}
{{--                                            action="{{ route('catalog.outstock', ['slug' => $company->slug, 'id'--}}
{{--                                            =>$catalog->id]) }}" method="POST" class="dropdown-item"--}}
{{--                                        >--}}
{{--                                            @csrf--}}
{{--                                            @method('PATCH')--}}
{{--                                            <button type="submit">--}}
{{--                                                <i class="bx bx-trash me-1"></i>--}}
{{--                                                Delete--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
                                        <a class="dropdown-item" href="{{ route('catalog.edit', ['slug' =>
                                            $company->slug, 'id' => $catalog->id]) }}"
                                        >
                                            <i class="bx bx-edit-alt me-1"></i>
                                            Edit
                                        </a>
                                        <form
                                            action="{{ route('catalog.delete', ['slug' => $company->slug, 'id'
                                            =>$catalog->id]) }}" method="POST" class="dropdown-item"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">
                                                <i class="bx bx-trash me-1"></i>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-company-layout>
