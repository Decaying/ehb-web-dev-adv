$(function() {
    SITE_ROOT = ""; // SITE_ROOT = "/~hans.buys"; voor EhB hosting

    //Search button
    //$("#searchButton").prop("disabled",true);

    $("#searchInput").on("keyup", function () {
        if ($(this).val().length == 0) {
            $("#searchButton").prop("disabled", "disabled");
        } else {
            $("#searchButton").prop("disabled", false);
        }
    });

    //Add items to shopping cart
    $(".shop-item-toggle").hover(
        function () {
            $(this).find(".shop-item").show();
        },
        function () {
            $(this).find(".shop-item").hide();
        }
    );

    $(".shop-item").click(function() {
        $.ajax(SITE_ROOT + "/api/buy/" + $(this).data("id"))
            .done(function(data) {
                var bike = $.parseJSON(data);
                toastSuccess("Successfully added " + bike.name + " to the shopping cart!");
                //show that the user bought a certain item (toast?)
                updateShoppingCart();
            }).fail(function() {
                toastError("Failed to buy an item!");
            });
    });

    function updateShoppingCart() {
        $.ajax(SITE_ROOT + "/api/count")
            .done(function(data) {
                if (!isNaN(data) && data > 0){
                    $("#shopping-cart-counter").text(data);
                    $("#shopping-cart").show();
                } else {
                    $("#shopping-cart").hide();
                }
            });
    }

    //update the shopping cart button on load
    updateShoppingCart();

    /*$("#shopping-cart").click(function (e) {
        e.preventDefault();
    });*/

    //toast bar on top
    function toastError(text) {
        console.error(text);
        $("#toast-panel").removeClass("panel-success");
        $("#toast-panel").addClass("panel-error");
        toast(text);
    }

    function toastSuccess(text) {
        console.log(text);
        $("#toast-panel").addClass("panel-success");
        $("#toast-panel").removeClass("panel-error");
        toast(text);
    }

    function toast(text) {
        $("#toast-text").text(text);
        $("#toast-panel").show().delay(5000).fadeOut();
    }

    $("#toast-panel #close-toast").click(function() {
        $("#toast-panel").hide();
    });
});