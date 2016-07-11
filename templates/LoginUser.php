<div class="main" id="mainline1">
    <div class="hello">
        <?php
        if ($_SESSION['login'] === true) {
            echo '<label class="loginput">Здравейте,' . $_SESSION['user_name'] . '</label>'
            . '<a href="logout.php" id="reglink">Излез</a>';
        } else {
            header('Location: index.php');
            exit();
        }
        ?>
    </div>
    <div id="rightcontent">
        <a href="basket.php" id="basketlink">
            <?php
            if (!isset($_SESSION['basket'])) {
                $_SESSION['basket'] = array();
            }
            echo 'Кошница(' . array_sum(array_values($_SESSION['basket'])) . ')';
            ?>
        </a>
    </div>
    <hr class="clear">
</div>