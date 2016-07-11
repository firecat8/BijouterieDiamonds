<?php
session_start();
if (isset($_POST['productID']) && isset($_POST['change'])) {
    $id = $_POST['productID'];
    $typeChange = $_POST['change'];
    if (array_key_exists($id, $_SESSION['basket'])) {
        if ($typeChange === "+") {
            $_SESSION['basket'][$id] += 1;
        } elseif ($typeChange === "-") {
            if ($_SESSION['basket'][$id] > 1) {
                $_SESSION['basket'][$id] -= 1;
            }
        }
    }    
    include './templates/connectdb.php';
    $count = array_sum(array_values($_SESSION['basket']));
    $total = orderValue() . ' лв.';
    echo '{"count":'.$count.', "total":"'.$total.'"}';
}
?>

