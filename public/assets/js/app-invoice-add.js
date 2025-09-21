/**
 * App Invoice - Add
 */

'use strict';

(function () {
  const invoiceItemPriceList = document.querySelectorAll('.invoice-item-price'),
    invoiceItemQtyList = document.querySelectorAll('.invoice-item-qty'),
    invoiceDateList = document.querySelectorAll('.date-picker');

  // Price
  if (invoiceItemPriceList) {
    invoiceItemPriceList.forEach(function (invoiceItemPrice) {
      new Cleave(invoiceItemPrice, {
        delimiter: '',
        numeral: true
      });
    });
  }

  // Qty
  if (invoiceItemQtyList) {
    invoiceItemQtyList.forEach(function (invoiceItemQty) {
      new Cleave(invoiceItemQty, {
        delimiter: '',
        numeral: true
      });
    });
  }

  // Datepicker
  if (invoiceDateList) {
    invoiceDateList.forEach(function (invoiceDateEl) {
      invoiceDateEl.flatpickr({
        monthSelectorType: 'static'
      });
    });
  }
})();

// repeater (jquery)
$(function () {
  var applyChangesBtn = $('.btn-apply-changes'),
    discount,
    tax1,
    tax2,
    discountInput,
    tax1Input,
    tax2Input,
    sourceItem = $('.source-item'),
    adminDetails = {
      'App Design': 'Designed UI kit & app pages.',
      'App Customization': 'Customization & Bug Fixes.',
      'ABC Template': 'Bootstrap 4 admin template.',
      'App Development': 'Native App Development.'
    };

  // Prevent dropdown from closing on tax change
  $(document).on('click', '.tax-select', function (e) {
    e.stopPropagation();
  });

  // On tax change update it's value value
  function updateValue(listener, el) {
    listener.closest('.repeater-wrapper').find(el).text(listener.val());
  }

  // Apply item changes btn
  if (applyChangesBtn.length) {
    $(document).on('click', '.btn-apply-changes', function (e) {
      var $this = $(this);
      tax1Input = $this.closest('.dropdown-menu').find('#taxInput1');
      tax2Input = $this.closest('.dropdown-menu').find('#taxInput2');
      discountInput = $this.closest('.dropdown-menu').find('#discountInput');
      tax1 = $this.closest('.repeater-wrapper').find('.tax-1');
      tax2 = $this.closest('.repeater-wrapper').find('.tax-2');
      discount = $('.discount');

      if (tax1Input.val() !== null) {
        updateValue(tax1Input, tax1);
      }

      if (tax2Input.val() !== null) {
        updateValue(tax2Input, tax2);
      }

      if (discountInput.val().length) {
        $this
          .closest('.repeater-wrapper')
          .find(discount)
          .text(discountInput.val() + '%');
      }
    });
  }

  // Repeater init
  if (sourceItem.length) {
    sourceItem.on('submit', function (e) {
      e.preventDefault();
    });
    sourceItem.repeater({
      show: function () {
        $(this).slideDown();
        // Initialize tooltip on load of each item
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Initialize Select2 on the new row's item dropdown
        setTimeout(() => {
          const $newRow = $(this);
          const $itemSelect = $newRow.find('.item-detailsX');
          if ($itemSelect.length && !$itemSelect.hasClass('select2-hidden-accessible')) {
            initializeSelect2ForElement($itemSelect);
          }
        }, 100);
      },
      hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
        // Remove the row from DOM after animation
        setTimeout(() => {
          $(this).remove();
          // Update calculations after removing the row
          updateCalculations();
        }, 500);
      }
    });
  }

  // Item details select onchange
  $(document).on('change', '.item-details', function () {
    var $this = $(this),
      value = adminDetails[$this.val()];
    if ($this.next('textarea').length) {
      $this.next('textarea').val(value);
    } else {
      $this.after('<textarea class="form-control" rows="2">' + value + '</textarea>');
    }
  });
});



//Invoice To (Jquery)


$(document).ready(function () {
  function toggleApplyButton() {
    // Check if any input has a value
    var isAnyFieldFilled = false;
    $('#modalCenter input').each(function () {
      if ($(this).val().trim() !== '') {
        isAnyFieldFilled = true;
      }
    });

    // Enable or disable the apply button based on whether any fields are filled
    $('#invoiceTo').prop('disabled', !isAnyFieldFilled);
  }

  // Initial check when modal is opened
  $('#modalCenter').on('shown.bs.modal', function () {
    toggleApplyButton(); // Initial state check
  });

  // Check on input change
  $('#modalCenter input').on('input', function () {
    toggleApplyButton();
  });
  $('#invoiceTo').click(function () { // Event listener for the 'Apply changes' button
    // Capture the input values
    var customerName = $('input[name="customer_name"]').val();
    var customerEmail = $('input[name="customer_email"]').val();
    var customerAddress = $('input[name="customer_address"]').val();
    var customerMobile = $('input[name="customer_mobile"]').val();
    var customerPhone = $('input[name="customer_phone"]').val();
    // var faxNumber = $('input[name="fax_number"]').val();

    // Display the captured values in another part of your page
    $('#displayArea').html(
      '<p class="mb-2"><span class="h6 me-2"> Customer Name:</span>' + customerName + '</p>' +
      '<p class="mb-2"><span class="h6 me-2">Customer Email: </span>' + customerEmail + '</p>' +
      '<p class="mb-2"><span class="h6 me-2">Customer Address: </span>' + customerAddress + '</p>' +
      '<p class="mb-2"><span class="h6 me-2">Customer Mobile: </span>' + customerMobile + '</p>' +
      '<p class="mb-2"><span class="h6 me-2">Customer Phone: </span>' + customerPhone + '</p>'
      // '<p class="mb-0"><span class="h6 me-4"> Fax Number:</span>' + faxNumber + '</p>'
    );

    $('#modalCenter').modal('hide'); // Optional: Close the modal after applying changes
  });
});



//Invoice To (Jquery)

$(document).ready(function () {
  // Cache frequently used jQuery selectors
  const $invoiceCalculations = $('.invoice-calculations');
  const $taxList = $('#tax-list');
  const $subtotalDisplay = $invoiceCalculations.find('.subtotal');
  const $discountDisplay = $invoiceCalculations.find('.discount');
  const $taxDisplay = $invoiceCalculations.find('.tax');
  const $totalDisplay = $invoiceCalculations.find('.total');

  // Debounce function to limit the rate at which a function can fire
  function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
      const later = () => {
        clearTimeout(timeout);
        func(...args);
      };
      clearTimeout(timeout);
      timeout = setTimeout(later, wait);
    };
  }

  // Function to update the total price for a single row
  function updateTotalPrice($row) {
    const price = parseFloat($row.find('.invoice-item-price').val()) || 0;
    const quantity = parseInt($row.find('.quantity').val()) || 1;
    const discountPercent = parseFloat($row.find('.discount').text()) || 0;
    const subTotal = price * quantity;
    const totalAfterDiscount = subTotal * (1 - discountPercent / 100);
    $row.find('.invoice-item-sub_total').val(totalAfterDiscount.toFixed(2));
    debouncedUpdateCalculations(); // Call this to update overall calculations
  }
  // Function to update all calculations
  function updateCalculations() {
    let totalSubtotal = 0;
    let totalDiscount = 0;

    // Calculate totals for each row
    $('.repeater-wrapper').each(function () {
      const $row = $(this);
      const price = parseFloat($row.find('.invoice-item-price').val()) || 0;
      const quantity = parseInt($row.find('.quantity').val()) || 0;
      const discountPercentage = parseFloat($row.find('.discount').text()) || 0;

      const subtotal = price * quantity;
      const discountAmount = subtotal * (discountPercentage / 100);

      totalSubtotal += subtotal;
      totalDiscount += discountAmount;
    });

    // Update the display of subtotal and discount
    $subtotalDisplay.text(`${totalSubtotal.toFixed(2)}`);
    $discountDisplay.text(`${totalDiscount.toFixed(2)}`);

    // Recalculate the total including taxes
    calculateTotal();
  }

  // Create a debounced version of updateCalculations
  const debouncedUpdateCalculations = debounce(updateCalculations, 300);

  // Function to calculate the final total including taxes
  function calculateTotal() {
    const subtotal = parseFloat($subtotalDisplay.text()) || 0;
    const discount = parseFloat($discountDisplay.text()) || 0;
    let primaryTaxTotal = 0;
    let secondaryTaxTotal = 0;
    const primaryTaxes = [];
    const secondaryTaxes = [];

    const subtotalAfterDiscount = subtotal - discount;

    // Calculate primary taxes first
    $('input[name="tax_ids[]"]:checked').each(function () {
      const $taxLabel = $(this).closest('.d-flex').find('label');
      const taxName = $taxLabel.clone().children().remove().end().text().trim();
      const taxRate = parseFloat($taxLabel.text().match(/(\d+)%/)[1]);
      const isSecondary = $taxLabel.hasClass('bg-label-warning');

      if (!isSecondary) {
        const taxAmount = subtotalAfterDiscount * (taxRate / 100);
        primaryTaxTotal += taxAmount;
        primaryTaxes.push({ name: taxName, amount: taxAmount });
      }
    });

    const subtotalAfterPrimaryTax = subtotalAfterDiscount + primaryTaxTotal;

    // Calculate secondary taxes
    $('input[name="tax_ids[]"]:checked').each(function () {
      const $taxLabel = $(this).closest('.d-flex').find('label');
      const taxName = $taxLabel.clone().children().remove().end().text().trim();
      const taxRate = parseFloat($taxLabel.text().match(/(\d+)%/)[1]);
      const isSecondary = $taxLabel.hasClass('bg-label-warning');

      if (isSecondary) {
        const taxAmount = subtotalAfterPrimaryTax * (taxRate / 100);
        secondaryTaxTotal += taxAmount;
        secondaryTaxes.push({ name: taxName, amount: taxAmount });
      }
    });
    // Update tax list display
    $taxList.empty();
    primaryTaxes.forEach(tax => {
      $taxList.append(`
              <div class="mb-2 d-flex justify-content-between">
                  <span class="me-5">${tax.name}</span>
                  <span>${tax.amount.toFixed(2)}</span>
              </div>
          `);
    });
    secondaryTaxes.forEach(tax => {
      $taxList.append(`
              <div class="mb-2 d-flex justify-content-between">
                  <span class="me-5">${tax.name}</span>
                  <span>${tax.amount.toFixed(2)}</span>
              </div>
          `);
    });
    const totalTax = primaryTaxTotal + secondaryTaxTotal;
    const totalDue = subtotalAfterDiscount + totalTax;

    // Update totals
    $taxDisplay.text(`${totalTax.toFixed(2)}`);
    $totalDisplay.text(`${totalDue.toFixed(2)}`);
    $('#total_hidden_input').val(totalDue.toFixed(2));
    $('#subtotal_hidden_input').val(subtotal.toFixed(2));
    $('#discount_total_hidden_input').val(discount.toFixed(2));
    $('#subtotalAfterDiscount_hidden_input').val(subtotalAfterDiscount.toFixed(2));
    $('#tax_total_hidden_input').val(totalTax.toFixed(2));
  }

  // Event handler for item selection changes
  $(document).on('change', '.item-detailsX', function () {
    const itemId = $(this).val();
    const $row = $(this).closest('.repeater-wrapper');

    // AJAX request to get the price of the selected item
    $.ajax({
      url: '/get-price',
      type: 'GET',
      data: { id: itemId },
      success: function (response) {
        if (response.price) {
          $row.find('.invoice-item-price').val(response.price);
          updateTotalPrice($row);
          debouncedUpdateCalculations();
        }
      },
      error: function (xhr) {
        console.error("Error fetching price:", xhr.responseText);
      }
    });
  });



  $(document).on('input change', '.quantity', function () {
    const $row = $(this).closest('.repeater-wrapper');
    updateTotalPrice($row);
  });
  
  $(document).on('input change', '.invoice-item-price, .discount', debouncedUpdateCalculations);

  // Event listener for applying discount changes
  $(document).on('click', '.btn-apply-changes', function () {
    const $modal = $(this).closest('.dropdown-menu');
    const discountInput = $modal.find('#discountInput').val();
    const $row = $modal.closest('.repeater-wrapper');

    $row.find('.discount').text(discountInput + '%');
    updateTotalPrice($row);
    debouncedUpdateCalculations();
  });

  // Event listener for tax changes
  $('input[name="tax_ids[]"]').change(calculateTotal);

  // Initial calculation on page load
  updateCalculations();
});



//disable hide button if quantity is entered
$(document).ready(function () {
  $(document).on('input', '.quantity', function () {
    const $row = $(this).closest('.repeater-wrapper');
    const $hideRepeater = $row.find('#hide-repeater');

    if ($(this).val() && $(this).val() !== '0') {
      $hideRepeater.prop('disabled', true);
      $hideRepeater.attr('title', 'To hide this row, please clear quantity first');
    } else {
      $hideRepeater.prop('disabled', false);
      $hideRepeater.attr('title', 'Hide this row');
    }
  });

  // Trigger the input event on page load to set initial state
  $('.quantity').trigger('input');
});

// Handle Select2 item selection for price updates
$(document).on('select2:select', '.item-detailsX', function (e) {
  var data = e.params.data;
  var $row = $(this).closest('.repeater-wrapper');
  var itemId = data.id;
  
  // Handle "Add New Item" selection
  if (data.isAddNew) {
    openQuickAddModalForRepeater(data.searchTerm, $(this));
    return;
  }
  
  // Update the select value to trigger the existing change event
  $(this).val(itemId).trigger('change');
  
  // Also directly update the price field for immediate feedback
  if (data.price) {
    $row.find('.invoice-item-price').val(data.price);
    // Trigger the existing calculation functions if they exist
    if (typeof updateTotalPrice === 'function') {
      updateTotalPrice($row);
    }
    if (typeof debouncedUpdateCalculations === 'function') {
      debouncedUpdateCalculations();
    }
  }
});

// Function to initialize Select2 for a specific element
function initializeSelect2ForElement($element) {
  if ($element.length && !$element.hasClass('select2-hidden-accessible')) {
    // Get the company slug from the current page URL or a global variable
    const companySlug = window.location.pathname.split('/')[1] || 'default';
    
    $element.select2({
      placeholder: 'Search or select an item...',
      allowClear: true,
      width: '100%',
      ajax: {
        url: `/catalog/${companySlug}/search`,
        dataType: 'json',
        delay: 300,
        data: function (params) {
          return {
            q: params.term || '',
            page: params.page || 1
          };
        },
        processResults: function (data, params) {
          params.page = params.page || 1;
          
          var results = data.results.map(function(item) {
            return {
              id: item.id,
              text: item.name + ' - ' + item.price + ' GHS',
              name: item.name,
              price: item.price,
              description: item.description,
              unit: item.unit_of_measurement,
              status: item.status
            };
          });
          
          // Add "Add New Item" option when no results and user has typed something
          if (results.length === 0 && params.term && params.term.trim().length > 0) {
            results.push({
              id: 'add_new',
              text: '+ Add "' + params.term + '" as new item',
              isAddNew: true,
              searchTerm: params.term
            });
          }
          
          return {
            results: results,
            pagination: {
              more: data.pagination.more
            }
          };
        },
        cache: true
      },
      minimumInputLength: 0,
      templateResult: formatItemForSelect2,
      templateSelection: function(item) {
        return item.text || item.name;
      },
      escapeMarkup: function (markup) {
        return markup;
      },
      language: {
        inputTooShort: function () {
          return 'Type to search or browse all items';
        },
        noResults: function () {
          return 'No items found';
        },
        searching: function () {
          return 'Searching...';
        }
      }
    });
  }
}

// Function to format items for Select2 display
function formatItemForSelect2(item) {
  if (item.loading) {
    return '<div class="select2-result-item"><div class="select2-result-item__title">Loading...</div></div>';
  }

  // Handle "Add New Item" option
  if (item.isAddNew) {
    return '<div class="select2-result-item d-flex align-items-center">' +
      '<div class="flex-grow-1">' +
        '<div class="select2-result-item__title fw-semibold text-primary">' + item.text + '</div>' +
        '<div class="text-muted small">Click to add this item to your catalog</div>' +
      '</div>' +
      '<div class="text-end">' +
        '<i class="bx bx-plus-circle text-primary"></i>' +
      '</div>' +
    '</div>';
  }

  var statusColor = '';
  var statusText = '';
  if (item.status) {
    switch(item.status) {
      case 'in_stock':
        statusColor = 'text-success';
        statusText = 'In Stock';
        break;
      case 'out_of_stock':
        statusColor = 'text-danger';
        statusText = 'Out of Stock';
        break;
      case 'limited':
        statusColor = 'text-warning';
        statusText = 'Limited';
        break;
      default:
        statusColor = 'text-muted';
        statusText = item.status;
    }
  }

  var markup = '<div class="select2-result-item d-flex justify-content-between align-items-start">' +
    '<div class="flex-grow-1">' +
      '<div class="select2-result-item__title fw-semibold">' + item.name + '</div>';
  
  if (item.description) {
    markup += '<div class="mt-1 select2-result-item__description text-muted small">' + item.description + '</div>';
  }
  
  if (item.unit) {
    markup += '<div class="text-muted small">Unit: ' + item.unit + '</div>';
  }
  
  markup += '</div>' +
    '<div class="text-end">' +
      '<div class="fw-bold text-primary">' + item.price + ' GHS</div>';
  
  if (statusText) {
    markup += '<div class="small' + statusColor + '">' + statusText + '</div>';
  }
  
  markup += '</div></div>';
  return markup;
}

// Quick Add Modal Functions for Repeater
var currentRepeaterSelectElement = null;

function openQuickAddModalForRepeater(searchTerm, $selectElement) {
  currentRepeaterSelectElement = $selectElement;
  
  // Pre-fill the name field with search term
  $('#quickAddName').val(searchTerm);
  $('#quickAddPrice').val('');
  $('#quickAddDescription').val('');
  $('#quickAddUnit').val('pcs');
  $('#quickAddStatus').val('in_stock');
  
  // Clear any previous error states
  $('#quickAddForm .is-invalid').removeClass('is-invalid');
  $('#quickAddForm .invalid-feedback').remove();
  
  // Show the modal
  $('#quickAddModal').modal('show');
  
  // Focus on price field
  setTimeout(() => {
    $('#quickAddPrice').focus();
  }, 500);
}

// Handle quick add form submission for repeater
$(document).on('click', '#saveQuickAdd', function() {
  var $button = $(this);
  var $spinner = $('#quickAddSpinner');
  var $buttonText = $('#quickAddButtonText');
  
  // Validate form
  if (!validateQuickAddFormForRepeater()) {
    return;
  }
  
  // Show loading state
  $button.prop('disabled', true);
  $spinner.removeClass('d-none');
  $buttonText.text('Saving...');
  
  // Get company slug from URL
  const companySlug = window.location.pathname.split('/')[1] || 'default';
  
  // Prepare form data
  var formData = {
    name: $('#quickAddName').val(),
    price: $('#quickAddPrice').val(),
    description: $('#quickAddDescription').val(),
    unit_of_measurement: $('#quickAddUnit').val(),
    status: $('#quickAddStatus').val(),
    _token: $('meta[name="csrf-token"]').attr('content')
  };
  
  // Submit AJAX request
  $.ajax({
    url: `/catalog/${companySlug}/quick-add`,
    type: 'POST',
    data: formData,
    success: function(response) {
      if (response.success) {
        // Close modal
        $('#quickAddModal').modal('hide');
        
        // Show success toast
        if (typeof window.Toast !== 'undefined') {
          window.Toast.success(response.message);
        }
        
        // Add the new item to Select2 and select it
        addItemToSelect2AndSelectForRepeater(response.item, currentRepeaterSelectElement);
      }
    },
    error: function(xhr) {
      var errors = xhr.responseJSON?.errors || {};
      displayQuickAddErrorsForRepeater(errors);
    },
    complete: function() {
      // Reset button state
      $button.prop('disabled', false);
      $spinner.addClass('d-none');
      $buttonText.text('Save & Add to Invoice');
    }
  });
});

function validateQuickAddFormForRepeater() {
  var isValid = true;
  
  // Clear previous errors
  $('#quickAddForm .is-invalid').removeClass('is-invalid');
  $('#quickAddForm .invalid-feedback').remove();
  
  // Validate name
  if (!$('#quickAddName').val().trim()) {
    showFieldErrorForRepeater('#quickAddName', 'Item name is required');
    isValid = false;
  }
  
  // Validate price
  var price = parseFloat($('#quickAddPrice').val());
  if (!price || price < 0) {
    showFieldErrorForRepeater('#quickAddPrice', 'Please enter a valid price');
    isValid = false;
  }
  
  return isValid;
}

function showFieldErrorForRepeater(fieldSelector, message) {
  var $field = $(fieldSelector);
  $field.addClass('is-invalid');
  $field.after('<div class="invalid-feedback">' + message + '</div>');
}

function displayQuickAddErrorsForRepeater(errors) {
  // Clear previous errors
  $('#quickAddForm .is-invalid').removeClass('is-invalid');
  $('#quickAddForm .invalid-feedback').remove();
  
  // Display new errors
  $.each(errors, function(field, messages) {
    var fieldSelector = '#quickAdd' + field.charAt(0).toUpperCase() + field.slice(1);
    showFieldErrorForRepeater(fieldSelector, messages[0]);
  });
}

function addItemToSelect2AndSelectForRepeater(item, $selectElement) {
  // Create new option
  var newOption = new Option(
    item.name + ' - ' + item.price + ' GHS',
    item.id,
    true,
    true
  );
  
  // Add option to select
  $selectElement.append(newOption).trigger('change');
  
  // Update price field
  var $row = $selectElement.closest('.repeater-wrapper');
  $row.find('.invoice-item-price').val(item.price);
  
  // Trigger calculations
  if (typeof updateTotalPrice === 'function') {
    updateTotalPrice($row);
  }
  if (typeof debouncedUpdateCalculations === 'function') {
    debouncedUpdateCalculations();
  }
}

// Reset modal when closed
$(document).on('hidden.bs.modal', '#quickAddModal', function() {
  $('#quickAddForm')[0].reset();
  $('#quickAddForm .is-invalid').removeClass('is-invalid');
  $('#quickAddForm .invalid-feedback').remove();
  currentRepeaterSelectElement = null;
});
