<?php

$errors = array();
$fname = trim($_POST['firstname']);
$lname = trim($_POST['lastname']);
$number = $_POST['number'];
$mail = $_POST['mail'];
$user = $_POST['username'];
$pass = $_POST['pass'];
if (strlen($fname) < 2 || strlen($fname) > 20 || strlen($lname) < 2 || strlen($lname) > 20) {
    $errors[] = 'Позволен брой символи за имената е от 2 до 20.';
}
if (!(preg_match("/^([^0-9]+)$/", $fname) === 1 && preg_match("/^([^0-9]+)$/", $lname) === 1)) {
    $errors[] = 'Имената трябва да бъдат на кирилица.';
}
if (!(preg_match("/\d{5,15}$/", $number) === 1)) {
    $errors[] = 'Телефонния номер трябва да съдържа само цифри и да има дължина от 5 до 15 цифри.';
}
if (!(preg_match("/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $mail) === 1)) {
    $errors[] = 'Невалиден e-mail адрес.';
}
if (!(preg_match("/[A-Za-z0-9]{5,20}$/", $user) === 1)) {
    $errors[] = 'Позволен брой символи за потребителкото име е от 5 до 20.';
}
if (!(preg_match("/[A-Za-z0-9]{5,20}$/", $pass) === 1)) {
    $errors[] = 'Невалиден формат въведена парола. Позволен брой символи от 5 до 20.';
}
if (count($errors) === 0) {
    $conn = new mysqli("localhost", "root", "8sZfFTK8WQwhTszC", "diamonds");
    mysqli_set_charset($conn, 'utf8');
    $query = "INSERT INTO users( first_name, last_name, tel_number,"
            . " mail, user_name, user_pass, reg_date) "
            . " VALUES (?,?,?,?,?,?,?);";
    $stmt = $conn->prepare($query);
    $notAdmin = '0';
    $stmt->bind_param("ssdssss", $fname, $lname, $number, $mail, $user, md5($pass), date('Y-m-d H:i:s'));
    if ($stmt->execute()) {
        $errors[] = 'Успешна регистрация!';
    } else {
        $errors[] = 'Неуспешна регистрация! Моля въведете друг e-mail адрес!';
    }
    $stmt->close();
    $conn->close();
}
echo json_encode($errors);
