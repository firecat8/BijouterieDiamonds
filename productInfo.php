<?php
session_start();
if (!isset($_SESSION['admin'])) {
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
        <link href="css/catalog.css" rel="stylesheet">
        <link href="css/reg.css" rel="stylesheet">
        <link href="css/admin.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>  
    </head>
    <body>
        <?php
        include './templates/LoginUser.php';
        include './templates/adminMenu.php';
        ?>
        <div class="main" id="mainline3">
            <hr class="clear">
            
            <hr class="clear">
        </div>
        <?php
        include './templates/footer.php';
        ?>
    </body>
</html>

