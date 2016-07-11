<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: index.php");
    exit();
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
        <link href="css/orders.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/searchOptionsOrdersHandler.js"></script>
    </head>
    <?php
    include './templates/LoginUser.php';
    include './templates/adminMenu.php';
    include './templates/searchOptionsOrders.php';
    include './templates/footer.php';
    ?>
</body>
</html>

