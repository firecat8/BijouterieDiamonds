var basketHandler = {
    "changeProductCount": function () {
        productID = $(this).attr("data-product-id");
        typeChange = $(this).val();
        $.ajax({
            type: "post",
            dataType: "json",
            url: "changeProductCount.php",
            data: {
                productID: productID,
                change: typeChange
            },
            success: function (data) {
                $("#total").text("Общо: " + data['total']);
                $("#basketlink").text("Koшница(" + data['count'] + ")");
                $("#countproducts").text("Брой продукти: " + data['count']);
                basketHandler.showProducts();
            }
        });
    },
    "removeProduct": function () {
        productID = $(this).attr("data-product-id");
        console.log("ID : " + productID);
        var query = {
            type: "post",
            dataType: "json",
            url: "removeProduct.php",
            data: {
                productID: productID
            },
            success: function (data) {
                $("#total").text("Общо: " + data['total']);
                $("#basketlink").text("Koшница(" + data['count'] + ")");
                $("#countproducts").text("Брой продукти: " + data['count']);
                basketHandler.showProducts();
            }
        };
        $.ajax(query);
    },
    "showProducts": function () {
        var query = {
            type: "post",
            dataType: "text",
            url: "showBasket.php",
            data: {showProducts: "all"},
            success: function (data) {
                $(".products").html(data);
                $(".delicon").click(basketHandler.removeProduct);
                $(".countbtn").click(basketHandler.changeProductCount);
            }
        };
        $.ajax(query);
    },
    "orderProducts": function () {
        buttonID = $(this).attr("id");
        var query = {
            type: "post",
            dataType: "text",
            url: "orderProducts.php",
            data: {
                order: buttonID
            },
            success: function (data) {
                $("#mainline3").html("<hr class='clear'><div id='title'><label id='title'>Пазарна кошница</label></div><br><div id='msg'>" + data + "</div><hr class='clear'>");
                $("#basketlink").text("Koшница(0)");
            }
        };
        $.ajax(query);
    }
};
$(document).ready(function () {
    $("#orderButton").click(basketHandler.orderProducts);
    $(".delicon").click(basketHandler.removeProduct);
    $(".countbtn").click(basketHandler.changeProductCount);

});