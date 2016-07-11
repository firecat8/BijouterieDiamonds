<?php

include './templates/connectdb.php';
if (!isset($_SESSION['login'])) {

    if ($_POST['log_post'] == 1) {
        existUser();
    }
}
header("Location: index.php");
?>
