<?php

session_start();
if (isset($_POST['productID'])) {
    $id = $_POST['productID'];
    $products = $_SESSION['basket'];
    if (array_key_exists($id, $products)) {
        unset($_SESSION['basket'][$id]);
    } else {
        
    }
    include './templates/connectdb.php';
    $count = array_sum(array_values($_SESSION['basket']));
    $total = orderValue() . ' лв.';
    echo '{"count":'.$count.', "total":"'.$total.'"}';
}
?>
