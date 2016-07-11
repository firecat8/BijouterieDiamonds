<?php

include './templates/connectdb.php';

if (isset($_FILES['picture']) && isset($_POST['color']) && isset($_POST['metal']) && isset($_POST['bijou']) && isset($_POST['priceproduct'])) {

    $path = $_FILES['picture']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $newImage = date_timestamp_get(date_create()) . "." . $ext;

    if (move_uploaded_file($_FILES['picture']['tmp_name'], 'img' . DIRECTORY_SEPARATOR . $newImage)) {
    $res = [];
    $query = "SELECT color_id FROM color WHERE color_type=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_POST['color']);
    $stmt->execute();
    $stmt->bind_result($res['color_id']);
    $stmt->fetch();
    $stmt->close();

    $query = "SELECT metal_id FROM metal WHERE metal_type=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_POST['metal']);
    $stmt->execute();
    $stmt->bind_result($res['metal_id']);
    $stmt->fetch();
    $stmt->close();

    $query = "SELECT bijou_id FROM bijou WHERE bijou_type=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $_POST['bijou']);
    $stmt->execute();
    $stmt->bind_result($res['bijou_id']);
    $stmt->fetch();
    $stmt->close();

    $query = 'INSERT INTO `products`(`product_name`,'
            . ' `product_img`, `color`, `metal`, `bijou`, `price`,'
            . '`date_added`) VALUES ( ?,?,?,?,?,?,?);';
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssdddds", $_POST['nameproduct'], $newImage, $res['color_id'], $res['metal_id'], $res['bijou_id'], $_POST['priceproduct'], date('Y-m-d H:i:s'));
    if ($stmt->execute()) {
        $_SESSION['isADD']=TRUE;
    }
    else{
        $_SESSION['isADD']=FALSE;
    }
    $stmt->close();
    $conn->close();
        
    } else {
        echo 'Not move image!!!! ' . $newImage. ' '.$path. "<br> ".$_FILES['picture']['error']. "<br> " ;
        var_dump($_FILES['picture']);
        
          $error_message = $error_types[$_FILES['picture']['error']];
          echo $error_message;
        exit();
    }
}
header ('Location: add.php');
exit();