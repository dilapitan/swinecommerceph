'use strict';

var validateFunction = function(){

    return function(){
        var validateInput = function(inputElement){

            // Extract index from id of input element of existing(/to be added) farm information
            // to be used for the computed property
            // of validations object
            var index = 1;
            index = (inputElement.id.includes('-')) ? inputElement.id.match(/\d+/)[0]: index;
            index = (inputElement.id.includes('[')) ? inputElement.id.match(/\d+/)[0]: index;

            // Initialize needed validations
            var validations = {
                address_addressLine1: ['required'],
                address_addressLine2: ['required'],
                address_zipCode: ['required', 'zipCodePh'],
                // landline: ['landline'],
                mobile: ['required', 'phoneNumber'],
                ['farm-' + index + '-name']: ['required'],
                ['farm-' + index + '-addressLine1']: ['required'],
                ['farm-' + index + '-addressLine2']: ['required'],
                ['farm-' + index + '-zipCode']: ['required', 'zipCodePh'],
                ['farm-' + index + '-farmType']: ['required'],
                ['farm-' + index + '-mobile']: ['required', 'phoneNumber'],
                ['farmAddress[' + index + '][name]']: ['required'],
                ['farmAddress[' + index + '][addressLine1]']: ['required'],
                ['farmAddress[' + index + '][addressLine2]']: ['required'],
                ['farmAddress[' + index + '][zipCode]']: ['required', 'zipCodePh'],
                ['farmAddress[' + index + '][farmType]']: ['required'],
                ['farmAddress[' + index + '][mobile]']: ['required', 'phoneNumber'],
                'currentpassword': ['required'],
                'newpassword': ['required', 'minLength:8'],
                'newpasswordconfirm': ['required', 'equalTo:newpassword']
            };

            // Check if validation rules exist
            if(validations[inputElement.id]){
                var result = true;

                for (var i = 0; i < validations[inputElement.id].length; i++) {
                    var element = validations[inputElement.id][i];

                    // Split arguments if there are any
                    var method = element.includes(':') ? element.split(':') : element;

                    result = (typeof(method) === 'object')
                        ? (validationMethods[method[0]](inputElement, method[1]))
                        : (validationMethods[method](inputElement));

                    // Result would return to a string errorMsg if validation fails
                    if(result !== true){
                        placeError(inputElement, result);
                        return false;
                    }
                }

                // If all validations succeed then
                if(result === true){
                    placeSuccess(inputElement);
                    return true;
                }
            }
        };

        // onfocusout and keyup events on
        // personal-information and
        // farm-information
        // input only
        $('body').on('focusout keyup', '#personal-information input, #farm-information input', function(e){
            validateInput(this);
        });

        // keyup event on changing of password
        $('#password-information input').focusout(function(){
            if($(this).val()) validateInput(this);
        })

        $('#password-information input').keyup(function(){
            validateInput(this);
        });

        // Edit on Personal/Farm Information
        $('.edit-button').click(function(e){
            e.preventDefault();
            var edit_button = $(this);
            var cancel_button = edit_button.parents('.content-section').find('.cancel-button');
            var parent_form = edit_button.parents('form');

            edit_button.tooltip('remove');

            // If button is for editing the fields
            if(edit_button.attr('data-tooltip').includes('Edit'))profile.edit(parent_form, edit_button, cancel_button);

            // If button is ready for submission
            else {

                // Determine if form is of personal or farm information
                if (parent_form.attr('data-personal-id')) {

                    // Check if required fields are properly filled
                    var address_addressLine1 = validateInput(document.getElementById('address_addressLine1'));
                    var address_addressLine2 = validateInput(document.getElementById('address_addressLine2'));
                    var address_zipCode = validateInput(document.getElementById('address_zipCode'));
                    var mobile = validateInput(document.getElementById('mobile'));

                    // Submit if all validations are met
                    if(address_addressLine1 && address_addressLine2 && address_zipCode){
                        $('.edit-button').addClass('disabled');
                        $('.cancel-button').addClass('disabled');
                        profile.update(parent_form, edit_button, cancel_button);
                    }
                    else Materialize.toast('Please properly fill all required fields.', 2500, 'orange accent-2');
                }
                else if(parent_form.attr('data-farm-id')){

                    // Check if required fields are properly filled
                    // Count how many current Farm Addresses are available
                    var farmNumber = parent_form.attr('data-farm-order');
                    var farmValid = true;

                    var farm_name = validateInput(document.getElementById('farm-' + farmNumber + '-name'));
                    var farm_addressLine1 = validateInput(document.getElementById('farm-' + farmNumber + '-addressLine1'));
                    var farm_addressLine2 = validateInput(document.getElementById('farm-' + farmNumber + '-addressLine2'));
                    var farm_zipCode = validateInput(document.getElementById('farm-' + farmNumber + '-zipCode'));
                    var farmType = validateInput(document.getElementById('farm-' + farmNumber + '-farmType'));
                    var farm_mobile = validateInput(document.getElementById('farm-' + farmNumber + '-mobile'));

                    farmValid = farmValid && farm_name && farm_addressLine1 && farm_addressLine2 && farm_zipCode && farmType && farm_mobile;

                    // Submit if all validations are met
                    if(farmValid){
                        $('.edit-button').addClass('disabled');
                        $('.cancel-button').addClass('disabled');
                        profile.update(parent_form, edit_button, cancel_button);
                    }
                    else Materialize.toast('Please properly fill all required fields.', 2500, 'orange accent-2');
                }
            }

        });

        // Submit added farm information
        $('body').on('click', '#submit-button' ,function(e){
            e.preventDefault();

            // Count how many current Farm Addresses are available
            var farmNumber = $('#create-profile .add-farm').length+1;
            var farmValid = true;

            for (var i = 1; i < farmNumber; i++) {

                var farm_name = validateInput(document.getElementById('farmAddress[' + i + '][name]'));
                var farm_addressLine1 = validateInput(document.getElementById('farmAddress[' + i + '][addressLine1]'));
                var farm_addressLine2 = validateInput(document.getElementById('farmAddress[' + i + '][addressLine2]'));
                var farm_zipCode = validateInput(document.getElementById('farmAddress[' + i + '][zipCode]'));
                var farmType = validateInput(document.getElementById('farmAddress[' + i + '][farmType]'));
                var farm_mobile = validateInput(document.getElementById('farmAddress[' + i + '][mobile]'));

                farmValid = farmValid && farm_name && farm_addressLine1 && farm_addressLine2 && farm_zipCode && farmType && farm_mobile;
            }

            // Submit if all validations are met
            if(farmValid){
                $(this).addClass('disabled');
                profile.add($('#create-profile'));
            }
            else Materialize.toast('Please properly fill all required fields.', 2500, 'orange accent-2');

        });

        // Change password
        $('#change-password-button').click(function(e){
            e.preventDefault();

            var currentPassword = validateInput(document.getElementById('currentpassword'));
            var newPassword = validateInput(document.getElementById('newpassword'));
            var newPasswordConfirm = validateInput(document.getElementById('newpasswordconfirm'));

            if(currentPassword && newPassword && newPasswordConfirm){
                $(this).addClass('disabled');
                profile.change_password($('#change-password-form'));
            }
        });

    }
}

$(document).ready(validateFunction());
