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
                console.log("Bought item #" + json.id);
            }).fail(function() {
                console.log("Failed to buy an item!");
            });
    });
});