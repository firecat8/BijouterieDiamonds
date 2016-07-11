var searchHandler = {
    "changeProduct": function () {
        productID = $(this).attr('data-product-id');
        nameLabel = $(".nameTextInput");
        productName = nameLabel.val();
        priceLabel = $(".priceTextInput");
        productPrice = priceLabel.val();
        var query = {
            type: "get",
            dataType: "json",
            url: "updateProduct.php",
            data: {
                name: productName,
                price: productPrice,
                id: productID
            },
            success: function (productInfo) {
                productParentDiv = $("div.product[data-product-id='" + productInfo['id'] + "']");
                info = $("div.infoproduct[data-product-id='" + productInfo['id'] + "']");
                console.log("name " + productInfo['name'] + "  price " + productInfo['price'] + "  id " + productInfo['id']);
                info.remove();
                productParentDiv.append('<div class="infoproduct" data-product-id="' + productInfo['id'] + '" >' +
                        ' <div class="nameDiv"> <input type="text" placeholder="Име" class="nameTextReadOnlyInput"  value="' + productInfo['name'] + '" data-product-id=' + productInfo['id'] + ' readonly="readonly"></div>' +
                        ' <div class="priceDiv"><input type="text" placeholder="Цена" class="priceTextReadOnlyInput" value="' + productInfo['price'] + ' лв." data-product-id=' + productInfo['id'] + ' readonly="readonly"></div>' +
                        ' <input type="button" class="orderbtn" data-product-id="' + productInfo['id'] + '" value="Поръчай">' +
                        ' <input type="button" class="redactionbtn" data-product-id="' + productInfo['id'] + '" value="Редактиране"></div>'
                        );
                $('.orderbtn[data-product-id="' + productInfo['id'] + '"]').click(searchHandler.orderProduct);
                $('.redactionbtn[data-product-id="' + productInfo['id'] + '"]').click(searchHandler.redactionEventHandler);
            }
        };
        $.ajax(query);
    },
    "redactionEventHandler": function () {
        productParentDiv = $("div.product[data-product-id='" + $(this).attr("data-product-id") + "']");
        nameLabel = $(".nameTextReadOnlyInput[data-product-id='" + $(this).attr("data-product-id") + "']");
        productName = nameLabel.val();
        priceLabel = $(".priceTextReadOnlyInput[data-product-id='" + $(this).attr("data-product-id") + "']");
        productPrice = priceLabel.val();
        infoDiv = $("div.infoproduct[data-product-id='" + $(this).attr("data-product-id") + "']");
        infoDiv.remove();
        productParentDiv.append('<div class="infoproduct" data-product-id="' + $(this).attr("data-product-id") + '" >' +
                ' <div class="nameDiv"> <input type="text" placeholder="Име" class="nameTextInput"  value="' + productName + '"></div>' +
                ' <div class="priceDiv"><input type="text" placeholder="Цена" class="priceTextInput" value="' + productPrice + '"></div>' +
                ' <input type="button" class="orderbtn" data-product-id="' + $(this).attr("data-product-id") + '" value="Поръчай">' +
                ' <input type="button" class="changebtn" data-product-id="' + $(this).attr("data-product-id") + '" value="Промени"></div>'
                );
        $('.orderbtn[data-product-id="' + $(this).attr("data-product-id") + '"]').click(searchHandler.orderProduct);
        $('.changebtn[data-product-id="' + $(this).attr("data-product-id") + '"]').click(searchHandler.changeProduct);
    },
    "showProducts": function () {
        var inputs = $("#formoptions").serialize();
        $.ajax({
            type: "get",
            url: "templates/results.php",
            data: inputs,
            success: function (data) {
                $("#results").html(data);
                $(".orderbtn").click(searchHandler.orderProduct);
                $(".redactionbtn").click(searchHandler.redactionEventHandler);
            }
        });
    },
    "selectColor": function () {
        var selectedDivs = $(".selected");
        if (selectedDivs.length === 0) {
            $(this).addClass("selected");
        } else {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
            } else {
                selectedDivs.removeClass("selected");
                $(this).addClass("selected");
            }
        }
        selectedDivs = $(".selected");
        if (selectedDivs.length === 0) {
            $("#colorInput").val("all");
        } else {
            $("#colorInput").val(selectedDivs.attr("id"));
        }
        searchHandler.showProducts();
    },
    "orderProduct": function () {
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

    $("input").change(searchHandler.showProducts);
    $("select").change(searchHandler.showProducts);
    $("#formoptions").click(searchHandler.showProducts);
    $(".color").click(searchHandler.selectColor);
    searchHandler.showProducts();
});