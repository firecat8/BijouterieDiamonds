<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit();
}
$conn = new mysqli("localhost", "root", "8sZfFTK8WQwhTszC", "diamonds");
mysqli_set_charset($conn, 'utf8');

function showProduct($res) {

    $product = '<div class="productDiv">';
    $product .= '<img src="img/' . $res['img'] . '" class="productImg" >';
    $product .= '<div>' . $res['name'] . '</div>';
    $product .= '<div>' . $res['price'] . 'лв.</div></div>';
    echo $product;
}
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
        <link href="css/admin.css" rel="stylesheet">
        <link href="css/statistics.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script>
        </script>
    </head>
    <?php
    include './templates/LoginUser.php';
    include './templates/adminMenu.php';
    ?>
    <div class="main" id="mainline3">
        <hr class="clear">
        <div class="title"> <label class="title">Статистика</label></div>
        <div class="condition">
            <div class="criteria">Най-скъпия продукт от категория:</div>
            <?php
            $queryBijouTypes = 'SELECT `bijou_id` FROM `bijou` ORDER BY `bijou_id` ASC';
            $stmt1 = $conn->prepare($queryBijouTypes);
            $stmt1->execute();
            $row = array();
            $stmt1->bind_result($row['bijou_id']);
            $res = $stmt1->get_result();
            $products = $res->fetch_all(MYSQLI_ASSOC);
            $stmt1->close();
            for ($i = 0; $i < count($products); $i++) {
                $query = 'SELECT `product_name` AS "name", `product_img` AS "img", `price` FROM `products` WHERE `bijou`= ? ORDER BY price DESC LIMIT 1';
                $stmt1 = $conn->prepare($query);
                $stmt1->bind_param('i', $products[$i]['bijou_id']);
                $stmt1->execute();
                $row = array();
                $stmt1->bind_result($row['name'], $row['img'], $row['price']);
                $stmt1->fetch();
                showProduct($row);
                $stmt1->close();
            }
            ?>
        </div>
        <div class="condition">
            <div class="criteria">Най-евтиния продукт от категория:</div>
            <?php
            for ($i = 0; $i < count($products); $i++) {
                $query1 = 'SELECT `product_name` AS "name", `product_img` AS "img", `price` FROM `products` WHERE `bijou`= ? ORDER BY price ASC LIMIT 1';
                $stmt = $conn->prepare($query1);
                $stmt->bind_param('i', $products[$i]['bijou_id']);
                $stmt->execute();
                $res = array();
                $stmt->bind_result($res['name'], $res['img'], $res['price']);
                $stmt->fetch();
                showProduct($res);
                $stmt->close();
            }
            ?>
        </div>
        <hr class="clear">
    </div>
    <?php
    $conn->close();
    include './templates/footer.php';
    ?>
</body>
</html>

