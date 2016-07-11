<?php

session_start();

function getPriceOfProduct($id) {

    $conn = new mysqli("localhost", "root", "8sZfFTK8WQwhTszC", "diamonds");
    $query = "SELECT price FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($res);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    return $res;
}

$msg = "";
if (isset($_SESSION['user']) && isset($_POST['order']) && isset($_SESSION['user_id']) && count($_SESSION['basket']) > 0) {
    $orderedProducts = $_SESSION['basket'];

    $query = 'INSERT INTO orders ( `user`, `status`, `date_ordered`) VALUES (?,?,?) ';
    $userID = $_SESSION['user_id'];
    $conn = new mysqli("localhost", "root", "8sZfFTK8WQwhTszC", "diamonds");
    $stmt = $conn->prepare($query);
    $date = date('Y-m-d H:i:s');
    $active = 1;
    $stmt->bind_param('iis', $userID, $active, $date);
    $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    $query = 'SELECT order_id FROM orders WHERE user=? AND date_ordered=? ';
    $conn = new mysqli("localhost", "root", "8sZfFTK8WQwhTszC", "diamonds");
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $userID, $date);
    $stmt->execute();
    $orderID;
    $stmt->bind_result($orderID);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    $query = 'INSERT INTO orderedproducts (`order_id`, `product_id`, `product_count`, `product_price`) VALUES ';
    $params = array();
    $allTypes = '';
    foreach ($orderedProducts as $id => $count) {
        $query .= "(?,?,?,?),";
        $params[] = $orderID;
        $params[] = $id;
        $params[] = $count;
        $params[] = getPriceOfProduct($id);

        $allTypes.= 'i';
        $allTypes.= 'i';
        $allTypes.= 'i';
        $allTypes.= 'd';
    }
    $query = substr($query, 0, -1);
    $conn = new mysqli("localhost", "root", "8sZfFTK8WQwhTszC", "diamonds");
    $stmt = $conn->prepare($query);
    $params = array_merge(array($allTypes), array_values($params));
    $ref = array();
    foreach ($params as $key => $value) {
        $ref[$key] = &$params[$key];
    }
    call_user_func_array(array(&$stmt, 'bind_param'), $ref);
    $stmt->execute();
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    unset($_SESSION['basket']);
    $msg = "Успешна поръчка! Благодарим,че пазарувате при нас!";
} else {
    $msg = 'Само регистрирани потребители могат да поръчват!';
}
echo $msg; //.' user'.$_SESSION['user'].' order'.$_POST['order'].' id'.$_SESSION['user_id'];
?>

