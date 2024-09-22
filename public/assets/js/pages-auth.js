/**
 *  Pages Authentication
 */

'use strict';
const formAuthentication = document.querySelector('#formAuthentication');
const companyFormAuthentication = document.querySelector('#companyFormAuthentication');

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // Form validation for Add new record
    if (formAuthentication) {
      const fv = FormValidation.formValidation(formAuthentication, {
        fields: {
          username: {
            validators: {
              notEmpty: {
                message: 'Please enter username'
              },
              stringLength: {
                min: 6,
                message: 'Username must be more than 6 characters'
              }
            }
          },
          fname: {
            validators: {
              notEmpty: {
                message: 'Please enter your first name'
              },
              stringLength: {
                min: 2,
                message: 'First name must be more than 2 characters'
              }
            }
          },
          lname: {
            validators: {
              notEmpty: {
                message: 'Please enter your last name'
              },
              stringLength: {
                min: 2,
                message: 'Last name must be more than 2 characters'
              }
            }
          },
          lname: {
            validators: {
              notEmpty: {
                message: 'Please enter your last name'
              },
              stringLength: {
                min: 2,
                message: 'Last name must be more than 2 characters'
              }
            }
          },
          email: {
            validators: {
              notEmpty: {
                message: 'Please enter your email'
              },
              emailAddress: {
                message: 'Please enter valid email address'
              }
            }
          },
          phone: {
            validators: {
              notEmpty: {
                message: 'Please enter your phone number'
              },
              stringLength: {
                message: 'Phone number should be between 7 and 10 digits',
                min: 7,
                max: 10,
              },
             
              regexp: {
                regexp: /^[0-9]+$/,
                message: 'Do not include country code, Phone number should only contain digits'
              }
            }
          },
          'email-username': {
            validators: {
              notEmpty: {
                message: 'Please enter email / username'
              },
              stringLength: {
                min: 6,
                message: 'Username must be more than 6 characters'
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: 'Please enter your password'
              },
              stringLength: {
                min: 6,
                message: 'Password must be more than 6 characters'
              }
            }
          },
          'confirm-password': {
            validators: {
              notEmpty: {
                message: 'Please confirm password'
              },
              identical: {
                compare: function () {
                  return formAuthentication.querySelector('[name="password"]').value;
                },
                message: 'The password and its confirm are not the same'
              },
              stringLength: {
                min: 6,
                message: 'Password must be more than 6 characters'
              }
            }
          },
          'password_confirmation': {
            validators: {
              notEmpty: {
                message: 'Please confirm password'
              },
              identical: {
                compare: function () {
                  return formAuthentication.querySelector('[name="password"]').value;
                },
                message: 'The password and its confirm are not the same'
              },
              stringLength: {
                min: 6,
                message: 'Password must be more than 6 characters'
              }
            }
          },
          terms: {
            validators: {
              notEmpty: {
                message: 'Please agree terms & conditions'
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-3'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),

          defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
          autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      });
    }

    //  Two Steps Verification
    const numeralMask = document.querySelectorAll('.numeral-mask');

    // Verification masking
    if (numeralMask.length) {
      numeralMask.forEach(e => {
        new Cleave(e, {
          numeral: true
        });
      });
    }
  })();
});

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // Form validation for Add new record
    if (companyFormAuthentication) {
      const fv = FormValidation.formValidation(companyFormAuthentication, {
        fields: {
          name: {
            validators: {
              notEmpty: {
                message: 'Please enter company name'
              },
              stringLength: {
                min: 3,
                message: 'Company must be more than 3 characters'
              }
            }
          },
          gps_address: {
            validators: {
              notEmpty: {
                message: 'Please enter company address'
              },
              stringLength: {
                min: 2,
                message: 'Address must be more than 2 characters'
              }
            }
          },
          website: {
            validators: {
              notEmpty: {
                message: 'Please enter company website'
              },
              stringLength: {
                min: 2,
                message: 'Website must be more than 2 characters'
              },
              uri: {
                protocol: 'http,https',
                message: 'Please enter a valid website address (e.g., https://www.example.com)'
              }
            }
          },
          address: {
            validators: {
              notEmpty: {
                message: 'Please enter box address'
              },
              stringLength: {
                min: 2,
                message: 'Address must be more than 2 characters'
              }
            }
          },
          email: {
            validators: {
              notEmpty: {
                message: 'Please enter your email'
              },
              emailAddress: {
                message: 'Please enter valid email address'
              }
            }
          },
          phone: {
            validators: {
              notEmpty: {
                message: 'Please enter your phone number'
              },
              stringLength: {
                message: 'Phone number should be between 7 and 10 digits',
                min: 7,
                max: 10,
              },
             
              regexp: {
                regexp: /^[0-9]+$/,
                message: 'Do not include country code, Phone number should only contain digits'
              }
            }
          },
          logo: {
            validators: {
              notEmpty: {
                message: 'Please select an image'
              },
              file: {
                extension: 'jpg,jpeg,png,gif',
                type: 'image/jpeg,image/png,image/gif',
                maxSize: 819200,   // 800KB in bytes
                message: 'The selected file is not valid. It should be a JPG, PNG or GIF file, and must not exceed 800KB.'
              }
            }
          },
          description: {
            validators: {
              notEmpty: {
                message: 'Please enter a description'
              },
              stringLength: {
                min: 10,
                max: 150,
                message: 'Description must be between 10 and 150 characters'
              }
            }
          },
          password: {
            validators: {
              notEmpty: {
                message: 'Please enter your password'
              },
              stringLength: {
                min: 6,
                message: 'Password must be more than 6 characters'
              }
            }
          },
          'confirm-password': {
            validators: {
              notEmpty: {
                message: 'Please confirm password'
              },
              identical: {
                compare: function () {
                  return companyFormAuthentication.querySelector('[name="password"]').value;
                },
                message: 'The password and its confirm are not the same'
              },
              stringLength: {
                min: 6,
                message: 'Password must be more than 6 characters'
              }
            }
          },
          'password_confirmation': {
            validators: {
              notEmpty: {
                message: 'Please confirm password'
              },
              identical: {
                compare: function () {
                  return companyFormAuthentication.querySelector('[name="password"]').value;
                },
                message: 'The password and its confirm are not the same'
              },
              stringLength: {
                min: 6,
                message: 'Password must be more than 6 characters'
              }
            }
          },
          terms: {
            validators: {
              notEmpty: {
                message: 'Please agree terms & conditions'
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-3'
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),

          defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
          autoFocus: new FormValidation.plugins.AutoFocus()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      });
    }

    //  Two Steps Verification
    const numeralMask = document.querySelectorAll('.numeral-mask');

    // Verification masking
    if (numeralMask.length) {
      numeralMask.forEach(e => {
        new Cleave(e, {
          numeral: true
        });
      });
    }
  })();
});
