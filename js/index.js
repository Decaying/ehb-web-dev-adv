$(function() {
    //Search button
    $("#searchButton").prop("disabled",true);

    $("#searchInput").keypress(function () {
        if ($(this).val()) {
            $("#searchButton").prop("disabled",false);
        } else {
            $("#searchButton").prop("disabled",true);
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
        $.ajax("/api/buy/" + $(this).data("id"))
            .done(function(data) {
                var json = $.parseJSON(data);
                //show that the user bought a certain item (toast?)
                updateShoppingCart();
            }).fail(function() {
                console.log("Failed to buy an item!");
            });
    });

    function updateShoppingCart() {
        $.ajax("/api/count")
            .done(function(data) {
                if (!isNaN(data) && data > 0){
                    $("#shopping-cart-counter").text(data);
                    $("#shopping-cart").show();
                } else {
                    $("#shopping-cart").hide();
                }
            })

    }

    //update the shopping cart button on load
    updateShoppingCart();

    $("#shopping-cart").click(function (e) {
        e.preventDefault();
    });
});