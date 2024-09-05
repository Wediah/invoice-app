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
      hide: function (e) {
        $(this).slideUp();
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
    var contactPerson = $('input[name="contact_person"]').val();
    var companyName = $('input[name="company_name"]').val();
    var companyAddress = $('input[name="company_address"]').val();
    var companyEmail = $('input[name="company_email"]').val();
    var companyPhone = $('input[name="company_phone"]').val();
    var faxNumber = $('input[name="fax_number"]').val();

    // Display the captured values in another part of your page
    $('#displayArea').html(
      '<p class="mb-2"><span class="h6 me-2"> Contact Person:</span>' + contactPerson + '</p>' +
      '<p class="mb-2"><span class="h6 me-2">Company Name: </span>' + companyName + '</p>' +
      '<p class="mb-2"><span class="h6 me-2">Company Address: </span>' + companyAddress + '</p>' +
      '<p class="mb-2"><span class="h6 me-2">Company Email: </span>' + companyPhone + '</p>' +
      '<p class="mb-2"><span class="h6 me-2">Company Phone: </span>' + companyEmail + '</p>' +
      '<p class="mb-0"><span class="h6 me-4"> Fax Number:</span>' + faxNumber + '</p>'
    );

    $('#modalCenter').modal('hide'); // Optional: Close the modal after applying changes
  });
});



// selecting item 

// $(document).ready(function() {
//   // Function to update the total price
//   function updateTotalPrice($row) {
//       var price = parseFloat($row.find('.invoice-item-price').val()) || 0;
//       var quantity = parseInt($row.find('.quantity').val()) || 1; // Make sure to pick up the quantity from the right class
//       var totalPrice = price * quantity;

//       // Update the Sub Total input field
//       $row.find('.invoice-item-sub_total').val(totalPrice.toFixed(2)); // Updates the sub total
//   }

//   // Handler for item selection changes to fetch price
//   $(document).on('change', '.item-detailsX', function() {
//       var itemId = $(this).val();
//       var $row = $(this).closest('.repeater-wrapper');

//       // AJAX request to get the price
//       $.ajax({
//           url: '/get-price',
//           type: 'GET',
//           data: { id: itemId },
//           success: function(response) {
//               if (response.price) {
//                   $row.find('.invoice-item-price').val(response.price);
//                   updateTotalPrice($row); // Update total immediately after fetching price
//               }
//           },
//           error: function(xhr) {
//               console.error("Error fetching price:", xhr.responseText);
//           }
//       });
//   });

//   // Listener for quantity changes
//   $(document).on('input change', '.quantity', function() {
//       var $row = $(this).closest('.repeater-wrapper');
//       updateTotalPrice($row); // Update total whenever quantity changes
//   });
// });

// $(document).ready(function() {
//   // Function to update the total price, now including more detailed debugging
//   function updateTotalPrice($row) {
//       var price = parseFloat($row.find('.invoice-item-price').val()) || 0;
//       var quantity = parseInt($row.find('.quantity').val()) || 1;
//       var discountText = $row.find('.discount').text();
//       var discountPercent = parseFloat(discountText.replace('%', '')) || 0;
//       var subTotal = price * quantity;
//       var discountAmount = subTotal * (discountPercent / 100);
//       var totalAfterDiscount = subTotal - discountAmount;

//       console.log("Price: ", price);
//       console.log("Quantity: ", quantity);
//       console.log("Discount Text: ", discountText);
//       console.log("Discount Percent: ", discountPercent);
//       console.log("Sub Total: ", subTotal);
//       console.log("Discount Amount: ", discountAmount);
//       console.log("Total After Discount: ", totalAfterDiscount);

//       // Update the Sub Total input field with the calculated total after applying the discount
//       $row.find('.invoice-item-sub_total').val(totalAfterDiscount.toFixed(2));
//   }

//   // Handler for item selection changes to fetch price
//   $(document).on('change', '.item-detailsX', function() {
//       var itemId = $(this).val();
//       var $row = $(this).closest('.repeater-wrapper');
//       console.log("Item ID selected: ", itemId);

//       // AJAX request to get the price of the selected item
//       $.ajax({
//           url: '/get-price',
//           type: 'GET',
//           data: { id: itemId },
//           success: function(response) {
//               console.log("Price response: ", response);
//               if (response.price) {
//                   $row.find('.invoice-item-price').val(response.price);
//                   updateTotalPrice($row); // Update total immediately after fetching price
//               }
//           },
//           error: function(xhr) {
//               console.error("Error fetching price: ", xhr.responseText);
//           }
//       });
//   });

//   // Listener for quantity changes
//   $(document).on('input change', '.quantity', function() {
//       var $row = $(this).closest('.repeater-wrapper');
//       updateTotalPrice($row); // Update total whenever quantity changes
//   });

//   // Ensure this code snippet matches how you actually update the discount in your application
//   // If discount is updated elsewhere and not through direct input, consider the appropriate event to listen on
//   $(document).on('input change', '#discountInput', function() {
//       var discountValue = $(this).val() + '%';
//       $('.discount').text(discountValue); // Assuming all discounts on page need update; adjust if necessary
//       console.log("Discount Updated to: ", discountValue);
//   });
// });



$(document).ready(function() {
  // Function to update the total price
  function updateTotalPrice($row) {
      var price = parseFloat($row.find('.invoice-item-price').val()) || 0;
      var quantity = parseInt($row.find('.quantity').val()) || 1;
      var discountText = $row.find('.discount').text();
      var discountPercent = parseFloat(discountText.replace('%', '')) || 0;
      var subTotal = price * quantity;
      var discountAmount = subTotal * (discountPercent / 100);
      var totalAfterDiscount = subTotal - discountAmount;

      // Update the Sub Total input field with the calculated total after applying the discount
      $row.find('.invoice-item-sub_total').val(totalAfterDiscount.toFixed(2));
  }

  // Handler for item selection changes to fetch price
  $(document).on('change', '.item-detailsX', function() {
      var itemId = $(this).val();
      var $row = $(this).closest('.repeater-wrapper');

      // AJAX request to get the price of the selected item
      $.ajax({
          url: '/get-price',
          type: 'GET',
          data: { id: itemId },
          success: function(response) {
              if (response.price) {
                  $row.find('.invoice-item-price').val(response.price);
                  updateTotalPrice($row); // Update total immediately after fetching price
              }
          },
          error: function(xhr) {
              console.error("Error fetching price:", xhr.responseText);
          }
      });
  });

  // Listener for quantity changes
  $(document).on('input change', '.quantity', function() {
      var $row = $(this).closest('.repeater-wrapper');
      updateTotalPrice($row); // Update total whenever quantity changes
  });

  // Apply discount changes and immediately update the subtotal
  $(document).on('click', '.btn-apply-changes', function() {
      var $modal = $(this).closest('.dropdown-menu');
      var discountInput = $modal.find('#discountInput').val();
      var $row = $modal.closest('.repeater-wrapper');

      $row.find('.discount').text(discountInput + '%'); // Update the discount display
      updateTotalPrice($row); // Update the subtotal immediately when the discount is applied
  });
});

$(document).ready(function() {
  // Function to update all calculations
  function updateCalculations() {
      var totalSubtotal = 0;
      var totalDiscount = 0;
      var totalTax = 0; // Initialize if you have a method to calculate tax

      $('.repeater-wrapper').each(function() {
          var price = parseFloat($(this).find('.invoice-item-price').val()) || 0;
          var quantity = parseInt($(this).find('.quantity').val()) || 0;
          var discountPercentage = parseFloat($(this).find('.discount').text().replace('%', '')) || 0;

          var subtotal = price * quantity;
          var discountAmount = subtotal * (discountPercentage / 100);
          var taxAmount = 0; // Calculate tax if applicable

          totalSubtotal += subtotal;
          totalDiscount += discountAmount;
          totalTax += taxAmount; // Update total tax calculation as needed
      });

      // Update the totals in the invoice summary
      $('.invoice-calculations').find('.subtotal').text('$' + totalSubtotal.toFixed(2));
      $('.invoice-calculations').find('.discount').text('$' + totalDiscount.toFixed(2));
      $('.invoice-calculations').find('.tax').text('$' + totalTax.toFixed(2));

      var totalDue = totalSubtotal - totalDiscount + totalTax;
      $('.invoice-calculations').find('.total').text('$' + totalDue.toFixed(2));
  }

  // Event listeners that trigger the recalculation
  $(document).on('input change', '.invoice-item-price, .quantity, .discount', function() {
      updateCalculations(); // Update calculations on any change in price, quantity, or discount
  });

  $(document).on('click', '.btn-apply-changes', function() {
      updateCalculations(); // Ensure calculations are updated when discounts are applied through modal
  });

  // Initial calculation call on page load or when items are added dynamically
  updateCalculations();
});



