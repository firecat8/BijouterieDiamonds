var searchOptionsOrdersHandler = {
    "searchOrders": function () {
        typeOrders = $(this).attr("id");
        var query = {
            type: "post",
            dataType: "text",
            url: "searchOptionsOrdersResults.php",
            data: {
                typeOrders: typeOrders
            },
            success: function (data) {
                $("#resultsOrders").html(data);
                $(".order").click(searchOptionsOrdersHandler.ordersClickHandler);
                $(".endbtn").click(searchOptionsOrdersHandler.endOrderHandler);
            }
        };
        $.ajax(query);
    },
    "ordersClickHandler": function () {
        orderID = $("#orderedProductsDiv").attr('data-order-id');
        $("#orderedProductsDiv").remove();
        var orderDiv = $(this);
        orderDiv.removeClass('selectedOrder');
        if (orderID !== orderDiv.attr('data-order-id')) {
            var query = {
                type: "get",
                dataType: "json",
                url: "getProductsByOrderId.php",
                data: {
                    order_id: orderDiv.attr('data-order-id')
                },
                success: function (products) {
                    orderDiv.addClass('selectedOrder');
                    orderDiv.after("<div id='orderedProductsDiv' data-order-id='" + orderDiv.attr('data-order-id') + "' ></div>");
                    var productsDiv = $("#orderedProductsDiv");
                    var allProducts = '';
                    for (var i = 0; i < products.length; i++) {
                        allProducts += '<div class="orderedProductDiv">';
                        allProducts += '<img src="img/' + products[i]['img'] + '" class="orderedProductImg" >';
                        allProducts += '<div class="infoOrderedProductDiv"><div>' + products[i]['name'] + '</div>';
                        allProducts += '<div>Цена : ' + products[i]['price'] + 'лв.</div>';
                        allProducts += '<div>Брой : ' + products[i]['count'] + '</div></div></div>';
                    }
                    productsDiv.html(allProducts);
                }
            };
            $.ajax(query);
        }
    },
    "endOrderHandler": function () {
        var endbtn = $(this);
        var orderTypeDiv = $('[data-order-id="' + endbtn.attr('data-order-id') + '-' + endbtn.attr('data-order-id') + '"]');
        var query = {
            type: "get",
            dataType: "text",
            url: "endOrderById.php",
            data: {
                order_id: endbtn.attr('data-order-id')
            },
            success: function (successResponse) {
                if (successResponse === 'TRUE') {
                    orderTypeDiv.text("Приключена");
                    endbtn.remove();
                }
            }
        };
        $.ajax(query);
    }
};

$(document).ready(function () {
    $(".optionbtn").click(searchOptionsOrdersHandler.searchOrders);

});