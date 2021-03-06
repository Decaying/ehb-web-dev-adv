var allValidations = [];



function addValidation(selector, validations) {

    function doValidation() {
        valid = true;
        message = "";

        validations.forEach(function (validation) {
            if (valid) {
                message = validation();
                valid = message === "";

                if (message !== "")
                    console.log(validation + " failed: " + message);
            }
        });

        $("#" + selector + "-error").remove();
        if (allValidationsPass()) {
            $("#submit").prop("disabled", false);
        } else {
            $("#submit").prop("disabled", "disabled");
            if (!valid) {
                showError("#" + selector, message, selector + "-error");
            }
        }
    }

    validations.forEach(function (validation) {
        allValidations.push(validation);
    });

    var obj = $("#" + selector);

    obj.change(doValidation);
    obj.on("keyup", doValidation);

}

function allValidationsPass() {
    var valid = true;
    allValidations.forEach(function (validation) {
        valid &= validation() === "";
    });
    return valid;
}

function checkEmpty(selector, fieldDescription) {
    if (isEmpty(selector))
        return fieldDescription + " is required.";
    return "";
}

function checkChecked(selector, errorText) {
    if (!isChecked(selector))
        return errorText;
    return "";
}

function checkMinLength(selector, length, fieldDescription) {
    if (hasInsufficientLength(selector, length))
        return fieldDescription + " should have at least " + length + " characters.";
    return "";
}

function checkInvalidEmail(selector, fieldDescription) {
    if (!isValidEmail(selector))
        return fieldDescription + " is malformed.";
    return "";
}

function checkPasswordsMatch() {
    if ($("#pass").val() !== $("#pass-repeat").val())
        return "Passwords do not match.";
    return "";
}

function checkPasswordLength() {
    password = $("#pass").val();
    if (password.length < 8)
        return "Password should be at least 8 characters.";
    return "";
}

function isEmpty(selector) {
    value = $(selector).val();
    return  value === null || value === undefined || value === "";
}

function hasInsufficientLength(selector, length) {
    value = $(selector).val();
    return value.length < length;
}

function isChecked(selector) {
    return $(selector).is(':checked');
}

function isValidEmail(selector) {
    email = $(selector).val();
    emailExpr = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
    return emailExpr.test(email);
}

function showError(selector, message, messageDivId) {
    $(selector).after("<div class='panel panel-danger' id='" + messageDivId + "'> <div class='panel-heading'>" + message + "</div> </div>");
}

function checkPositiveNumber(selector, fieldDescription) {
    let number = parseFloat($(selector).val());

    if (number < 0) {
        return fieldDescription + " must be a positive number";
    }

    return "";
}
