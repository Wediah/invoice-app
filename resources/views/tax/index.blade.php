<x-company-layout :company="$company">
    <section class="p-12">
        <div class="d-flex justify-content-between">
            <span>All Taxes</span>
            <a href="{{ route('tax.create', ['slug' => $company->slug]) }}">
                <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>Add a new tax</button>
            </a>
        </div>

        <hr>

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Tax</th>
                        <th>Percentage</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach ( $taxes as $tax )
                        <tr>
                            <td> <strong>{{ $tax->tax_name }}</strong></td>
                            <td>{{ $tax->tax_percentage }}%</td>
                            <td><span class="badge bg-label-primary me-1">{{ $tax->type }}</span></td>
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
