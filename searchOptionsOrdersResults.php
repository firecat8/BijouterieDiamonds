<?php

session_start();

function getUserNames($userID) {
    $conn = new mysqli("localhost", "root", "8sZfFTK8WQwhTszC", "diamonds");
    mysqli_set_charset($conn, 'utf8');
    $query = "SELECT first_name, last_name FROM users  WHERE user_id=? ";
    $stmt1 = $conn->prepare($query);
    $stmt1->bind_param('i', $userID);
    $stmt1->execute();
    $row = array();
    $stmt1->bind_result( $row['first_name'] , $row['last_name']);
    $stmt1->fetch();
    $stmt1->close();
    $conn->close();
    return $row['first_name'].' '.$row['last_name'];
}

function getOrderValue($order) {

    $conn = new mysqli("localhost", "root", "8sZfFTK8WQwhTszC", "diamonds");
    $query = "SELECT order_id, SUM(product_count * product_price) as 'total' "
            . "FROM orderedproducts "
            . "WHERE order_id=?  "
            . "GROUP BY order_id";
    $stmt1 = $conn->prepare($query);
    $stmt1->bind_param('i', $order['order_id']);
    $stmt1->execute();
    $row = array();
    $stmt1->bind_result($row['order_id'], $row['total']);
    $stmt1->fetch();
    $stmt1->close();
    $conn->close();
    return '<div class="orderSum">Стойност : ' . $row['total'] . '</div>';
}

function createOrderDesign($order) {
    $orderDesign = '<div class="order" data-order-id="' . $order['order_id'] . '">
            <div class="user">Потребител : ' . getUserNames($order['user']) . '</div>';
    $orderDesign .= getOrderValue($order);
    $orderDesign .=' <div class="orderDate">Дата : ' . $order['date_ordered'] . '</div>';
    if ($order['status'] === 0) {
        $orderDesign .='<div class="orderType">Приключена</div>';
    } elseif ($order['status'] === 1) {
        $orderDesign .='<div class="orderType"  data-order-id="' . $order['order_id'] .'-'. $order['order_id'] . '">'
                . 'Активна | <input type="button" class="endbtn" value="Приключи"  data-order-id="'. $order['order_id'] . '"></div>';
    }
    echo $orderDesign.'</div>' ;
}

if (isset($_POST['typeOrders'])) {
    $conn = new mysqli("localhost", "root", "8sZfFTK8WQwhTszC", "diamonds");
    mysqli_set_charset($conn, 'utf8');
    $query = "SELECT user, order_id, status, date_ordered FROM orders";
    $where = '';
    $orderby = " ORDER BY status DESC, date_ordered DESC";
    $typeOrders = $_POST['typeOrders'];
    $params = -1;
    switch ($typeOrders) {
        case "active":
            $where = " WHERE orders.status=?";
            $params = 1;
            break;
        case "done":
            $where = " WHERE orders.status=?";
            $params = 0;
            break;
    }
    $query .= $where . $orderby;
    $stmt = $conn->prepare($query);
    if ($params !== -1) {
        $stmt->bind_param('i', $params);
    }
    $stmt->execute();
    $row = array();
    $stmt->bind_result($row['user'], $row['order_id'], $row['status'], $row['date_ordered']);
    $order = array();
    while ($stmt->fetch()) {
        createOrderDesign($row);
    }
    $stmt->close();
    $conn->close();
}

