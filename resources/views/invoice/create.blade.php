<x-masterLayout :company="$company">
    <!-- Content -->
    @push('styles')
        <style>
            .input-group-text {
                padding: 0.269rem 0.285rem;
                font-size: 0.8375rem;

            }

            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            input[type="number"] {
                -moz-appearance: textfield;
            }

            .form-control[readonly] {
                background-color: #fff;
                opacity: 1;
            }
        </style>
    @endpush

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row invoice-add">
            <!-- Invoice Add-->
            <div class="col-lg-9 col-12 mb-lg-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div class="row p-sm-3 p-0">
                            <div class="col-md-6 mb-md-0 mb-4">
                                <div class="d-flex svg-illustration mb-4 gap-2">
                                    <img src="{{ asset('storage/company_logo') }}/{{ $company->logo }}"
                                        alt="company logo" class="h-12 w-12 rounded shadow-lg "
                                        style="width: auot; height: 50px;">

                                </div>
                                <span class="app-brand-text h5 mb-2 fw-bold">{{ $company->name }}</span>

                                <p class="mb-1">Company Box number</p>
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
                                            <input type="text" class="form-control" disabled placeholder="3905"
                                                value="3905" id="invoiceId" />
                                        </div>
                                    </dd>
                                    <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                        <span class="fw-normal">Date:</span>
                                    </dt>
                                    <dd class="col-sm-6 d-flex justify-content-md-end">
                                        <div class="w-px-150">
                                            <input type="text" class="form-control date-picker"
                                                placeholder="YYYY-MM-DD" />
                                        </div>
                                    </dd>
                                    <dt class="col-sm-6 mb-2 mb-sm-0 text-md-end">
                                        <span class="fw-normal">Due Date:</span>
                                    </dt>
                                    <dd class="col-sm-6 d-flex justify-content-md-end">
                                        <div class="w-px-150">
                                            <input type="text" class="form-control date-picker"
                                                placeholder="YYYY-MM-DD" />
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>

                        <hr class="my-4 mx-n4" />

                        <div class="col-lg-12 col-md-6 ">
                            <div class="mt-3" style="float: right;">
                                <!-- Button trigger modal -->

                                <div data-bs-toggle="modal" data-bs-target="#modalCenter">
                                    <span class="badge bg-label-secondary p-2 rounded"><i
                                            class="bx bx-edit-alt"></i>EDIT</span>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">Invoice TO</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="row g-4 mb-3">
                                                    <div class="col mb-0">
                                                        <label for="contact_person" class="form-label">Contact
                                                            Person</label>
                                                        <input type="text" class="form-control no-border"
                                                            name="contact_person" placeholder="Contact Rep"
                                                            aria-label="Enter Contact Person"
                                                            aria-describedby="basic-addon11" value="" />
                                                    </div>
                                                    <div class="col mb-0">
                                                        <label for="company_name" class="form-label">Company
                                                            Name</label>
                                                        <input type="text" class="form-control no-border"
                                                            name="company_name" placeholder="Company Name"
                                                            aria-label="Enter Company Name"
                                                            aria-describedby="basic-addon11" value="" />
                                                    </div>
                                                </div>
                                                <div class="row g-4 mb-3">
                                                    <div class="col mb-0">
                                                        <label for="company_address" class="form-label">Company
                                                            Address</label>
                                                        <input type="text" class="form-control no-border"
                                                            name="company_address" placeholder="Company Address"
                                                            aria-label="Enter Company Address"
                                                            aria-describedby="basic-addon11" value="" />
                                                    </div>
                                                    <div class="col mb-0">
                                                        <label for="company_email" class="form-label">Company Email</label>
                                                        <input type="text" class="form-control no-border"
                                                            placeholder="Company Email"
                                                            aria-label="Enter Company Email" name="company_email"
                                                            aria-describedby="basic-addon11" value="" />
                                                    </div>
                                                </div>
                                                <div class="row g-4 mb-3">
                                                    <div class="col mb-0">
                                                        <label for="company_phone" class="form-label">Company Phone</label>
                                                        <input type="text" class="form-control no-border" name="company_phone"
                                                        placeholder="Company Phone" aria-label="Enter Company Phone"
                                                        aria-describedby="basic-addon11" value="" />
                                                    </div>
                                                    <div class="col mb-0">
                                                        <label for="fax_number" class="form-label">Fax Number</label>
                                                        <input type="text" class="form-control no-border" name="fax_number"
                                                        placeholder="Enter fax number" aria-label="Enter fax number"
                                                        aria-describedby="basic-addon11" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-between">
                                                <button type="button" class="btn btn-label-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" id="invoiceTo" class="btn btn-primary">Apply changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  class="p-3 mt-3 ">
                            <!-- Information will be displayed here -->
                        </div>
                        <div class="row p-sm-3 p-0">
                            <h5 class="pb-2">Invoice To:</h5>

                            <div  id="displayArea" class="col-md-12 col-sm-5 col-12 mb-sm-0 mb-4 ">
                                <p class="mb-1"> Contact Person:</p>
                                <p class="mb-1">Company Name:</p>
                                <p class="mb-1">Company Address:</p>
                                <p class="mb-1">Company Email:</p>
                                <p class="mb-1">Company Phone:</p>
                                <p class="mb-0">Fax Number:</p>
                            </div>
                            {{-- <div class="col-md-6 col-sm-7">
                                <h6 class="pb-2">Bill To:</h6>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pe-3">Total Due:</td>
                                            <td>$12,110.55</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3">Bank name:</td>
                                            <td>American Bank</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3">Country:</td>
                                            <td>United States</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3">IBAN:</td>
                                            <td>ETD95476213874685</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3">SWIFT code:</td>
                                            <td>BR91905</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> --}}
                        </div>

                        <hr class="mx-n4" />

                        <form class="source-item py-sm-3">
                            <div class="mb-3" data-repeater-list="group-a">
                                <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item>
                                    <div class="d-flex border rounded position-relative pe-0">
                                        <div class="row w-100 m-0 p-3">
                                            <div class="col-md-4 col-12 mb-md-0 mb-3 ps-md-0">
                                                <p class="mb-2 repeater-title">Item</p>
                                                <select name="catalog_id[]"
                                                    class="catalog_id form-select item-detailsX mb-2">
                                                    <option selected disabled>Select Item</option>
                                                    @foreach ($catalogs as $catalog)
                                                        <option value="{{ $catalog->id }}">
                                                            {{ $catalog->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-12 mb-md-0 mb-3">
                                                <p class="mb-2 repeater-title">Unit Cost</p>
                                                <input type="number" name="price"
                                                    class="form-control invoice-item-price mb-2" placeholder="00"
                                                    min="12" />
                                                {{-- <div>
                                                    <span>Discount:</span>
                                                    <span class="discount me-2">0%</span>
                                                    <span class="tax-1 me-2" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Tax 1">0%</span>
                                                    <span class="tax-2" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Tax 2">0%</span>
                                                </div> --}}
                                            </div>
                                            <div class="col-md-2 col-12 mb-md-0 mb-3">
                                                <p class="mb-2 repeater-title">Qty</p>
                                                <input type="number" name="quantity[]"
                                                    class="form-control quantity invoice-item-qty"
                                                     min="1"  />
                                            </div>
                                            <div class="col-md-3 col-12 pe-0">
                                                <p class="mb-2 repeater-title">Sub Total</p>
                                                <div class="input-group">
                                                    <span class="input-group-text">₵</span>
                                                    <input type="number" name="total[]"
                                                        class="form-control invoice-item-sub_total  "
                                                        aria-label="Amount (to the nearest dollar)"
                                                        required />
                                                </div>
                                                <div>
                                                    <span>Discount:</span>
                                                    <span class="discount me-2">0%</span>
                                                    {{-- <span class="tax-1 me-2" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Tax 1">0%</span> --}}
                                                    {{-- <span class="tax-2" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Tax 2">0%</span> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex flex-column align-items-center justify-content-between border-start p-2">
                                            <i class="bx bx-x fs-4 text-muted cursor-pointer" data-repeater-delete></i>
                                            <div class="dropdown">
                                                <i class="bx bx-cog bx-xs text-muted cursor-pointer more-options-dropdown"
                                                    role="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                    data-bs-auto-close="outside" aria-expanded="false">
                                                </i>
                                                <div class="dropdown-menu dropdown-menu-end w-px-300 p-3"
                                                    aria-labelledby="dropdownMenuButton">
                                                    <div class="row g-3">
                                                        <div class="col-12">
                                                            <label for="discountInput"
                                                                class="form-label">Discount(%)</label>
                                                            <input type="number" class="form-control"
                                                                id="discountInput" min="0" max="100" />
                                                        </div>
                                                        {{-- <div class="col-md-6">
                                                            <label for="taxInput1" class="form-label">Tax 1</label>
                                                            <select name="tax-1-input" id="taxInput1"
                                                                class="form-select tax-select">
                                                                <option value="0%" selected>0%</option>
                                                                <option value="1%">1%</option>
                                                                <option value="10%">10%</option>
                                                                <option value="18%">18%</option>
                                                                <option value="40%">40%</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="taxInput2" class="form-label">Tax 2</label>
                                                            <select name="tax-2-input" id="taxInput2"
                                                                class="form-select tax-select">
                                                                <option value="0%" selected>0%</option>
                                                                <option value="1%">1%</option>
                                                                <option value="10%">10%</option>
                                                                <option value="18%">18%</option>
                                                                <option value="40%">40%</option>
                                                            </select>
                                                        </div> --}}
                                                    </div>
                                                    <div class="dropdown-divider my-3"></div>
                                                    <button type="button"
                                                        class="btn btn-label-primary btn-apply-changes">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-primary" data-repeater-create>Add
                                        Item</button>
                                </div>
                            </div>
                        </form>

                        <hr class="my-4 mx-n4" />

                        <div class="row py-sm-3">
                            <div class="col-md-6 mb-md-0 mb-3">
                                <div class="d-flex align-items-center mb-3">
                                    <label for="salesperson" class="form-label me-1 fw-semibold">Salesperson:</label>
                                    <p class="mb-1">{{ $user->first_name }}</p>

                                </div>
                                <input type="text" class="form-control" id="invoiceMsg"
                                    placeholder="Thanks for your business" />
                            </div>
                            <div class="col-md-6 d-flex justify-content-end">
                                <div class="invoice-calculations">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-100">Subtotal:</span>
                                        <span class="fw-semibold subtotal">$00.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-100">Discount:</span>
                                        <span class="fw-semibold discount">$00.00</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-100">Tax:</span>
                                        <span class="fw-semibold tax">$00.00</span>
                                    </div>
                                    <hr />
                                    <div class="d-flex justify-content-between">
                                        <span class="w-px-100">Total:</span>
                                        <span class="fw-semibold total">$00.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4" />

                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="note" class="form-label fw-semibold">Note:</label>
                                    <textarea class="form-control" rows="2" id="note" placeholder="Invoice note"></textarea>
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

                      <div class="d-flex my-3">
                        <a href="./app-invoice-preview.html" class="btn btn-label-secondary w-100 me-3">Preview</a>
                        <button type="button" class="btn btn-label-secondary w-100">Save</button>
                      </div>
                      <button class="btn btn-primary d-grid w-100" data-bs-toggle="offcanvas" data-bs-target="#sendInvoiceOffcanvas">
                        <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="bx bx-paper-plane bx-xs me-3"></i>Send Invoice</span>
                      </button>

                    </div>
                  </div>

                    {{-- List all taxes here and let users toggle to apply tax --}}
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="mb-2 ">Taxes</h6>
                            @foreach ($taxes as $tax)
                            <div class="d-flex justify-content-between mb-2 align-items-center gap-2">
                                @if ($tax->type === 'SECONDARY')
                                <label for="tax-{{ $tax->id }}" class="badge bg-label-warning mb-0 text-wrap">
                                    {{$tax->tax_name }} {{ $tax->tax_percentage }}%
                                </label>
                                @else
                                <label for="tax-{{ $tax->id }}" class="badge bg-label-primary mb-0 text-wrap">
                                    {{$tax->tax_name }} {{ $tax->tax_percentage }}%
                                </label>
                                @endif
                                <label class="switch switch-primary">
                                    <input type="checkbox" class="switch-input" id="tax-{{ $tax->id }}" name="tax_ids[]" value="{{ $tax->id }}" />
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on">
                                            <i class="bx bx-check"></i>
                                        </span>
                                        <span class="switch-off">
                                            <i class="bx bx-x"></i>
                                        </span>
                                    </span>
                                    <span class="switch-label"></span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="my-2 ">Payment Terms</h6>
                            <div class="mb-4">
                                @foreach ($company->paymentTerms as $terms)
                                <div class="form-check mb-2">
                                    <input type="radio"  id="payment-term-{{ $terms->id }}" name="payment_terms_ids[]" class="form-check-input"
                                         value="success" />
                                    <label class="form-check-label" for="payment-term-{{ $terms->id }}">{{ $terms->name }}</label>
                                </div>
                                @endforeach



                            </div>
                        </div>
                    </div>




                    {{-- <div class="d-flex justify-content-between mb-2">
                        <label for="client-notes" class="mb-0">Tax 2</label>
                        <label class="switch switch-primary me-0">
                            <input type="checkbox" class="switch-input" id="client-notes" />
                            <span class="switch-toggle-slider">
                                <span class="switch-on">
                                    <i class="bx bx-check"></i>
                                </span>
                                <span class="switch-off">
                                    <i class="bx bx-x"></i>
                                </span>
                            </span>
                            <span class="switch-label"></span>
                        </label>
                    </div>
                    <div class="d-flex justify-content-between">
                        <label for="payment-stub" class="mb-0">Tax 3</label>
                        <label class="switch switch-primary me-0">
                            <input type="checkbox" class="switch-input" id="payment-stub" />
                            <span class="switch-toggle-slider">
                                <span class="switch-on">
                                    <i class="bx bx-check"></i>
                                </span>
                                <span class="switch-off">
                                    <i class="bx bx-x"></i>
                                </span>
                            </span>
                            <span class="switch-label"></span>
                        </label>
                    </div> --}}
                </div>
            </div>
            <!-- /Invoice Actions -->
        </div>

        <!-- Offcanvas -->
        <!-- Send Invoice Sidebar -->
        <div class="offcanvas offcanvas-end" id="sendInvoiceOffcanvas" aria-hidden="true">
            <div class="offcanvas-header border-bottom">
                <h6 class="offcanvas-title">Send Invoice</h6>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body flex-grow-1">
                <form>
                    <div class="mb-3">
                        <label for="invoice-from" class="form-label">From</label>
                        <input type="text" class="form-control" id="invoice-from" value="shelbyComapny@email.com"
                            placeholder="company@email.com" />
                    </div>
                    <div class="mb-3">
                        <label for="invoice-to" class="form-label">To</label>
                        <input type="text" class="form-control" id="invoice-to" value="qConsolidated@email.com"
                            placeholder="company@email.com" />
                    </div>
                    <div class="mb-3">
                        <label for="invoice-subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="invoice-subject"
                            value="Invoice of purchased Admin Templates" placeholder="Invoice regarding goods" />
                    </div>
                    <div class="mb-3">
                        <label for="invoice-message" class="form-label">Message</label>
                        <textarea class="form-control" name="invoice-message" id="invoice-message" cols="3" rows="8">
                                Dear Queen Consolidated,
                                Thank you for your business, always a pleasure to work with you!
                                We have generated a new invoice in the amount of $95.59
                                We would appreciate payment of this invoice by 05/11/2021</textarea>
                    </div>
                    <div class="mb-4">
                        <span class="badge bg-label-primary">
                            <i class="bx bx-link bx-xs"></i>
                            <span class="align-middle">Invoice Attached</span>
                        </span>
                    </div>
                    <div class="mb-3 d-flex flex-wrap">
                        <button type="button" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">Send</button>
                        <button type="button" class="btn btn-label-secondary"
                            data-bs-dismiss="offcanvas">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /Send Invoice Sidebar -->
        <!-- /Offcanvas -->
    </div>
    <!-- / Content -->


</x-masterLayout>
