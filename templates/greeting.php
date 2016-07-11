<div class="hello">
    <?php
    if ($_SESSION['login'] === true) {
        echo '<label class="loginput">Здравейте,' . $_SESSION['user_name'] . '</label>'
        . '<a href="logout.php" id="reglink">Излез</a>';
    } else {
        header('Location: index.php');
    }
    ?>
</div>
