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
                            <td></td>
                            <td>{{ $invoice->created_at->format('d/m/Y') }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
