(function ($) {
    $.fn.extend({
        preOption: {
            errorTextColor: '#e81e1c',
            errorFieldColor: '#e81e1c'
        },
        ErrerAdd: function (selecter, errorShow, message) {
            selecter.next('.ErrorMag').remove();
            selecter.css('border-color', '');
            if (message == '') {
                selecter.css('border-color', this.preOption.errorFieldColor);
            } else {
                selecter.css('border-color', this.preOption.errorFieldColor);
                if (errorShow == '') {
                    selecter.after('<div class="ErrorMag" style="color:' + this.preOption.errorTextColor + ';">' + message + '</div>');
                } else {
                    $(errorShow).html('<div class="ErrorMag" style="color:' + this.preOption.errorTextColor + ';">' + message + '</div>');
                }
            }
        },
        ErrerFree: function (selecter, errorShow) {
            selecter.next('.ErrorMag').remove();
            $(errorShow).html('');
            selecter.css('border-color', '');
        },
    		forceErrorAdd: function(message, errorShow){
    			msg = '';
    			if ((typeof message == "undefined") || (typeof message == "")) {
                    msg = '';
                } else if ((typeof message == "string")) {
                    msg = message;
                }
    			$(this).css('border-color', this.preOption.errorFieldColor);
    			if ((typeof errorShow == "undefined") || (typeof errorShow == "")) {
    				$(this).next('.ErrorMag').remove();
    				$(this).after('<div class="ErrorMag" style="color:' + this.preOption.errorTextColor + ';">' + msg + '</div>');
    			} else {
    				$(errorShow).html('');
    				$(errorShow).html('<div class="ErrorMag" style="color:' + this.preOption.errorTextColor + ';">' + msg + '</div>');
    			}
    		},
        commonCheck: function (options) {

            var defaults = {
                errorArea: '',
                errorMessage1: 'This field is required'
            };

            options_v = $.extend(defaults, options);

            msg = options_v.errorMessage1;
            if ((typeof options == "undefined") || (typeof options == "")) {
                msg = options_v.errorMessage1;
            } else if ((typeof options == "string")) {
                msg = options;
            }
            if ($(this).length == 1) {
                var ThisValue = $.trim($(this).val());
                if (ThisValue == '') {
                    this.ErrerAdd($(this), options_v.errorArea, msg);
                    return false;
                } else {
                    this.ErrerFree($(this), options_v.errorArea);
                    return true;
                }
            } else {
                return false;
            }
        },
        mobileNumberCheck: function (options) {
            var defaults = {
                blankCk: true,
                errorArea: '',
                errorMessage1: 'Mobile number is required.',
                errorMessage2: 'Please enter valid mobile number.'
            };
            options_v = $.extend(defaults, options);
            msg1 = options_v.errorMessage1;

            var patternMo = new RegExp(/^[0]?[56789]\d{9}$/);
            //Support 08888888888(Zero appending) 7878787878,8634456876,9545559877(any mobile number precede by 5,6,7,8,9 and followed by other 9 digits)

            if ($(this).length == 1) {
                var ThisValue = $.trim($(this).val());
                if ((ThisValue == '') & (options_v.blankCk)) {
                    this.ErrerAdd($(this), options_v.errorArea, msg1);
                    return false;
                } else if ((!patternMo.test(ThisValue)) & (ThisValue != '')) {
                    msg2 = options_v.errorMessage2;
                    if ((typeof options == "undefined") || (typeof options == "")) {
                        msg2 = options_v.errorMessage2;
                    } else if ((typeof options == "string")) {
                        msg2 = options;
                    }

                    this.ErrerAdd($(this), options_v.errorArea, msg2);
                    return false;
                } else {
                    this.ErrerFree($(this), options_v.errorArea);
                    return true;
                }
            } else {
                return false;
            }
        },
        stdNumberCheck: function (options) {
            var defaults = {
                errorArea: '',
                errorMessage1: 'STD code is required.',
                errorMessage2: 'Please enter valid STD code.'
            };
            options_v = $.extend(defaults, options);
            msg1 = options_v.errorMessage1;

            var patternStd = new RegExp(/^([0-9]){3,5}$/);
            if ($(this).length == 1) {
                var ThisValue = $.trim($(this).val());
                if (ThisValue == '') {
                    this.ErrerAdd($(this), options_v.errorArea, msg1);
                    return false;
                } else if (!patternStd.test(ThisValue)) {
                    msg2 = options_v.errorMessage2;
                    if ((typeof options == "undefined") || (typeof options == "")) {
                        msg2 = options_v.errorMessage2;
                    } else if ((typeof options == "string")) {
                        msg2 = options;
                    }

                    this.ErrerAdd($(this), options_v.errorArea, msg2);
                    return false;
                } else {
                    this.ErrerFree($(this), options_v.errorArea);
                    return true;
                }
            } else {
                return false;
            }
        },
        landNumberCheck: function (options) {
            var defaults = {
                errorArea: '',
                errorMessage1: 'Landline number is required.',
                errorMessage2: 'Please enter valid landline number.'
            };
            options_v = $.extend(defaults, options);
            msg1 = options_v.errorMessage1;

            var patternLnd = new RegExp(/^([0-9]){6,8}$/);
            if ($(this).length == 1) {
                var ThisValue = $.trim($(this).val());
                if (ThisValue == '') {
                    this.ErrerAdd($(this), options_v.errorArea, msg1);
                    return false;
                } else if (!patternLnd.test(ThisValue)) {
                    msg2 = options_v.errorMessage2;
                    if ((typeof options == "undefined") || (typeof options == "")) {
                        msg2 = options_v.errorMessage2;
                    } else if ((typeof options == "string")) {
                        msg2 = options;
                    }

                    this.ErrerAdd($(this), options_v.errorArea, msg2);
                    return false;
                } else {
                    this.ErrerFree($(this), options_v.errorArea);
                    return true;
                }
            } else {
                return false;
            }
        },
        numberCheck: function (options) {
            var defaults = {
                errorArea: '',
                errorMessage1: 'This field is required',
                errorMessage2: 'Please enter valid number'
            };

            options_v = $.extend(defaults, options);

            msg1 = options_v.errorMessage1;
            if ($(this).length == 1) {
                var ThisValue = $.trim($(this).val());
                if (ThisValue == '') {
                    this.ErrerAdd($(this), options_v.errorArea, msg1);
                    return false;
                } else if (isNaN(ThisValue)) {
                    msg2 = options_v.errorMessage2;
                    if ((typeof options == "undefined") || (typeof options == "")) {
                        msg2 = options_v.errorMessage2;
                    } else if ((typeof options == "string")) {
                        msg2 = options;
                    }

                    this.ErrerAdd($(this), options_v.errorArea, msg2);
                    return false;
                } else {
                    this.ErrerFree($(this), options_v.errorArea);
                    return true;
                }
            } else {
                return false;
            }

        },

        normalIntegerCheck: function (options) {

            var defaults = {
                errorArea: '',
                errorMessage1: 'This field is required',
                errorMessage2: 'Please enter valid number'
            };

            options_v = $.extend(defaults, options);
            msg1 = options_v.errorMessage1;
            var patternPrice = new RegExp(/^\+?(0|[1-9]\d*)$/);

            if ($(this).length == 1) {
                var ThisValue = $.trim($(this).val());
                if (ThisValue == '') {
                    this.ErrerAdd($(this), options_v.errorArea, msg1);
                    return false;
                } else if (!patternPrice.test(ThisValue)) {
                    msg2 = options_v.errorMessage2;
                    if ((typeof options == "undefined") || (typeof options == "")) {
                        msg2 = options_v.errorMessage2;
                    } else if ((typeof options == "string")) {
                        msg2 = options;
                    }

                    this.ErrerAdd($(this), options_v.errorArea, msg2);
                    return false;
                } else {
                    this.ErrerFree($(this), options_v.errorArea);
                    return true;
                }
            } else {
                return false;
            }
        },

        validatePrice: function (options) {

            var defaults = {
                blankCk: true,
                errorArea: '',
                errorMessage1: 'This field is required',
                errorMessage2: 'Please enter valid price'
            };

            options_v = $.extend(defaults, options);
            msg1 = options_v.errorMessage1;
            var patternPrice = new RegExp(/^(?:0|[1-9]\d*)(?:\.\d{2})?$/);

            if ($(this).length == 1) {
                var ThisValue = $.trim($(this).val());
                if ((ThisValue == '') & (options_v.blankCk)) {
                    this.ErrerAdd($(this), options_v.errorArea, msg1);
                    return false;
                } else if (!patternPrice.test(ThisValue)) {
                    if (ThisValue != '') {
                        msg2 = options_v.errorMessage2;
                        if ((typeof options == "undefined") || (typeof options == "")) {
                            msg2 = options_v.errorMessage2;
                        } else if ((typeof options == "string")) {
                            msg2 = options;
                        }

                        this.ErrerAdd($(this), options_v.errorArea, msg2);
                        return false;
                    }
                    else{
                        this.ErrerFree($(this), options_v.errorArea);
                        return true;
                    }
                } else {
                    this.ErrerFree($(this), options_v.errorArea);
                    return true;
                }
            } else {
                return false;
            }

        },
        validateEmail: function (options) {

            var defaults = {
                blankCk: true,
                errorArea: '',
                showMsg: true,
                errorMessage1: 'Email is required',
                errorMessage2: 'Please enter a valid e-mail address'
            };

            options_v = $.extend(defaults, options);

            msg1 = options_v.errorMessage1;

            var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
            if ($(this).length == 1) {
                var ThisValue = $.trim($(this).val());
                if ((ThisValue == '') & (options_v.blankCk)) {
                    if (options_v.showMsg) {
                        this.ErrerAdd($(this), options_v.errorArea, msg1);
                    }
                    return false;
                } else if ((!pattern.test(ThisValue)) & ((ThisValue != ''))) {

                    msg2 = options_v.errorMessage2;
                    if ((typeof options == "undefined") || (typeof options == "")) {
                        msg2 = options_v.errorMessage2;
                    } else if ((typeof options == "string")) {
                        msg2 = options;
                    }
                    if (options_v.showMsg) {
                        this.ErrerAdd($(this), options_v.errorArea, msg2);
                    }
                    return false;
                } else {
                    this.ErrerFree($(this), options_v.errorArea);
                    return true;
                }

            } else {
                return false;
            }
        },
        CkConfirmEmail: function (options) {
            if ($(this).length == 1) {
                $(this).css('border-color', '');

                var defaults = {
                    emailField: '',
                    errorArea: '',
                    errorMessage1: 'This field is required',
                    errorMessage2: 'Email and confirm email not match'
                };
                options_v = $.extend(defaults, options);
                ThisValue = $.trim($(this).val());
                if (ThisValue == '') {
                    this.ErrerAdd($(this), options_v.errorArea, options_v.errorMessage1);
                    return false;
                } else if ((options_v.emailField == '')) {
                    this.ErrerAdd($(this), options_v.errorArea, '<b>Please provide the email field</b>');
                    return false;
                } else if ($(options_v.emailField).length == 0) {
                    this.ErrerAdd($(this), options_v.errorArea, '<b>Please provide the email field</b>');
                    return false;
                } else if (ThisValue != $.trim($(options_v.emailField).val())) {
                    this.ErrerAdd($(this), options_v.errorArea, options_v.errorMessage2);
                    return false;
                } else {
                    this.ErrerFree($(this), options_v.errorArea);
                    return true;
                }
            } else {
                return false;
            }
        },
        passwordCheck: function (options) {
            var alphaNumericReg = new RegExp(/^[0-9a-zA-Z-_]+$/);
            var defaults = {
                blankCk: true,
                errorArea: '',
                alphaNumericCk: true,
                minLen: 0,
                maxLen: 0,
                errorMessageMinLen:'Password too short',
                errorMessageMaxLen:'Password too big',
                errorMessage1: 'This field is required'
            };

            options_v = $.extend(defaults, options);

            msg = options_v.errorMessage1;
            if ((typeof options == "undefined") || (typeof options == "")) {
                msg = options_v.errorMessage1;
            } else if ((typeof options == "string")) {
                msg = options;
            }
            if ($(this).length == 1) {
                var ThisValue = $.trim($(this).val());
                var nLen = ThisValue.length;
                if ((ThisValue == '') & (options_v.blankCk)) {
                    this.ErrerAdd($(this), options_v.errorArea, msg);
                    return false;
                } else if (((options_v.minLen > 0) & (nLen < options_v.minLen)) & (ThisValue != '')) {
                    this.ErrerAdd($(this), options_v.errorArea, options_v.errorMessageMinLen);
                    return false;
                } else if (((options_v.maxLen > 0) & (nLen > options_v.maxLen)) & (ThisValue != '')) {
                    this.ErrerAdd($(this), options_v.errorArea, options_v.errorMessageMaxLen);
                    return false;
                } else if (((options_v.alphaNumericCk) & (alphaNumericReg.test(ThisValue))) & (ThisValue != '')) {
                    this.ErrerAdd($(this), options_v.errorArea, 'Alphanumeric password offer better protection');
                    return false;
                } else {
                    this.ErrerFree($(this), options_v.errorArea);
                    return true;
                }
            } else {
                return false;
            }
        },
        CkConfirmPassword: function (options) {

            if ($(this).length == 1) {
                $(this).css('border-color', '');
                var defaults = {
                    passwordField: '',
                    errorArea: '',
                    errorMessage1: 'Confirm password is required',
                    errorMessage2: 'Password and confirm password does not match'
                };
                options_v = $.extend(defaults, options);

                ThisValue = $.trim($(this).val());
                if (ThisValue == '') {
                    this.ErrerAdd($(this), options_v.errorArea, options_v.errorMessage1);
                    return false;
                } else if ((options_v.passwordField == '')) {
                    this.ErrerAdd($(this), options_v.errorArea, '<b>Please provide the password field</b>');
                    return false;
                } else if ($(options_v.passwordField).length == 0) {
                    this.ErrerAdd($(this), options_v.errorArea, '<b>Please provide the password field</b>');
                    return false;
                } else if (ThisValue != $.trim($(options_v.passwordField).val())) {
                    this.ErrerAdd($(this), options_v.errorArea, options_v.errorMessage2);
                    return false;
                } else {
                    this.ErrerFree($(this), options_v.errorArea);
                    return true;
                }
            } else {
                return false;
            }
        },
        checkFileType: function (options) {

            if ($(this).length == 1) {
                var defaults = {
                    blankCk: true,
                    allowedExtensions: [], //like ['jpg', 'jpeg']
                    errorArea: '',
                    errorMessage1: 'This field is required',
                    errorMessage2: 'Wrong file type'
                };
                options_v = $.extend(defaults, options);
                ThisValue = $.trim($(this).val());

                if ((ThisValue == '') & (options_v.blankCk)) {
                    this.ErrerAdd($(this), options_v.errorArea, options_v.errorMessage1);
                    return false;
                } else {
                    if ((options_v.allowedExtensions.length > 0) & (ThisValue != '')) {
                        ThisValueLower = ThisValue.toLowerCase();
                        extension = ThisValueLower.substring(ThisValueLower.lastIndexOf('.') + 1);
                        if ($.inArray(extension, options_v.allowedExtensions) == -1) {
                            this.ErrerAdd($(this), options_v.errorArea, options_v.errorMessage2);
                            return false;
                        } else {
                            this.ErrerFree($(this), options_v.errorArea);
                            return true;
                        }
                    } else {
                        this.ErrerFree($(this), options_v.errorArea);
                        return true;
                    }
                }
            } else {
                return false;
            }
        },

        checkMultipleFileType: function (options) {

            if ($(this).length == 1) {
                var defaults = {
                    blankCk: true,
                    allowedExtensions: [], //like ['jpg', 'jpeg']
                    errorArea: '',
                    errorMessage1: 'This field is required',
                    errorMessage2: 'Wrong file type'
                };
                options_v = $.extend(defaults, options);
                ThisValue = $.trim($(this).val());

                files = $(this).get(0).files;
                files_length = files.length;

                if ((files_length == 0) & (options_v.blankCk)) {
                    this.ErrerAdd($(this), options_v.errorArea, options_v.errorMessage1);
                    return false;
                } else {
                    if ((options_v.allowedExtensions.length > 0) & (ThisValue != '')) {
                        for (var i = 0; i < files_length; ++i) {
                            ThisValueLower = files[i].name.toLowerCase();
                            extension = ThisValueLower.substring(ThisValueLower.lastIndexOf('.') + 1);
                            if ($.inArray(extension, options_v.allowedExtensions) == -1) {
                                this.ErrerAdd($(this), options_v.errorArea, options_v.errorMessage2);
                                return false;
                            } else {
                                this.ErrerFree($(this), options_v.errorArea);
                                return true;
                            }
                        }
                    }
                    else{
                        this.ErrerFree($(this), options_v.errorArea);
                        return true;
                    }
                }
            } else {
                return false;
            }
        },

        checkRadioOrCheck: function (options) {

            //Demo $("input[name=s]:checked").checkRadioOrCheck();
            //  if  name is not array (input[name=s])
            //  if name is an array (input[name^=s])
            var msg = '';
            var defaults = {
                errorArea: '',
                errorMessage1: 'This field is required',
                selectorName: ''
            };
            options_v = $.extend(defaults, options);

            $(options_v.errorArea).html('');

            if ((options === undefined) || (options == '')) {
                msg = '';
            } else if (typeof options == 'string') {
                msg = options;
            } else if (typeof options == 'object') {
                msg = options_v.errorMessage1;
            }

            selectorName = options_v.selectorName;

            if ($('input[name=' + selectorName + ']:checked').length <= 0) {
                if (options_v.errorArea != '') {
                    $(options_v.errorArea).html('<span style="color:' + this.preOption.errorTextColor + '">' + options_v.errorMessage1 + '</span>');
                } else {
                    this.ErrerAdd($(this), msg);
                }
                return false;
            } else {
                this.ErrerFree($(this));
                return true;
            }

        },

        validateurl: function(options){
            var defaults = {
                errorArea: '',
                blankCk:true,
                errorMessage1: 'Please enter url',
                errorMessage2: 'Please enter a valid url'
            };

            options_v = $.extend(defaults,options);
            var pattern = new RegExp(/^(?:http(s)?:\/\/)?[\w.-]+(?:\.[\w\.-]+)+[\w\-\._~:/?#[\]@!\$&'\(\)\*\+,;=.]+$/);
            if ($(this).length == 1) {
                var ThisValue = $.trim($(this).val());
                if ((ThisValue == '') & (options_v.blankCk)) {
                    this.ErrerAdd($(this), options_v.errorArea, options_v.errorMessage1);
                    return false;
                }
                else if ((!pattern.test(ThisValue)) & (ThisValue != '')) {
                    msg2 = options_v.errorMessage2;
                    this.ErrerAdd($(this),options_v.errorArea,msg2);
                    return false;
                }
                else{
                   this.ErrerFree($(this),options_v.errorArea);
                   return true;
                }
            }
            else{
                return false;
            }
        }
    });
})(jQuery);
