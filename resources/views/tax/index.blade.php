<x-masterLayout :company="$company">
    @section('title', 'Tax')
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

            .error {
                color: red;
                font-size: 12px;
            }

            @media (min-width: 1200px) {
                .rm-btn{
            padding-left: 50px;
           }
            }




        </style>
    @endpush
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="mx-auto col-lg-8 col-12">
            <div class="card">
                <h5 class="card-header">Add new tax</h5>
                @if ($errors->any())
                    <span class="error">
                        <ol>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ol>
                    </span>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('tax.store', ['slug' => $company->slug]) }}" id="tax-repeater"
                        class="tax-repeater">
                        @csrf
                        <div data-repeater-list="group_a">
                            <div data-repeater-item>
                                <div class="row">
                                    <div class="mb-3 col-lg-6 col-xl-4 col-12">
                                        <div class="form-group">
                                            <label for="tax-name">Tax Name</label>
                                            <input type="text" id="form-repeater-1-1"
                                                class="form-control {{ $errors->first('tax_name') ? ' form-error' : '' }}"
                                                placeholder="Enter Tax Name" name="tax_name" />
                                        </div>
                                        <div class="error" data-error="tax_name"></div>

                                        @error('tax_name')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-lg-6 col-xl-3 col-12">
                                        <div class="form-group">
                                            <label for="tax_percentage">Tax Percent</label>
                                            <div class="input-group">
                                                <input type="number" id="form-repeater-1-1"
                                                    class="form-control {{ $errors->first('tax_percentage') ? ' form-error' : '' }}"
                                                    placeholder="Enter Tax %" name="tax_percentage" step="0.01"
                                                       min="0" max="100"
                                                />
                                                <span class="input-group-text">%</span>
                                            </div>

                                        </div>
                                        <div class="error" data-error="tax_percentage"></div>

                                        @error('tax_percentage')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3 col-lg-6 col-xl-3 col-12">
                                        <div class="form-group ">
                                            <label for="tax-type">Tax Type</label>
                                            <div class="mt-2 d-flex">
                                                <div class="form-check me-4" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-offset="0,8"
                                                    data-bs-original-title="Primary Tax">
                                                    <input name="tax_type" class="form-check-input" type="radio"
                                                        value="primary" id="primaryRadio">
                                                    <label class="form-check-label" for="primaryRadio">
                                                        Primary
                                                    </label>
                                                </div>

                                                <div class="form-check" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-offset="0,8" data-bs-original-title="Secondary Tax">
                                                    <input name="tax_type" class="form-check-input" type="radio"
                                                        value="secondary" id="secondaryRadio">
                                                    <label class="form-check-label" for="secondaryRadio">
                                                        Secondary
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="error" data-error="tax_type"></div>

                                        @error('tax_type')
                                            <p class="error">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3 col-lg-6 col-xl-2 col-12"  >
                                        <label for=""> </label>
                                        <div class=" form-group rm-btn" >
                                            <button type="button" class=" btn btn-label-danger mt-4x" data-repeater-delete>
                                                <i class="bx bx-x"></i>
                                                <span class="align-middle"></span>
                                            </button>
                                        </div>

                                    </div>
                                </div>

                            </div>


                        </div>

                        <div class="mt-2 d-flex justify-content-between">
                            <button type="button" class="btn btn-primary me-2" data-repeater-create>
                                <i class="bx bx-plus"></i>
                                Add New Row
                            </button>
                            <button type="submit" class="btn btn-label-success">Save Changes</button>
                        </div>

                    </form>

                </div>


            </div>
            <br>

            <hr class="my-3" />

            <br>

        </div>




        <div class="mx-auto card col-lg-8 col-12">
            <h5 class="card-header">Taxes</h5>

            <div class=" table-responsive text-nowrap">
                <table class="table " id="datatable">
                    <thead class="mx-auto">
                        <tr>
                            <th>Tax Name</th>
                            <th>Tax Percentage</th>
                            <th>Tax Type</th>
                            <th>Actions</th>

                        </tr>

                    </thead>
                    @unless (count($taxes) == 0)
                        <tbody class="table-border-bottom-0">
                            @foreach ($taxes as $tax)
                                <tr>
                                    <td>{{ $tax->tax_name }}</td>
                                    <td>{{ $tax->tax_percentage }}%</td>


                                    @if ($tax->type === 'SECONDARY')
                                        <td><span style="padding: 3px; border-radius:4px"
                                                class="bg-label-warning">Secondary</span>
                                        </td>
                                    @else
                                        <td><span style="padding: 3px; border-radius:4px"
                                                class="bg-label-primary">Primary</span>
                                        </td>
                                    @endif
                                    <td valign="top" class="d-flex">
                                        <div>
                                            <a class="p-0 dropdown-item"
                                                href="{{ route('tax.edit', ['slug' => $company->slug, 'id' => $tax->id]) }}"><i
                                                    class="bx bx-edit"></i></a>



                                        </div>
                                        <div class="dropdown">

                                            <button type="button" class="py-0 btn pe-1 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>

                                            <div class="dropdown-menu">
                                                <form
                                                    id="deleteForm"
                                                    action="{{ route('tax.delete', ['slug' => $company->slug, 'id' => $tax->id]) }}"
                                                    method="POST" class="dropdown-item">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item deleteTax" type="submit">
                                                        <i class="bx bx-trash me-1"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>


                                        </div>



                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endunless
                </table>
            </div>
        </div>


    </div>

    <script>
        document.querySelectorAll('.deleteTax').forEach(function(button) {
            button.addEventListener('click', function (e) {
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
                }).then(function (result) {
                    if (result.isConfirmed) { // Use `isConfirmed` to check if confirmed
                        button.closest('form').submit(); // Submit the closest form to the button
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Tax has been deleted.',
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
{{-- <script>
    'use strict';

    $(function() {
        var maxlengthInput = $('.bootstrap-maxlength-example'),
            formRepeater = $('#tax-repeater');

        // Bootstrap Max Length
        // --------------------------------------------------------------------
        if (maxlengthInput.length) {
            maxlengthInput.each(function() {
                $(this).maxlength({
                    warningClass: 'label label-success bg-success text-white',
                    limitReachedClass: 'label label-danger',
                    separator: ' out of ',
                    preText: 'You typed ',
                    postText: ' chars available.',
                    validate: true,
                    threshold: +this.getAttribute('maxlength')
                });
            });
        }

        // Form Repeater
        // ! Using jQuery each loop to add dynamic id and class for inputs. You may need to improve it based on form fields.
        // -----------------------------------------------------------------------------------------------------------------

        if (formRepeater.length) {
            var row = 2;  // Row counter
            var col = 1;  // Column counter for the ids
            formRepeater.repeater({
                show: function() {
                    var fromControl = $(this).find('.form-control, .form-select');
                    var formLabel = $(this).find('.form-label');

                    // Update ids and 'for' attributes for form controls
                    fromControl.each(function(i) {
                        var id = 'form-repeater-' + row + '-' + col;
                        $(fromControl[i]).attr('id', id);
                        $(formLabel[i]).attr('for', id);
                        col++;
                    });

                    // Update radio button group name dynamically based on row index
                    $(this).find('input[type=radio]').each(function(i) {
                        var radioName = 'default-radio-' + row;  // Unique name for each row
                        $(this).attr('name', radioName);
                    });

                    row++;
                    $(this).slideDown();
                }
            });

            // Initially update radio buttons in the first row
            $('input[type=radio]').each(function(i) {
                var rowIndex = $(this).closest('[data-repeater-item]').index();
                $(this).attr('name', 'default-radio-' + rowIndex);  // Unique name for the first row radio buttons
            });
        }
    });
</script> --}}

{{-- script for clicking label and radio to select --}}
{{-- <script>
    'use strict';

    $(function() {
        var maxlengthInput = $('.bootstrap-maxlength-example'),
            formRepeater = $('#tax-repeater');

        // Bootstrap Max Length
        // --------------------------------------------------------------------
        if (maxlengthInput.length) {
            maxlengthInput.each(function() {
                $(this).maxlength({
                    warningClass: 'label label-success bg-success text-white',
                    limitReachedClass: 'label label-danger',
                    separator: ' out of ',
                    preText: 'You typed ',
                    postText: ' chars available.',
                    validate: true,
                    threshold: +this.getAttribute('maxlength')
                });
            });
        }

        // Form Repeater
        // ! Using jQuery each loop to add dynamic id and class for inputs. You may need to improve it based on form fields.
        // -----------------------------------------------------------------------------------------------------------------

        if (formRepeater.length) {
            var row = 2;  // Row counter
            var col = 1;  // Column counter for the ids

            formRepeater.repeater({
                show: function() {
                    var fromControl = $(this).find('.form-control, .form-select');
                    var formLabel = $(this).find('.form-label');

                    // Update ids and 'for' attributes for form controls
                    fromControl.each(function(i) {
                        var id = 'form-repeater-' + row + '-' + col;
                        $(fromControl[i]).attr('id', id);
                        $(formLabel[i]).attr('for', id);
                        col++;
                    });

                    // Update radio buttons and their labels
                    $(this).find('input[type=radio]').each(function(i) {
                        var radioId = 'defaultRadio' + row + '-' + i;  // Unique ID for each radio button
                        var radioName = 'default-radio-' + row;  // Unique name for each row
                        $(this).attr('id', radioId).attr('name', radioName);  // Set unique ID and name for each radio button

                        // Find corresponding label and update 'for' attribute
                        $(this).siblings('label').attr('for', radioId);
                    });

                    row++;
                    $(this).slideDown();
                }
            });

            // Initially update radio buttons and their labels for the first row
            $('input[type=radio]').each(function(i) {
                var rowIndex = $(this).closest('[data-repeater-item]').index();
                var radioId = 'defaultRadio' + rowIndex + '-' + i;
                $(this).attr('id', radioId).attr('name', 'default-radio-' + rowIndex);  // Unique ID and name for the first row
                $(this).siblings('label').attr('for', radioId);  // Update label's 'for' attribute
            });
        }
    });
</script> --}}


<script>
    'use strict';

    $(function() {
        var maxlengthInput = $('.bootstrap-maxlength-example'),
            formRepeater = $('.tax-repeater');

        // Bootstrap Max Length
        // --------------------------------------------------------------------
        if (maxlengthInput.length) {
            maxlengthInput.each(function() {
                $(this).maxlength({
                    warningClass: 'label label-success bg-success text-white',
                    limitReachedClass: 'label label-danger',
                    separator: ' out of ',
                    preText: 'You typed ',
                    postText: ' chars available.',
                    validate: true,
                    threshold: +this.getAttribute('maxlength')
                });
            });
        }

        // Form Repeater
        // -----------------------------------------------------------------------------------------------------------------
        if (formRepeater.length) {
            var row = 0;
            formRepeater.repeater({
                show: function() {
                    var $item = $(this);
                    row++;

                    // Update form control IDs and labels
                    $item.find('.form-control, .form-select').each(function(i) {
                        var $input = $(this);
                        var id = 'form-repeater-' + row + '-' + (i + 1);
                        $input.attr('id', id);
                        $input.prev('label').attr('for', id);
                    });

                    // Update radio button names and IDs
                    $item.find('input[type="radio"]').each(function() {
                        var $radio = $(this);
                        var newName = 'group_a[' + row + '][tax_type]';
                        var newId = $radio.attr('id') + '_' + row;
                        $radio.attr('name', newName).attr('id', newId);
                        $radio.next('label').attr('for', newId);
                    });

                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            // Initially update radio buttons in the first row
            $('[data-repeater-item]:first').find('input[type="radio"]').each(function() {
                var $radio = $(this);
                var newName = 'group_a[0][tax_type]';
                var newId = $radio.attr('id') + '_0';
                $radio.attr('name', newName).attr('id', newId);
                $radio.next('label').attr('for', newId);
            });
        }
    });
</script>

<script>
$(function() {
    $('#tax-repeater').on('submit', function(e) {
        let isValid = true;

        $('[data-repeater-item]').each(function(index) {
            const taxName = $(this).find('input[name^="group_a"][name$="[tax_name]"]');
            const taxPercentage = $(this).find('input[name^="group_a"][name$="[tax_percentage]"]');
            const taxType = $(this).find('input[name^="group_a"][name$="[tax_type]"]:checked');

            // Clear previous error messages
            $(this).find('.error').text('');

            // Validate tax name
            if (taxName.val().trim() === '') {
                isValid = false;
                taxName.addClass('is-invalid');
                $(this).find('[data-error="tax_name"]').text('Tax name is required.');
            } else if (taxName.val().length > 255) {
                isValid = false;
                taxName.addClass('is-invalid');
                $(this).find('[data-error="tax_name"]').text('Tax name must not exceed 255 characters.');
            } else {
                taxName.removeClass('is-invalid');
            }

            // Validate tax percentage
            const percentage = parseFloat(taxPercentage.val());
            if (isNaN(percentage) || taxPercentage.val().trim() === '') {
                isValid = false;
                taxPercentage.addClass('is-invalid');
                $(this).find('[data-error="tax_percentage"]').text('Tax percentage is required and must be a number.');
            } else if (percentage < 0 || percentage > 100) {
                isValid = false;
                taxPercentage.addClass('is-invalid');
                $(this).find('[data-error="tax_percentage"]').text('Tax percentage must be between 0 and 100.');
            } else {
                taxPercentage.removeClass('is-invalid');
            }

            // Validate tax type
            if (taxType.length === 0) {
                isValid = false;
                $(this).find('input[name^="group_a"][name$="[tax_type]"]').addClass('is-invalid');
                $(this).find('[data-error="tax_type"]').text('Please select a tax type.');
            } else if (!['primary', 'secondary'].includes(taxType.val())) {
                isValid = false;
                $(this).find('input[name^="group_a"][name$="[tax_type]"]').addClass('is-invalid');
                $(this).find('[data-error="tax_type"]').text('Invalid tax type selected.');
            } else {
                $(this).find('input[name^="group_a"][name$="[tax_type]"]').removeClass('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
        }
    });
});

</script>
