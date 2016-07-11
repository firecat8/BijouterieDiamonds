var adminOptionsHandler = {
    "changeProduct": function () {
        productID = $(this).attr("data-product-id");
        var query = {
            type: "post",
            dataType: "json",
            url: "add_product_in_basket.php",
            data: {
                productID: productID
            },
            success: function (data) {
                $("#basketlink").html('Кошница(' + data['orderedProducts'] + ')');
            }
        };
        $.ajax(query);
    }
};
$(document).ready(function () {
    $(".changebtn").click(adminOptionsHandler.changeProduct);

});