<?php
session_start();
include './templates/connectdb.php';
?>
<!DOCTYPE html>
<html lang="bg">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Онлайн бижутерия Diamonds</title>
        <link href="css/resetcs.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/result.css" rel="stylesheet">
        <link href="css/basket.css" rel="stylesheet">
        <link href="css/admin.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/basketHandler.js"></script>
    </head>
    <?php
    include './templates/isLoginUser.php';
    include './templates/menu.php';
    ?>
    <div class="main" id="mainline3">
        <hr class="clear">
        <div id="title"> <label id="title">Пазарна кошница</label></div>
        <br>
        <div id="msg">
            
        </div>
        <br>
        <div id="basketinfo">
            <label id="countproducts">Брой продукти:
                <?php
                echo '' . array_sum(array_values($_SESSION['basket']));
                ?>
            </label>
            <label id="total">Общо:
                <?php
                echo ' ' . orderValue() . ' лв.';
                ?>
            </label>
            <input type="button" id="orderButton" value="Поръчай">
        </div>
        <div class="products">
            <?php
            echo showBasket();
            ?>                    
        </div>
        <hr class="clear">
    </div>
    <?php
    include './templates/footer.php';
    ?>
</body>
</html>
