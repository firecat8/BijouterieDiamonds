<?php

if (isset($_SESSION['login'])) {
    if ($_SESSION['login'] === true) {
        if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
            include 'adminMenu.php';
        } elseif (isset($_SESSION['user']) && $_SESSION['user'] === true) {
            include 'userMenu.php';
        }
    }
} else {
    include 'userMenu.php';
}
?>