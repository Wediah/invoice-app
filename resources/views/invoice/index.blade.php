<x-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Invoice /</span> List</h4>

        <!-- Invoice List Table -->
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="invoice-list-table table border-top">
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
                        @foreach($allInvoices as $invoice)
                        <tr>
                            <td></td>
                            <td>{{ $invoice->invoice_number }}</td>
                            <td></td>
                            <td>{{ $invoice->customer_name }}</td>
                            <td> GH¢{{ number_format((float)$invoice->total, 2) }}</td>
                            <td>{{ $invoice->created_at->format('d/m/Y') }}</td>
                            <td> GH¢{{ number_format((float)$invoice->balance, 2) }}</td>
                            <td>{{ $invoice->status }}</td>
                            <td>
                                <div class="d-flex gap-2 items-center">
                                    <i class='bx bx-edit'></i>
                                    <form action="{{ route('invoice.delete', ['id' => $invoice->id]) }}"
                                          method="POST" onsubmit="return confirm('Are you sure you want to delete ' +
                                           'this invoice?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn "><i class='bx
                                        bx-trash'
                                            ></i></button>
                                    </form>
                                    <i class='bx bx-dots-vertical-rounded' ></i>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
