$(function() {
    $('#useDlvAsInv').change(function() {
        if (!$(this).is(':checked')) {
            $('#invAddr').removeClass('hide');
        } else {
            $('#invAddr').addClass('hide');
        }
    });

    addValidation("useDlvAsInv", []);

    addValidation("dlvStreet", [
        function () { return checkEmpty("#dlvStreet", "Street and number") }
    ]);

    addValidation("dlvZip", [
        function () { return checkEmpty("#dlvZip", "Zipcode") },
        function () { return checkMinLength("#dlvZip", 4, "Zipcode") }
    ]);

    addValidation("agreeToTerms", [
        function () { return checkChecked("#agreeToTerms", "You need to agree to our terms & conditions to continue to checkout") }
    ]);

    addValidation("dlvCity", [
        function () { return checkEmpty("#dlvCity", "City") }
    ]);

    addValidation("invStreet", [
        function () {
            if (!$('#useDlvAsInv').is(':checked'))
                return checkEmpty("#invStreet", "Street and number");
            else
                return "";}
    ]);

    addValidation("invZip", [
        function () {
            if (!$('#useDlvAsInv').is(':checked'))
                return checkEmpty("#invZip", "Zipcode");
            else
                return "";
        },
        function () {
            if (!$('#useDlvAsInv').is(':checked'))
                return checkMinLength("#invZip", 4, "Zipcode");
            else
                return "";
        }
    ]);

    addValidation("invCity", [
        function () {
            if (!$('#useDlvAsInv').is(':checked'))
                return checkEmpty("#invCity", "Street and number");
            else
                return "";
        }
    ]);
});