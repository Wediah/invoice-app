<x-company-layout :company="$company">
    <section class="p-12">
        <div class="d-flex justify-content-between">
            <span>All Terms</span>
            <a href="{{ route('invoice.show_terms', ['slug' => $company->slug]) }}">
                <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>Add a new payment term</button>
            </a>
        </div>

        <hr>

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($allTerms as $term)
                        <tr>
                            <td> <strong>{{ $term->name }}</strong></td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"
                                        ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                        >
                                        <a class="dropdown-item" href="javascript:void(0);"
                                        ><i class="bx bx-trash me-1"></i> Delete</a
                                        >
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
