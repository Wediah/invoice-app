<x-masterLayout :company="$company">
    <div class="container-xxl flex-grow-1 container-p-y">



        <div class="card">
            <div class="pt-0 card-datatable table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="card-header d-flex justify-content-between">
                        <div class="text-center head-label">
                            <h5 class="mb-0 card-title">Company: {{ $company->name }}</h5>
                        </div>

                    </div>
                    <div class="px-4 mb-4 row">
                        <div class="col-sm-12 col-md-6">
                            <div class="dataTables_length" id="DataTables_Table_0_length"><label>Show entries <select
                                        name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"
                                        class="form-select">
                                        <option value="7">7</option>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="75">75</option>
                                        <option value="100">100</option>
                                    </select> </label></div>
                        </div>
                        <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('invoice.create', ['slug' => $company->slug]) }}">
                                    <button type="button" class="btn btn-primary"><i class='bx bx-plus'></i>Add a new
                                        invoice</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <table class="table datatables-basic table-bordered dataTable no-footer dtr-column "
                        id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info"
                        style="width: 1382px;">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Client</th>
                                <th>Total</th>
                                <th class="text-truncate">Issued Date</th>
                                <th class="cell-fit">Due Date</th>
                                <th class="cell-fit">Invoice Status</th>
                                <th class="cell-fit">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($allInvoices as $invoice)
                                <tr class="odd">

                                    <td class="text-center">{{ $invoice->invoice_number }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="avatar-wrapper">
                                                <div class="avatar avatar-sm me-2">
                                                    <span class="avatar-initial rounded-circle bg-label-info">
                                                        {{
                                                            $invoice->customerInfo && $invoice->customerInfo->customer_name
                                                                ? (substr($invoice->customerInfo->customer_name, 0, 1) .
                                                                   substr(strrchr($invoice->customerInfo->customer_name, ' ') ?: ' ', 1, 1))
                                                                : 'N/A'
                                                        }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column"><a
                                                    href="http://127.0.0.1:8000/pages/profile-user"
                                                    class="text-body text-truncate fw-semibold">{{
                                                    $invoice->customerInfo->customer_name ?? 'No Name' }}</a><small
                                                    class="text-truncate text-muted">{{
                                                    $invoice->customerInfo->customer_email ?? 'No Email'}}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"> GHS{{ number_format((float) $invoice->total, 2) }}</td>
                                    <td class="text-center">

                                        {{ $invoice->created_at->format('jS M, Y') }}
                                    </td>
                                    <td class="text-center">

                                       <span data-bs-toggle="tooltip" data-bs-html="true"   data-bs-original-title="{{ $invoice->due_date < now() ? '<span>Past Due Date':'Not Due' }} " class="badge  {{ $invoice->due_date > now() ? 'bg-label-primary' : 'bg-label-danger' }}">
                                        {{ \Carbon\Carbon::parse($invoice->due_date)->format('jS M, Y') }}

                                       </span>
                                    </td>
                                    <td class="text-center">
                                        <span
                                            class="badge  {{ $invoice->status === 'paid' ? 'bg-label-success' : 'bg-label-danger' }}">
                                            {{ $invoice->status }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center">
                                            {{-- <a href="{{ route('invoice.edit', ['slug' => $company->slug, 'id' =>
                                            $invoice->id]) }}"
                                                data-bs-toggle="tooltip" class="text-body" data-bs-placement="top"
                                                title="" data-bs-original-title="Edit Invoice"
                                                aria-label="Edit Invoice">
                                                <i class="bx bx-edit"></i>
                                            </a> --}}

                                            <a href="{{ route('invoice.show', ['slug' => $company->slug, 'id' =>
                                            $invoice->id]) }}"
                                                data-bs-toggle="tooltip" class="text-body" data-bs-placement="top"
                                                title="" data-bs-original-title="Preview Invoice"
                                                aria-label="Preview Invoice"><i class="mx-1 bx bx-show"></i>
                                            </a>
                                            <div class="dropdown">
                                                <a href="javascript:;"
                                                    class="p-0 btn dropdown-toggle hide-arrow text-body"
                                                    data-bs-toggle="dropdown"><i
                                                        class="bx bx-dots-vertical-rounded"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a href="javascript:;" class="dropdown-item">Download
                                                    </a>
                                                    <form action="{{ route('invoice.paid', ['id' => $invoice->id]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure this ' +
                                                       'invoice has been paid?')">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="dropdown-item" type="submit">Paid</button>
                                                    </form>
                                                    <form
                                                        action="{{ route('invoice.unpaid', ['id' => $invoice->id]) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want ' +
                                                   'to mark this invoice as unpaid?')">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button class="dropdown-item" type="submit">Unpaid</button>
                                                    </form>
                                                    <div class="dropdown-divider"></div>
                                                    <form id="deleteForm"
                                                        action="{{ route('invoice.delete', ['id' => $invoice->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn dropdown-item text-danger deleteInvoice">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>




                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="px-4 mt-4 d-flex justify-content-between">
                        <div class="">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status"
                                aria-live="polite">
                                Showing 0 to 0 of 0 entries</div>
                        </div>
                        <div class="">
                            <div class="" id="">
                                <ul class="pagination">
                                    <li class="paginate_button page-item previous disabled"
                                        id="DataTables_Table_0_previous"><a href="#"
                                            aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="0"
                                            class="page-link">Previous</a></li>
                                    <li class="paginate_button page-item next disabled" id="DataTables_Table_0_next">
                                        <a href="#" aria-controls="DataTables_Table_0" data-dt-idx="1"
                                            tabindex="0" class="page-link">Next</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <script>
        document.querySelectorAll('.deleteInvoice').forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the default form submission

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to delete this invoice. Are you sure you want to proceed?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        confirmButton: 'btn btn-warning me-2',
                        cancelButton: 'btn btn-label-secondary'
                    }
                }).then(function(result) {
                    if (result.isConfirmed) { // Use `isConfirmed` to check if confirmed
                        button.closest('form').submit(); // Submit the closest form to the button
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Invoice has been deleted.',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire({
                            title: 'Cancelled',
                            text: 'Deletion cancelled :)',
                            icon: 'error',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    }
                });
            });
        });
    </script>



</x-masterLayout>
