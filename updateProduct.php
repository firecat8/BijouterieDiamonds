<?php

include './templates/connectdb.php';

$price = str_replace("лв.", '', $_GET['price']);
$name = trim($_GET['name']);
$query1 = 'UPDATE `products` SET `product_name`=?,`price`=? WHERE `product_id`= ?';
$stmt = $conn->prepare($query1);
$stmt->bind_param('sii', $name, $price, $_GET['id']);
$stmt->execute();
$stmt->close();
$conn->close();
echo '{"name":"'.$name.'","price":'. $price.',"id":'. $_GET['id'].'}';
