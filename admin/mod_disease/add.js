//----------------------------------------
function doBack() {
//----------------------------------------
	$('#myBackForm').submit();
}

// ------------------------------------------------------------------------------------------
var FormValidation = function() {
// ------------------------------------------------------------------------------------------
    var _componentUniform = function() {
        if (!$().uniform) { console.warn('Warning - uniform.min.js is not loaded.'); return; }
        $('.form-input-styled').uniform({ fileButtonClass: 'action btn bg-pink' });
    };
    var _componentSwitchery = function() {
        if (typeof Switchery == 'undefined') { console.warn('Warning - switchery.min.js is not loaded.'); return; }
        var elems = Array.prototype.slice.call(document.querySelectorAll('.form-input-switchery'));
        elems.forEach(function(html) { var switchery = new Switchery(html); });
    };
    var _componentBootstrapSwitch = function() {
        if (!$().bootstrapSwitch) { console.warn('Warning - bootstrap_switch.min.js is not loaded.'); return; }
        $('.form-input-switch').bootstrapSwitch({ onSwitchChange: function(state) { if(state) { $(this).valid(true); } else { $(this).valid(false); } } });
    };
    var _componentTouchspin = function() {
        if (!$().TouchSpin) { console.warn('Warning - touchspin.min.js is not loaded.'); return; }
        var $touchspinContainer = $('.touchspin-postfix');
        $touchspinContainer.TouchSpin({ min: 0, max: 100, step: 0.1, decimals: 2, postfix: '%' });
        $touchspinContainer.on('touchspin.on.startspin', function() { $(this).trigger('blur'); });
    };
    var _componentSelect2 = function() {
        if (!$().select2) { console.warn('Warning - select2.min.js is not loaded.'); return; }
        var $select = $('.form-control-select2').select2({ minimumResultsForSearch: Infinity });
        $select.on('change', function() { $(this).trigger('blur'); });
    };
    var _componentValidation = function() {
        if (!$().validate) { console.warn('Warning - validate.min.js is not loaded.'); return; }
        var validator = $('.form-validate-jquery').validate({
            ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
            errorClass: 'validation-invalid-label',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            success: function(label) {
                label.addClass('validation-valid-label').text('ผ่าน'); // remove to hide Success message
            },
            errorPlacement: function(error, element) {
                if (element.parents().hasClass('form-check')) {
                    error.appendTo( element.parents('.form-check').parent() );
                }
                else if (element.parents().hasClass('form-group-feedback') || element.hasClass('select2-hidden-accessible')) {
                    error.appendTo( element.parent() );
                }
                else if (element.parent().is('.uniform-uploader, .uniform-select') || element.parents().hasClass('input-group')) {
                    error.appendTo( element.parent().parent() );
                }
                else {
                    error.insertAfter(element);
                }
            },
            rules: {
                inputPass: {
                    minlength: 4
                },
                inputPassConfirm: {
                    equalTo: '#inputPass'
                },
                inputEmail: {
                    email: true
                },
                maximum_characters: {
                    maxlength: 10
                },
                minimum_number: {
                    min: 10
                },
                maximum_number: {
                    max: 10
                },
                number_range: {
                    range: [10, 20]
                },
                url: {
                    url: true
                },
                date: {
                    date: true
                },
                date_iso: {
                    dateISO: true
                },
                numbers: {
                    number: true
                },
                digits: {
                    digits: true
                },
                creditcard: {
                    creditcard: true
                },
                basic_checkbox: {
                    minlength: 2
                },
                styled_checkbox: {
                    minlength: 2
                },
                switchery_group: {
                    minlength: 2
                },
                switch_group: {
                    minlength: 2
                }
            },
            messages: {
                custom: {
                    required: 'This is a custom error message'
                },
                basic_checkbox: {
                    minlength: 'Please select at least {0} checkboxes'
                },
                styled_checkbox: {
                    minlength: 'Please select at least {0} checkboxes'
                },
                switchery_group: {
                    minlength: 'Please select at least {0} switches'
                },
                switch_group: {
                    minlength: 'Please select at least {0} switches'
                },
                agree: 'Please accept our policy'
            }
        });
        $('#reset').on('click', function() {
            validator.resetForm();
        });
    };
    return {
        init: function() {
            _componentUniform();
            _componentBootstrapSwitch();
            _componentTouchspin();
            _componentSelect2();
            _componentValidation();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    FormValidation.init();
});

var CKEditor = function() {
    var _componentCKEditor = function() {
        if (typeof CKEDITOR == 'undefined') {
            console.warn('Warning - ckeditor.js is not loaded.');
            return;
        }
        CKEDITOR.replace('inputHTML', {
            height: 400
        });
    };
    // Select2
    var _componentSelect2 = function() {
        if (!$().select2) {
            console.warn('Warning - select2.min.js is not loaded.');
            return;
        };
        $('.form-control-select2').select2({
            minimumResultsForSearch: Infinity
        });
    };
    return {
        init: function() {
            _componentCKEditor();
            _componentSelect2();
        }
    }
}();

document.addEventListener('DOMContentLoaded', function() {
    CKEditor.init();
});

const element = document.querySelectorAll('.inputHTML')
element.forEach(ele=>{
    CKEDITOR.replace(ele)
})
