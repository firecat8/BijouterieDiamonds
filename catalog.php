<?php
session_start();
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
        <link href="css/catalog.css" rel="stylesheet">
        <link href="css/admin.css" rel="stylesheet">
        <script src="js/jquery.min.js"></script>
        <script src="js/searchHandler.js"></script>
    </head>
    <?php
    include './templates/isLoginUser.php';
    include './templates/menu.php';
    include './templates/search.php';
    include './templates/footer.php';
    ?>
    <input type="hidden" value="" class='' name=''>
</body>
</html>

