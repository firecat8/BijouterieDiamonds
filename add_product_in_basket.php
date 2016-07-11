<?php
session_start();
if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = array();
}
$id = $_POST['productID'];
if (array_key_exists($id, $_SESSION['basket'])) {
    $_SESSION['basket'][ $id] += 1;
} else {
    $_SESSION['basket'][ $id] = 1;
}
$countProducts = array_sum(array_values($_SESSION['basket']));
echo '{"orderedProducts":' . $countProducts . '}';
?>