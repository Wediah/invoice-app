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
                            <td>
                                <span class="rounded-pill text-light px-2 p-1 fs-6 {{ $invoice->status === 'paid' ?
                                'bg-success' :  'bg-danger'  }}">
                                    {{ $invoice->status }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2 items-center">
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
                                            <li><button class="dropdown-item" type="button">Duplicate</button></li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('invoice.edit', ['id' =>
                                                $invoice->id]) }}">
                                                    Edit
                                                </a>
                                            </li>
                                            <hr/>
                                            <li>
                                                <form action="{{ route('invoice.delete', ['id' => $invoice->id]) }}"
                                                  method="POST" onsubmit="return confirm('Are you sure you want to ' +
                                                   'delete ' + 'this invoice?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn dropdown-item
                                                    text-danger">Delete</button>
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
            </div>
        </div>
    </div>
</x-layout>
