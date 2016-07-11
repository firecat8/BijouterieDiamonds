<?php 

$conn = new mysqli("localhost", "root", "8sZfFTK8WQwhTszC", "diamonds");
mysqli_set_charset($conn, 'utf8');
$query = "SELECT p.product_name AS 'name',p.product_img AS 'img', op.product_count as 'count' , op.product_price as 'price'"
        . " FROM products p"
        . " JOIN orderedproducts op ON op.product_id = p.product_id"
        . " WHERE op.order_id = ?;";
$stmt1 = $conn->prepare($query);
$stmt1->bind_param('i', $_GET['order_id']);
$stmt1->execute();
$row = array();
$stmt1->bind_result($row['name'], $row['img'], $row['count'], $row['price']);
$res = $stmt1->get_result();
$products = $res->fetch_all(MYSQLI_ASSOC);
$stmt1->close();
$conn->close();


echo json_encode($products);