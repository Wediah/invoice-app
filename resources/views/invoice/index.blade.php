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
                                <th></th>
                                <th>#ID</th>
                                <th><i class='bx bx-trending-up'></i></th>
                                <th>Client</th>
                                <th>Total</th>
                                <th class="text-truncate">Issued Date</th>
                                <th>Balance</th>
                                <th>Invoice Status</th>
                                <th class="cell-fit">Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($allInvoices as $invoice)
                                <tr class="odd">
                                    <td></td>

                                    <td>{{ $invoice->invoice_number }}</td>
                                    <td></td>

                                    <td>{{ $invoice->customer_name }}</td>
                                    <td> GH¢{{ number_format((float) $invoice->total, 2) }}</td>
                                    <td><span class="badge bg-label-primary me-1">{{ $invoice->status }}</span></td>
                                    <td>{{ $invoice->created_at->format('d/m/Y') }}</td>
                                    <td> GH¢{{ number_format((float) $invoice->balance, 2) }}</td>
                                    <td>
                                        <span
                                            class="rounded-pill text-light px-2 p-1 fs-6 {{ $invoice->status === 'paid' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $invoice->status }}
                                        </span>
                                    </td>



                                    <td>
                                        <div class="items-center gap-2 d-flex">
                                            <i class='bx bx-send'></i>
                                            <a href="{{ route('invoice.show', ['id' => $invoice->id]) }}">
                                                <i class='bx bx-show'></i>
                                            </a>
                                            <div class="btn-group">
                                                <button type="button" class="" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class='bx bx-dots-vertical-rounded' ></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <form action="{{ route('invoice.paid', ['id' => $invoice->id]) }}"
                                                              method="POST" onsubmit="return confirm('Are you sure this ' +
                                                               'invoice has been paid?')">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button class="dropdown-item" type="submit">Paid</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="{{ route('invoice.unpaid', ['id' => $invoice->id]) }}"
                                                              method="POST" onsubmit="return confirm('Are you sure you want ' +
                                                               'to mark this invoice as unpaid?')">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button class="dropdown-item" type="submit">Unpaid</button>
                                                        </form>
                                                    </li>
                                                    <li><button class="dropdown-item" type="button">Download</button></li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('invoice.edit', ['id' =>
                                                        $invoice->id]) }}">
                                                            Edit
                                                        </a>
                                                    </li>
                                                    <hr/>
                                                    <li>
                                                        <form id="deleteForm" action="{{ route('invoice.delete',
                                                        ['id'
                                                         =>
                                                        $invoice->id]) }}"
                                                          method="POST" >
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn dropdown-item
                                                            text-danger deleteInvoice">Delete</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <div class="px-4 mt-4 d-flex justify-content-between">
                        <div class="">
                            <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
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


</x-masterLayout>


<script>
    document.querySelector('.deleteInvoice').addEventListener('click', function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to delete this invoice. Are you sure you want to proceed?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            customClass: {
            confirmButton: 'btn btn-warning me-2',
            cancelButton: 'btn btn-label-secondary'
        },
        }).then(function (result) {
                if (result.value) {
                    document.getElementById('deleteForm').submit();
                    Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Invoice has been deleted.',
                    customClass: {
                    confirmButton: 'btn btn-success'
                }});
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire({
                    title: 'Cancelled',
                    text: 'Cancelled Suspension :)',
                    icon: 'error',
                    customClass: {
                    confirmButton: 'btn btn-success'
                }});
            }
        });
    });
</script>
