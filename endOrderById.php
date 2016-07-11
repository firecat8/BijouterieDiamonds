<?php

$conn = new mysqli("localhost", "root", "8sZfFTK8WQwhTszC", "diamonds");
mysqli_set_charset($conn, 'utf8');
$query = "UPDATE `orders` SET `status`= 0 WHERE  `order_id`= ?;";
$stmt1 = $conn->prepare($query);
$stmt1->bind_param('i', $_GET['order_id']);
$success = 'FALSE';
if($stmt1->execute() === TRUE){
    $success = 'TRUE';
}
$stmt1->close();
$conn->close();


echo $success;

