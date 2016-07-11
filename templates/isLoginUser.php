<body>    
    <div class="main" id="mainline1">
        <?php
        if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
                if (isset($_SESSION['redirection']) && $_SESSION['redirection'] === 1) {
                    $_SESSION['redirection'] = 0;
                    header('Location: add.php');
                    exit();
                } else {
                    include 'greeting.php';
                }
            } elseif (isset($_SESSION['user']) && $_SESSION['user'] === true) {
                include 'greeting.php';
            }
        } else {
            include 'loginform.php';
        }
        ?>
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

