$(function() {
    addValidation("name", [
        function () { return checkEmpty("#name", "Name") }
    ]);

    addValidation("category", [
        function () { return checkEmpty("#category", "Category") }
    ]);

    addValidation("price", [
        function () { return checkPositiveNumber("#price", "Price") }
    ]);

    addValidation("description", [
        function () { return checkEmpty("#description", "Description") }
    ]);

    addValidation("image", [
        function () { return checkEmpty("#image", "Image") }
    ]);
});