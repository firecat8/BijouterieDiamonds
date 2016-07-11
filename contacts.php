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
        <link href="css/admin.css" rel="stylesheet">
    </head>
    <?php
    include './templates/isLoginUser.php';
    include './templates/menu.php';
    ?>
    <div class="main" id="mainline3">
        <hr class="clear">
        <p id="contacts">
            За контакти<br><br>

            Клиентският ни офис се намира в: <br>
            гр. Варна, ул. "Иван Страцимир" 2, ет. 2, офис 327<br><br>

            Тел:<br>
            052/ 11 11 11 (за абонати на фиксирани мрежи)<br>
            0882 / 88 88 88 (за абонати на Мтел)<br>
            0898 / 98 98 98 (за абонати на Глобул)<br><br>

            Ел. поща: office@diamonds.com<br>
        </p>
        <hr class="clear">
    </div>
    <?php
    include './templates/footer.php';
    ?>
</body>
</html>

