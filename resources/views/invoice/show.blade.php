<x-masterLayout>
    @section('title', $invoice->customerInfo->customer_name . ' - Invoice')

    @push('styles')
        <style>
            /* Normal styles */

            .font-12 {
                font-size: 12px !important;
            }


            .print-only {
                display: none;
            }



            /* Print styles */
            @media print {
                body {
                    font-size: 12px;
                    background: transparent none;
                    box-shadow: none;
                    width: 100%;
                    height: 100%;
                    border-radius: 0;
                    page-break-inside: avoid;
                    page-break-before: avoid;
                    page-break-after: avoid;
                }

                .print-only {
                    display: block;
                }

                thead {
                    display: table-row-group;
                    /* Forces the thead to behave like part of the table body */
                }

                /* Optionally, you can also control page breaks to improve the print layout */
                table,
                tr,
                td,
                th {
                    page-break-inside: avoid;
                }

                header,
                footer {
                    display: none;
                }

                * {
                    margin: 0;
                    padding: 0;
                    box-shadow: none;
                    page-break-inside: avoid;
                    page-break-before: avoid;
                    page-break-after: avoid;
                }

                .no-print {
                    display: none;
                }

                .page-break {
                    page-break-before: avoid;
                }


                /* water mark effect */
                /* Only apply this style when printing */
                @media print {
                    .watermark {
                        position: fixed;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        opacity: 0.1;
                        /* Semi-transparent */
                        z-index: -1;
                        /* Behind the content */
                        width: 50%;
                        height: auto;
                    }

                    .watermark img {
                        width: 100%;
                        /* Ensures the image scales properly */
                        height: auto;
                    }

                    /* General print settings */
                    .print-only {
                        display: block !important;
                    }

                    /* Hide elements that you don't want in the printout */
                    .no-print {
                        display: none !important;
                    }
                }
            }
        </style>
    @endpush
    <div class="pt-4 container-xxl flex-grow-1 container-p-y no-print">
        <div class="row invoice-preview">
            <div class="mb-4 col-xl-9 col-md-8 col-12 mb-md-0">
                <div class="card invoice-preview-card">
                @include('partials.invoice-details')
                </div>
            </div>

            <!-- /Invoice -->

            <!-- Invoice Actions -->
            <div class="bg-transparent col-xl-3 col-md-4 col-12 invoice-actions no-print">
                <div class="card">
                    <div class="card-body">
                        <button onclick="window.print()" class="mb-3 btn btn-primary d-grid w-100">Download</button>
                        <button onclick="window.print()" class="mb-3 btn btn-secondary d-grid w-100">Print</button>
                        {{-- <a href="{{ route('invoice.edit', ['slug' => $company->slug, 'id' => $invoice->id]) }}"
                            class="mb-3 btn btn-label-secondary d-grid w-100">
                            Edit Invoice
                        </a> --}}
                        <a href="{{ route('invoice.index', ['slug' => $invoice->company->slug]) }}"
                            class="mb-3 btn btn-label-secondary d-grid w-100">
                            All Invoices
                        </a>
                        <a href="{{ route('invoice.create', ['slug' => $invoice->company->slug]) }}"
                            class="mb-3 btn btn-label-secondary d-grid w-100">
                            Create New Invoice
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>
    </div>


    {{-- Print  --}}
    <div class="pt-0 mt-0 print-only">
        @include('partials.invoice-details')

    </div>

</x-masterLayout>
