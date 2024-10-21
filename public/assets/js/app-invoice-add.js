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
              <div class="d-flex justify-content-between mb-2">
                  <span class="me-5">${tax.name}</span>
                  <span>${tax.amount.toFixed(2)}</span>
              </div>
          `);
    });
    secondaryTaxes.forEach(tax => {
      $taxList.append(`
              <div class="d-flex justify-content-between mb-2">
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
