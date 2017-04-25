$(function() {
    SITE_ROOT = "/~hans.buys";

    //this algorithm is the same logic as in rewrite.php, keep this aligned.
    function rewrite_url(url) {
        if (REWRITE_MODULE_ON === true)
            return SITE_ROOT + url;
        else {
            var regex = /([^/]+)/g;

            var matches = [];
            var output = SITE_ROOT;
            var count = 0;

            while (matches = regex.exec(url)) {
                switch (count) {
                    case 0:
                        output += "/?p=" + matches[1];
                        break;
                    case 1:
                        output += "&a=" + matches[1];
                        break;
                    case 2:
                        output += "&id=" + matches[1];
                        break;
                }
                count++;
            }

            return output;
        }
    }

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
        $.ajax(rewrite_url("/api/buy/" + $(this).data("id")))
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
        $.ajax(rewrite_url("/api/count"))
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