<x-layout>
{{--    <main >--}}
{{--        <form method="POST" action="{{ route('invoice.store', ['slug' => $company->slug]) }}" class="mt-10 space-y-6"--}}
{{--              enctype="multipart/form-data">--}}
{{--            @csrf--}}

{{--            <div class="container-xxl flex-grow-1 container-p-y">--}}
{{--                <div class="row invoice-add">--}}
{{--                    <div class="container-xxl flex-grow-1 container-p-y">--}}
{{--                        <div class="flex flex-row justify-between">--}}
{{--                            <div class="col-md-6 mb-md-0 mb-4">--}}
{{--                                <div class="d-flex svg-illustration mb-4 gap-2 align-items-baseline">--}}
{{--                                    <img src="{{ asset('storage/company_logo') }}/{{$company->logo}}" alt="company logo"--}}
{{--                                         class="h-16 w-16 rounded-xl shadow-lg"--}}
{{--                                    >--}}
{{--                                    <span class="app-brand-text h3 mb-0 fw-bold">{{ $company->name }}</span>--}}
{{--                                </div>--}}
{{--                                <p class="mb-1">{{ $company->address }}</p>--}}
{{--                                <p class="mb-0">{{ $company->phone }}</p>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <dl class="row mb-2">--}}
{{--                                    <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">--}}
{{--                                        <span class="h4 text-capitalize mb-0 text-nowrap">Invoice #</span>--}}
{{--                                    </dt>--}}
{{--                                    <dd class="col-sm-6 d-flex justify-content-md-end">--}}
{{--                                        <div class="w-px-150">--}}
{{--                                            <input--}}
{{--                                                type="text"--}}
{{--                                                class="form-control rounded w-100"--}}
{{--                                                disabled--}}
{{--                                                placeholder="3905"--}}
{{--                                                value="{{ $invoiceNumber }}"--}}
{{--                                                id="invoiceId"--}}
{{--                                            />--}}
{{--                                        </div>--}}
{{--                                    </dd>--}}
{{--                                    <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">--}}
{{--                                        <span class="fw-normal">Date:</span>--}}
{{--                                    </dt>--}}
{{--                                    <dd class="col-sm-6 d-flex justify-content-md-end">--}}
{{--                                        <div class="w-px-150">--}}
{{--                                            <input type="date" class="form-control date-picker w-100 rounded" disabled--}}
{{--                                                   placeholder="YYYY-MM-DD"--}}
{{--                                                   value="{{ date('Y-m-d') }}" />--}}
{{--                                        </div>--}}
{{--                                    </dd>--}}
{{--                                    <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">--}}
{{--                                        <span class="fw-normal">Due Date:</span>--}}
{{--                                    </dt>--}}
{{--                                    <dd class="col-sm-6 d-flex justify-content-md-end">--}}
{{--                                        <div class="w-px-150">--}}
{{--                                            <input type="date" name="due-date" class="form-control date-picker w-100 rounded"--}}
{{--                                                   placeholder="YYYY-MM-DD" />--}}
{{--                                        </div>--}}
{{--                                    </dd>--}}
{{--                                </dl>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="flex flex-row gap-6">--}}
{{--                            <div>--}}
{{--                                <h1>From</h1>--}}
{{--                                <x-form.input name="name" disabled label="Name" placeholder="Enter customer name" value="{{--}}
{{--                                $company->name--}}
{{--                                }}"></x-form.input>--}}
{{--                                <x-form.input name="email" disabled label="Email" placeholder="Enter email" value="{{ $company->email--}}
{{--                                }}"></x-form.input>--}}
{{--                                <x-form.input name="address" disabled label="Address" placeholder="Enter address" value="{{--}}
{{--                                $company->address }}"></x-form.input>--}}
{{--                                <x-form.input name="phone" disabled label="Phone" placeholder="Enter phone number" value="{{ $company->phone--}}
{{--                                }}"></x-form.input>--}}
{{--            --}}{{--                    <x-form.input name="mobile" disabled label="Mobile" value="{{ $company->mobile }}"></x-form--}}
{{--            --}}{{--                        .input>--}}
{{--            --}}{{--                    <x-form.input name="fax" disabled label="Fax" placeholder="Enter fax number"></x-form.input>--}}
{{--                            </div>--}}
{{--                            <div>--}}
{{--                                <h1>To</h1>--}}
{{--                                <x-form.input name="customer_name" label="Name" placeholder="Enter customer name"></x-form.input>--}}
{{--                                <x-form.input name="email" label="Email" placeholder="Enter email"></x-form.input>--}}
{{--                                <x-form.input name="address" label="Address" placeholder="Enter address"></x-form.input>--}}
{{--                                <x-form.input name="phone" label="Phone" placeholder="Enter phone number"></x-form.input>--}}
{{--                                <x-form.input name="mobile" label="Mobile" placeholder="Enter mobile number"></x-form.input>--}}
{{--                                <x-form.input name="fax" label="Fax" placeholder="Enter fax number"></x-form.input>--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                        <div class="mt-6">--}}
{{--                            <label for="term_id" class="block text-sm font-medium leading-6 text-gray-900">Payment Term</label>--}}
{{--                            <div class="mt-2">--}}
{{--                                <select name="term_id" class="border border-gray-400 rounded-lg p-2 w-full">--}}
{{--                                    @foreach($company->paymentTerms as $terms)--}}
{{--                                        <option value="{{ $terms->id }}">{{ $terms->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div id="itemContainer">--}}
{{--                            <div class="flex flex-row gap-3 items-center item-group">--}}
{{--                                <div>--}}
{{--                                    <label for="catalog_id" class="block text-sm font-medium leading-6 text-gray-900">Item/Service</label>--}}
{{--                                    <div class="mt-2">--}}
{{--                                        <select name="catalog_id[]" class="catalog_id border border-gray-400 rounded-lg p-2 w-full">--}}
{{--                                            @foreach($catalogs as $catalog)--}}
{{--                                                <option value="{{ $catalog->id }}">{{ $catalog->name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <x-form.input name="quantity[]" placeholder="Enter the quantity " class="quantity"/>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="mb-6 mt-4">--}}
{{--                            <input--}}
{{--                                type="button"--}}
{{--                                id="addItem"--}}
{{--                                class="bg-blue-400 text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"--}}
{{--                                value="Add another item"--}}
{{--                            >--}}
{{--                        </div>--}}

{{--                        <div id="taxContainer">--}}
{{--                            <div class="flex flex-row gap-3 items-center tax-group">--}}
{{--                                <div class="mt-6">--}}
{{--                                    <label for="tax_id" class="block text-sm font-medium leading-6 text-gray-900">Tax</label>--}}
{{--                                    <div class="mt-2">--}}
{{--                                        <select name="tax_id[]" class="tax_id border border-gray-400 rounded-lg p-2 w-full">--}}
{{--                                            @foreach($taxes as $tax)--}}
{{--                                                <option value="{{ $tax->id }}">{{ $tax->tax_name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                --}}{{--                    <button type="button" class="remove-item bg-red-500 text-white rounded-lg px-2 py-1">Remove</button>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="mb-6 mt-4">--}}
{{--                            <input--}}
{{--                                type="button"--}}
{{--                                id="addTax"--}}
{{--                                class="bg-blue-400 text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"--}}
{{--                                value="Add another tax"--}}
{{--                            >--}}
{{--                        </div>--}}

{{--                        <x-form.input name="discount" placeholder="Enter discount" label="Discount" class="discount"/>--}}

{{--                        <div class="flex flex-col gap-4">--}}
{{--                            <label for="notes">Note</label>--}}
{{--                            <textarea name="notes" id="notes" cols="30" rows="4" placeholder="Enter something worth noting."--}}
{{--                                      class="rounded-xl"--}}
{{--                            ></textarea>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                    <div class="col-lg-3 col-12 invoice-actions">--}}
{{--                        <div class="mb-6 mt-4">--}}
{{--                            <input--}}
{{--                                type="submit"--}}
{{--                                class="bg-blue-400 text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"--}}
{{--                                value="Submit"--}}
{{--                            >--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </main>--}}

    <div class="container-xxl flex-grow-1 container-p-y">
        <form method="POST" action="{{ route('invoice.store', ['slug' => $company->slug]) }}" class="mt-10 space-y-6"
              enctype="multipart/form-data">
            @csrf

            <div class="row invoice-add">
                <!-- Invoice Add-->
                <div class="col-lg-9 col-12 mb-lg-0 mb-4">
                    <div class="card invoice-preview-card">
                        <div class="card-body">
                            <div class="row p-sm-3 p-0">
                                <div class="col-md-6 mb-md-0 mb-4">
                                    <div class="d-flex svg-illustration mb-4 gap-2 align-items-baseline">
                                        <img src="{{ asset('storage/company_logo') }}/{{$company->logo}}" alt="company logo"
                                             class="h-12 w-12 rounded-circle shadow-lg"
                                        >
                                        <span class="app-brand-text h3 mb-0 fw-bold">{{ $company->name }}</span>
                                    </div>
                                    <p class="mb-1">{{ $company->address }}</p>
                                    <p class="mb-0">{{ $company->phone }}</p>
                                </div>
                                <div class="col-md-6">
                                    <dl class="row mb-2">
                                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                            <span class="h4 text-capitalize mb-0 text-nowrap">Invoice #</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                            <div class="w-px-150">
                                                <input
                                                    type="text"
                                                    class="form-control"
                                                    readonly
                                                    value="{{ $invoiceNumber }}"
                                                    id="invoiceId"
                                                />
                                            </div>
                                        </dd>
                                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                            <span class="fw-normal">Date:</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                            <div class="w-px-150">
                                                <input type="text" class="form-control date-picker"  readonly value="{{ date
                                                ('Y-m-d') }}" />
                                            </div>
                                        </dd>
                                        <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                            <span class="fw-normal">Due Date:</span>
                                        </dt>
                                        <dd class="col-sm-6 d-flex justify-content-md-end">
                                            <div class="w-px-150">
                                                <input type="date" name="due_date" class="form-control date-picker"/>
                                            </div>
                                        </dd>
                                    </dl>
                                </div>
                            </div>

                            <hr class="my-4 mx-n4" />

                            <div class="row p-sm-3 p-0">
                                <h6 class="pb-2">Invoice To:</h6>
                                <div class="col-md-6 col-sm-5 col-12 mb-sm-0 mb-4">
                                    <x-form.input name="customer_name" label="Name" placeholder="Enter customer name"></x-form.input>
                                    <x-form.input name="email" label="Email" placeholder="Enter email"></x-form.input>
                                    <x-form.input name="address" label="Address" placeholder="Enter address"></x-form.input>
                                </div>
                                <div class="col-md-6 col-sm-7">
                                    <x-form.input name="phone" label="Phone" placeholder="Enter phone number"></x-form.input>
                                    <x-form.input name="mobile" label="Mobile" placeholder="Enter mobile number"></x-form.input>
                                    <x-form.input name="fax" label="Fax" placeholder="Enter fax number"></x-form.input>
                                </div>
                            </div>

                            <hr class="mx-n4" />

                            <div class="source-item py-sm-3">
                                <div class="mb-3" data-repeater-list="group-a">
                                    <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                                        <div class="d-flex border rounded position-relative pe-0">
                                            <div id="itemContainer">
                                                <div class="row w-100 m-0 p-3 item-group">
                                                    <div class="col-md-6 col-12 mb-md-0 mb-3 ps-md-0">
                                                        <p class="mb-2 repeater-title">Item</p>
                                                        <select name="catalog_id[]" class="catalog_id form-select
                                                        item-details mb-2">
                                                            @foreach($catalogs as $catalog)
                                                                <option value="{{ $catalog->id }}">
                                                                    {{ $catalog->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 col-12 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Unit</p>
                                                        <div class="d-flex gap-1 align-items-center border
                                                        border-dark ">
                                                            <span class="p-2">GH₵</span>
                                                            <input
                                                                type="number"
                                                                name="price"
                                                                class="form-control invoice-item-qty quantity border-0"
                                                                value=""
                                                                readonly
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Qty</p>
                                                        <input
                                                            type="number"
                                                            name="quantity[]"
                                                            class="form-control invoice-item-qty quantity w-100"
                                                            placeholder="1"
                                                        />
                                                    </div>
                                                    <div class="col-md-2 col-12 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Total</p>
                                                        <div class="d-flex align-items-center  ">
                                                            <span class="py-2">GH₵</span>
                                                            <input
                                                                type="text"
                                                                name="total[]"
                                                                class="form-control invoice-item-qty quantity border-0"
                                                                value=""
                                                                readonly
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button id="addItem" type="button" class="btn btn-primary text-black
                                        hover:text-white"
                                                data-repeater-create>Add
                                            Item</button>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 mx-n4" />

                            <div class="row py-sm-3">
                                <div class="col-md-6 mb-md-0 mb-3">
                                    <div class="d-flex align-items-center mb-3">
                                        <label for="salesperson" class="form-label me-5 fw-semibold">Salesperson:</label>
                                        <input type="text" class="form-control" disabled id="salesperson" value="{{
                                        $user->first_name }}" />
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex justify-content-end">
                                    <div class="invoice-calculations">
                                        <div class="d-flex justify-content-between mb-2 gap-4">
                                            <span class="w-px-100">Subtotal:</span>
                                            <span class="fw-semibold" id="subtotal">GH₵ 0.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2 gap-4">
                                            <span class="w-px-100">Discount:</span>
                                            <span class="fw-semibold" id="discount">GH₵ 0.00</span>
                                        </div>

                                        <!-- Taxes Section -->
                                        <div id="tax_display" class="mb-2"></div>

                                        <hr />

                                        <div class="d-flex justify-content-between gap-4">
                                            <span class="w-px-100">Total:</span>
                                            <span class="fw-semibold" id="total">GH₵ 0.00</span>
                                        </div>

                                        <input type="text" id="total-hidden-input" name="total" value="0.00">
                                    </div>

                                </div>
                            </div>

                            <hr class="my-4" />

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="note" class="form-label fw-semibold">Balance:</label>
                                        <div class="d-flex gap-1 align-items-center border border-dark ">
                                            <span class="py-2 px-2">GH₵</span>
                                            <input
                                                type="number"
                                                name="balance"
                                                class="form-control  border-0"
                                                placeholder="Balance to be paid"
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="note" class="form-label fw-semibold">Note:</label>
                                        <textarea class="form-control" rows="2" name="notes" id="notes" placeholder="Invoice note"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Invoice Add-->

                <!-- Invoice Actions -->
                <div class="col-lg-3 col-12 invoice-actions">
                    <div class="card mb-4">
                        <div class="card-body">
                            <input
                                type="submit"
                                class="bg-blue-400 text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"
                                value="Submit"
                            >
                        </div>
                    </div>
                    <div>
                        <p class="mb-2">Payments terms</p>
                        <select name="term_id" class="form-select mb-4">
                            @foreach($company->paymentTerms as $terms)
                                <option value="{{ $terms->id }}">{{ $terms->name }}</option>
                            @endforeach
                        </select>

                        <x-form.input type="number" name="discount" placeholder="Enter discount" label="Discount"
                                      class="discount"/>

                        <div id="taxContainer">
                            <div class="flex flex-row gap-3 items-center tax-group">
                                <div class="mt-6">
                                    <label for="tax_id" class="block text-sm font-medium leading-6 text-gray-900">Tax</label>
                                    <div class="mt-2">
                                        <select name="tax_id[]" class="tax_id border border-gray-400 rounded-lg p-2 w-full">
                                            @foreach($taxes as $tax)
                                                <option value="{{ $tax->id }}" data-rate="{{ $tax->tax_percentage }}" data-type="{{ $tax->type }}">
                                                    {{ $tax->tax_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-6 mt-4">
                            <input
                                type="button"
                                id="addTax"
                                class="bg-blue-400 text-white rounded-lg w-full py-2 px-4 hover:bg-blue-800 cursor-pointer"
                                value="Add another tax"
                            >
                        </div>
                    </div>
                </div>
                <!-- /Invoice Actions -->
            </div>
        </form>
        <!-- /Send Invoice Sidebar -->
        <!-- /Offcanvas -->
    </div>
</x-layout>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // $(document).ready(function() {
    //
    //     function updateTotal($itemGroup) {
    //         var price = parseFloat($itemGroup.find('input[name="price"]').val()) || 0;
    //         var quantity = parseFloat($itemGroup.find('input[name="quantity[]"]').val()) || 1;
    //         var total = price * quantity;
    //         $itemGroup.find('input[name="total[]"]').val(total.toFixed(2)); // Set the total value
    //         updateInvoiceCalculations(); // Update overall invoice calculations
    //     }
    //
    //     function updateInvoiceCalculations() {
    //         var subtotal = 0;
    //         var totalPrimaryTax = 0;
    //         var totalSecondaryTax = 0;
    //
    //         // Calculate the subtotal by summing all the item totals
    //         $('input[name="total[]"]').each(function() {
    //             subtotal += parseFloat($(this).val()) || 0;
    //         });
    //
    //         var discount = calculateDiscount(subtotal); // Calculate the discount based on user input
    //         var totalAfterDiscount = subtotal - discount; // New total after discount
    //
    //         // Calculate the taxes
    //         var totalAfterPrimaryTax = totalAfterDiscount;
    //         $('select.tax_id option:selected').each(function() {
    //             var taxRate = parseFloat($(this).data('rate')) || 0;
    //             var taxType = $(this).data('type'); // Assuming the type is stored in a data attribute
    //             var taxAmount = 0;
    //
    //             if (taxType === 'PRIMARY') {
    //                 taxAmount = totalAfterDiscount * (taxRate / 100); // Calculate primary tax on discounted total
    //                 totalPrimaryTax += taxAmount;
    //                 totalAfterPrimaryTax += taxAmount; // Add primary tax to the total
    //             } else if (taxType === 'SECONDARY') {
    //                 taxAmount = totalAfterPrimaryTax * (taxRate / 100); // Calculate secondary tax on the new total
    //                 totalSecondaryTax += taxAmount;
    //             }
    //         });
    //
    //         var finalTotal = totalAfterPrimaryTax + totalSecondaryTax; // Final total after adding all taxes
    //
    //         // Display all taxes combined in the UI
    //         displayTax(totalPrimaryTax, totalSecondaryTax);
    //
    //         // Update the UI with the calculated values
    //         $('#subtotal').text('GH₵' + subtotal.toFixed(2));
    //         $('#discount').text('GH₵' + discount.toFixed(2));
    //         $('#total').text('GH₵' + finalTotal.toFixed(2));
    //         $('#total-hidden-input').val(finalTotal.toFixed(2));
    //     }
    //
    //     function calculateDiscount(subtotal) {
    //         var discountPercentage = parseFloat($('input[name="discount"]').val()) || 0;
    //         return subtotal * (discountPercentage / 100);
    //     }
    //
    //     function displayTax(totalPrimaryTax, totalSecondaryTax) {
    //         var totalTax = totalPrimaryTax + totalSecondaryTax;
    //         var taxDisplay = `
    //         <div class="d-flex gap-4">
    //             <p>Total Tax:</p>
    //             <p class="fw-semibold mb-2">GH₵${totalTax.toFixed(2)}</p>
    //         </div>
    //     `;
    //         $('#tax_display').html(taxDisplay); // Replace the content with the total tax
    //     }
    //
    //     // Handle item selection and quantity input changes
    //     $(document).on('change', '.catalog_id', function() {
    //         var catalogId = $(this).val();
    //         var $itemGroup = $(this).closest('.item-group');
    //
    //         $.ajax({
    //             url: '/get-price',
    //             method: 'GET',
    //             data: { id: catalogId },
    //             success: function(response) {
    //                 $itemGroup.find('input[name="price"]').val(response.price);
    //                 updateTotal($itemGroup);
    //             },
    //             error: function() {
    //                 alert('Failed to fetch the price. Please try again.');
    //             }
    //         });
    //     });
    //
    //     $(document).on('input', 'input[name="quantity[]"]', function() {
    //         var $itemGroup = $(this).closest('.item-group');
    //         updateTotal($itemGroup);
    //     });
    //
    //     // Trigger update when the discount input changes
    //     $(document).on('input', 'input[name="discount"]', function() {
    //         updateInvoiceCalculations(); // Recalculate the total when discount changes
    //     });
    //
    //     // Trigger update when tax selection changes
    //     $(document).on('change', '.tax_id', function() {
    //         $('#tax_display').empty(); // Clear previous tax display before recalculating
    //         updateInvoiceCalculations(); // Recalculate the total when taxes are selected/changed
    //     });
    //
    // });

    $(document).ready(function() {

        function updateTotal($itemGroup) {
            var price = parseFloat($itemGroup.find('input[name="price"]').val()) || 0;
            var quantity = parseFloat($itemGroup.find('input[name="quantity[]"]').val()) || 1;
            var total = price * quantity;
            $itemGroup.find('input[name="total[]"]').val(total.toFixed(2)); // Set the total value
            updateInvoiceCalculations(); // Update overall invoice calculations
        }

        function updateInvoiceCalculations() {
            var subtotal = 0;
            var totalPrimaryTax = 0;
            var totalSecondaryTax = 0;
            var allTaxes = []; // Array to hold all taxes

            // Calculate the subtotal by summing all the item totals
            $('input[name="total[]"]').each(function() {
                subtotal += parseFloat($(this).val()) || 0;
            });

            var discount = calculateDiscount(subtotal); // Calculate the discount based on user input
            var totalAfterDiscount = subtotal - discount; // New total after discount

            // Loop through the selected taxes and apply them
            $('select.tax_id option:selected').each(function() {
                var taxRate = parseFloat($(this).data('rate')) || 0;
                var taxType = $(this).data('type'); // Assuming the type is stored in a data attribute
                var taxAmount = 0;

                if (taxType === 'PRIMARY') {
                    taxAmount = totalAfterDiscount * (taxRate / 100); // Calculate primary tax on discounted total
                    totalPrimaryTax += taxAmount;
                    allTaxes.push({ name: $(this).text(), rate: taxRate, amount: taxAmount });
                } else if (taxType === 'SECONDARY') {
                    var newTotal = totalAfterDiscount + totalPrimaryTax; // New total after adding primary tax
                    taxAmount = newTotal * (taxRate / 100); // Calculate secondary tax on the new total
                    totalSecondaryTax += taxAmount;
                    allTaxes.push({ name: $(this).text(), rate: taxRate, amount: taxAmount });
                }
            });

            var finalTotal = totalAfterDiscount + totalPrimaryTax + totalSecondaryTax; // Final total after adding taxes

            // Display all taxes together
            displayTax(allTaxes);

            // Update the UI with the calculated values
            $('#subtotal').text('GH₵' + subtotal.toFixed(2));
            $('#discount').text('GH₵' + discount.toFixed(2));
            $('#total').text('GH₵' + finalTotal.toFixed(2));
            $('#total-hidden-input').val(finalTotal.toFixed(2));
        }

        function calculateDiscount(subtotal) {
            var discountPercentage = parseFloat($('input[name="discount"]').val()) || 0;
            return subtotal * (discountPercentage / 100);
        }

        function displayTax(allTaxes) {
            var taxDisplay = '';

            // Display each tax individually
            allTaxes.forEach(function(tax) {
                taxDisplay += `
                <div class="d-flex justify-content-between gap-4">
                    <p>${tax.name} (${tax.rate}%):</p>
                    <p class="fw-semibold mb-2">GH₵${tax.amount.toFixed(2)}</p>
                </div>
            `;
            });

            $('#tax_display').html(taxDisplay); // Replace the content with all the taxes
        }

        // Handle item selection and quantity input changes
        $(document).on('change', '.catalog_id', function() {
            var catalogId = $(this).val();
            var $itemGroup = $(this).closest('.item-group');

            $.ajax({
                url: '/get-price',
                method: 'GET',
                data: { id: catalogId },
                success: function(response) {
                    $itemGroup.find('input[name="price"]').val(response.price);
                    updateTotal($itemGroup);
                },
                error: function() {
                    alert('Failed to fetch the price. Please try again.');
                }
            });
        });

        $(document).on('input', 'input[name="quantity[]"]', function() {
            var $itemGroup = $(this).closest('.item-group');
            updateTotal($itemGroup);
        });

        // Trigger update when the discount input changes
        $(document).on('input', 'input[name="discount"]', function() {
            updateInvoiceCalculations(); // Recalculate the total when discount changes
        });

        // Trigger update when tax selection changes
        $(document).on('change', '.tax_id', function() {
            $('#tax_display').empty(); // Clear previous tax display before recalculating
            updateInvoiceCalculations(); // Recalculate the total when taxes are selected/changed
        });

    });


    document.getElementById('addItem').addEventListener('click', function () {
        var itemContainer = document.getElementById('itemContainer');
        var itemGroup = document.querySelector('.item-group');
        var newItemGroup = itemGroup.cloneNode(true);

        // Clear the values of the cloned elements
        var selects = newItemGroup.getElementsByTagName('select');
        for (var i = 0; i < selects.length; i++) {
            selects[i].selectedIndex = 0;
        }

        var inputs = newItemGroup.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type === 'text') {
                inputs[i].value = '';
            }
        }

        if (!newItemGroup.querySelector('.remove-item')) {
            var removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'remove-item bg-red-500 text-white rounded-lg px-2 py-1';
            removeButton.textContent = 'Remove';
            removeButton.addEventListener('click', function() {
                this.parentNode.remove();
            });
            newItemGroup.appendChild(removeButton);
        }

        itemContainer.appendChild(newItemGroup);
    });

    document.getElementById('addTax').addEventListener('click', function () {
        var taxContainer = document.getElementById('taxContainer');
        var taxGroup = document.querySelector('.tax-group');
        var newTaxGroup = taxGroup.cloneNode(true);

        // Clear the values of the cloned elements
        var selects = newTaxGroup.getElementsByTagName('select');
        for (var i = 0; i < selects.length; i++) {
            selects[i].selectedIndex = 0;
        }

        var inputs = newTaxGroup.getElementsByTagName('input');
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].type === 'text') {
                inputs[i].value = '';
            }
        }

        if (!newTaxGroup.querySelector('.remove-tax')) {
            var removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'remove-tax bg-red-500 text-white rounded-lg px-2 py-1';
            removeButton.textContent = 'Remove';
            removeButton.addEventListener('click',
                function() {
                    this.parentNode.remove();
            });
            newTaxGroup.appendChild(removeButton);
        }

        taxContainer.appendChild(newTaxGroup);
    });
</script>
