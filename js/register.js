$(function() {
    addValidation("firstname", [
        function () { return checkEmpty("#firstname", "First name") }
    ]);

    addValidation("lastname", [
        function () { return checkEmpty("#lastname", "Last name") }
    ]);

    addValidation("email", [
        function () { return checkEmpty("#email", "Email address") },
        function () { return checkInvalidEmail("#email", "Email address") }
    ]);

    addValidation("pass", [
        function () { return checkEmpty("#pass", "Password") },
        function () { return checkPasswordLength() }
    ]);

    addValidation("pass-repeat", [
        function () { return checkEmpty("#pass-repeat", "Password repeat") },
        function () { return checkPasswordsMatch() }
    ]);
});