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
                                                    disabled
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
                                                <input type="text" class="form-control date-picker"  disabled value="{{ date
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
{{--                                                    <div class="col-md-2 col-12 mb-md-0 mb-3">--}}
{{--                                                        <p class="mb-2 repeater-title">Unit</p>--}}
{{--                                                        <input--}}
{{--                                                            type="text"--}}
{{--                                                            name="price"--}}
{{--                                                            class="form-control invoice-item-qty quantity"--}}
{{--                                                            value="{{ $catalog->price }}"--}}
{{--                                                        />--}}
{{--                                                    </div>--}}
                                                    <div class="col-md-2 col-12 mb-md-0 mb-3">
                                                        <p class="mb-2 repeater-title">Qty</p>
                                                        <input
                                                            type="text"
                                                            name="quantity[]"
                                                            class="form-control invoice-item-qty quantity w-100"
                                                            placeholder="1"
                                                        />
                                                    </div>
{{--                                                    <div class="col-md-2 col-12 mb-md-0 mb-3">--}}
{{--                                                        <p class="mb-2 repeater-title">Price</p>--}}
{{--                                                        <input--}}
{{--                                                            type="text"--}}
{{--                                                            name="price"--}}
{{--                                                            class="form-control invoice-item-qty quantity"--}}
{{--                                                            placeholder="$24.00"--}}
{{--                                                        />--}}
{{--                                                    </div>--}}
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
{{--                                <div class="col-md-6 d-flex justify-content-end">--}}
{{--                                    <div class="invoice-calculations">--}}
{{--                                        <div class="d-flex justify-content-between mb-2">--}}
{{--                                            <span class="w-px-100">Subtotal:</span>--}}
{{--                                            <span class="fw-semibold">$00.00</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex justify-content-between mb-2">--}}
{{--                                            <span class="w-px-100">Discount:</span>--}}
{{--                                            <span class="fw-semibold">$00.00</span>--}}
{{--                                        </div>--}}
{{--                                        <div class="d-flex justify-content-between mb-2">--}}
{{--                                            <span class="w-px-100">Tax:</span>--}}
{{--                                            <span class="fw-semibold">$00.00</span>--}}
{{--                                        </div>--}}
{{--                                        <hr />--}}
{{--                                        <div class="d-flex justify-content-between">--}}
{{--                                            <span class="w-px-100">Total:</span>--}}
{{--                                            <span class="fw-semibold">$00.00</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>

                            <hr class="my-4" />

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
                            <button
                                class="btn btn-primary d-grid w-100 mb-3"
                                data-bs-toggle="offcanvas"
                                data-bs-target="#sendInvoiceOffcanvas"
                            >
                            <span class="d-flex align-items-center justify-content-center text-nowrap"
                            ><i class="bx bx-paper-plane bx-xs me-3"></i>Send Invoice</span
                            >
                            </button>
                            <button type="submit" class="btn btn-label-secondary d-grid w-100">Save /
                                Preview</button>
                        </div>
                    </div>
                    <div>
                        <p class="mb-2">Payments terms</p>
                        <select name="term_id" class="form-select mb-4">
                            @foreach($company->paymentTerms as $terms)
                                <option value="{{ $terms->id }}">{{ $terms->name }}</option>
                            @endforeach
                        </select>

                        <x-form.input name="discount" placeholder="Enter discount" label="Discount" class="discount"/>

                        <div id="taxContainer">
                            <div class="flex flex-row gap-3 items-center tax-group">
                                <div class="mt-6">
                                    <label for="tax_id" class="block text-sm font-medium leading-6 text-gray-900">Tax</label>
                                    <div class="mt-2">
                                        <select name="tax_id[]" class="tax_id border border-gray-400 rounded-lg p-2 w-full">
                                            @foreach($taxes as $tax)
                                                <option value="{{ $tax->id }}">{{ $tax->tax_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--                    <button type="button" class="remove-item bg-red-500 text-white rounded-lg px-2 py-1">Remove</button>--}}
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

{{--            <!-- Offcanvas -->--}}
{{--            <!-- Send Invoice Sidebar -->--}}
{{--            <div class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">--}}
{{--                <div class="offcanvas-header border-bottom">--}}
{{--                    <h6 class="offcanvas-title">Send Invoice</h6>--}}
{{--                    <button--}}
{{--                        type="button"--}}
{{--                        class="btn-close text-reset"--}}
{{--                        data-bs-dismiss="offcanvas"--}}
{{--                        aria-label="Close"--}}
{{--                    ></button>--}}
{{--                </div>--}}
{{--                <div class="offcanvas-body flex-grow-1">--}}
{{--                    <form>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="invoice-from" class="form-label">From</label>--}}
{{--                            <input--}}
{{--                                type="text"--}}
{{--                                class="form-control"--}}
{{--                                id="invoice-from"--}}
{{--                                value="shelbyComapny@email.com"--}}
{{--                                placeholder="company@email.com"--}}
{{--                            />--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="invoice-to" class="form-label">To</label>--}}
{{--                            <input--}}
{{--                                type="text"--}}
{{--                                class="form-control"--}}
{{--                                id="invoice-to"--}}
{{--                                value="qConsolidated@email.com"--}}
{{--                                placeholder="company@email.com"--}}
{{--                            />--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="invoice-subject" class="form-label">Subject</label>--}}
{{--                            <input--}}
{{--                                type="text"--}}
{{--                                class="form-control"--}}
{{--                                id="invoice-subject"--}}
{{--                                value="Invoice of purchased Admin Templates"--}}
{{--                                placeholder="Invoice regarding goods"--}}
{{--                            />--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="invoice-message" class="form-label">Message</label>--}}
{{--                            <textarea class="form-control" name="invoice-message" id="invoice-message" cols="3" rows="8">--}}
{{--                                Dear Queen Consolidated,--}}
{{--                                  Thank you for your business, always a pleasure to work with you!--}}
{{--                                  We have generated a new invoice in the amount of $95.59--}}
{{--                                  We would appreciate payment of this invoice by 05/11/2021--}}
{{--                            </textarea>--}}
{{--                        </div>--}}
{{--                        <div class="mb-4">--}}
{{--                          <span class="badge bg-label-primary">--}}
{{--                            <i class="bx bx-link bx-xs"></i>--}}
{{--                            <span class="align-middle">Invoice Attached</span>--}}
{{--                          </span>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3 d-flex flex-wrap">--}}
{{--                            <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>--}}
{{--                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--        <!-- /Send Invoice Sidebar -->--}}
{{--        <!-- /Offcanvas -->--}}
    </div>
</x-layout>

<script>
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
