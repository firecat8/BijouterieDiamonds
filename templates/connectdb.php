<?php

if (!isset($_SESSION)) {
    session_start();
}
$conn = new mysqli("localhost", "root", "", "diamonds");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function orderValue() {
    $conn = new mysqli("localhost", "root", "", "diamonds");
    $products = $_SESSION['basket'];
    $count = count($products);
    $total = 0;
    if ($count > 0) {
        $query = "SELECT product_id, price FROM products  WHERE ";
        $params = array();
        foreach ($products as $key => $value) {
            $query.=" product_id=? OR ";
            $params[$key] = $key;
        }
        $query = substr($query, 0, -3);
        $stmt = $conn->prepare($query);
        $params = array_merge(array(str_repeat('i', count($params))), array_values($params));
        $ref = array();
        foreach ($params as $key => $value) {
            $ref[$key] = &$params[$key];
        }
        call_user_func_array(array(&$stmt, 'bind_param'), $ref);
        $stmt->execute();
        $res = '';
        $id = 0;
        $stmt->bind_result($id, $res);
        while ($stmt->fetch()) {
            $total += ($res * $_SESSION['basket'][$id]);
        }

        $stmt->close();
    }
    $conn->close();
    return $total;
}

function showBasket() {
    $conn = new mysqli("localhost", "root", "", "diamonds");
    $products = $_SESSION['basket'];
    $basket = "";
    $count = count($products);
    if ($count > 0) {
        $query = "SELECT product_id, product_name, product_img, price FROM products  WHERE ";
        $params = array();
        foreach ($products as $key => $value) {
            $query.=" product_id=? OR ";
            $params[$key] = $key;
        }
        $query = substr($query, 0, -3);
        $stmt = $conn->prepare($query);
        $params = array_merge(array(str_repeat('i', count($params))), array_values($params));
        $ref = array();
        foreach ($params as $key => $value) {
            $ref[$key] = &$params[$key];
        }
        call_user_func_array(array(&$stmt, 'bind_param'), $ref);
        $stmt->execute();
        $res = [];
        $stmt->bind_result($res['product_id'], $res['product_name'], $res['product_img'], $res['price']);

        while ($stmt->fetch()) {
            $basket .= '<div class="product" >
                <a href="img/' . $res['product_img'] . '" class="imglink"><img src="img/' . $res['product_img'] . '" class="resultimg" ></a>      
                 <div class="infoproduct " >
                    <label class="name" >' . $res['product_name'] . '</label>
                    <label class="price" >' . $res['price'] . ' лв.</label>
                    <input type="button" class="countbtn" value="-" data-product-id="' . $res['product_id'] . '">
                    <label class="count" data-product-id="' . $res['product_id'] . '">' . $_SESSION['basket'][$res['product_id']] . '</label>
                    <input type="button" class="countbtn" value="+" data-product-id="' . $res['product_id'] . '">
                </div>
                <span class="delicon" data-product-id="' . $res['product_id'] . '">X</span>
            </div>';
        }
        $stmt->close();
    }
    $conn->close();
    return $basket;
}

function existUser() {
    $conn = new mysqli("localhost", "root", "", "diamonds");
    $name = addslashes($_POST['username']);
    $pass = trim($_POST['pass']);
    $pass = md5($pass);
    $query = "SELECT user_id, user_name, isAdmin FROM users WHERE user_name=? AND user_pass=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $name, $pass);
    $stmt->execute();
    $_SESSION['admin'] = false;
    $_SESSION['user'] = true;
    $res['user_id'] = '';
    $res['user_name'] = '';
    $res['isAdmin'] = 0;
    $stmt->bind_result($res['user_id'], $res['user_name'], $res['isAdmin']);
    if ($stmt->fetch()) {
        $_SESSION['login'] = TRUE;
        $_SESSION['user_id'] = $res['user_id'];
        $_SESSION['user_name'] = $res['user_name'];
        if ($res['isAdmin'] === 1) {
            $_SESSION['admin'] = TRUE;
            $_SESSION['redirection'] = 1;
            $_SESSION['user'] = FALSE;
        }
    }
    $stmt->close();
    $conn->close();
}

function showProductsForUser($stmt, $conn) {
    $stmt->execute();
    $res = [];
    $stmt->bind_result($res['product_id'], $res['product_name'], $res['product_img'], $res['price']);
    $counter = 0;
    while ($stmt->fetch()) {
        echo '<div class="product">
                <a href="img/' . $res['product_img'] . '" class="imglink"><img src="img/' . $res['product_img'] . '" class="resultimg" ></a>      
                <div class="infoproduct" >
                <div class="nameDiv"> <input type="text" placeholder="Име" class="nameTextReadOnlyInput"  value="' . $res['product_name'] . '" data-product-id="' . $res['product_id'] . '" readonly="readonly"></div>
                 <div class="priceDiv"><input type="text" placeholder="Цена" class="priceTextReadOnlyInput" value="' . $res['price'] . ' лв." data-product-id="' . $res['product_id'] . '" readonly="readonly"></div>                 
                    <input type="button" class="orderbtn" data-product-id="' . $res['product_id'] . '" value="Поръчай">
                </div>
              </div>';
        $counter++;
    }
    if ($counter == 0) {
        echo '<label id="noresults"> Няма открити резултати</label>';
    }
    $stmt->close();
    $conn->close();
}

function showProductsForAdmin($stmt, $conn) {
    $stmt->execute();
    $res = [];
    $stmt->bind_result($res['product_id'], $res['product_name'], $res['product_img'], $res['price']);
    $counter = 0;
    while ($stmt->fetch()) {
        echo '<div class="product" data-product-id="' . $res['product_id'] . '">
                <a href="img/' . $res['product_img'] . '" class="imglink"><img src="img/' . $res['product_img'] . '" class="resultimg" ></a>      
                <div class="infoproduct" data-product-id="' . $res['product_id'] . '">
                <div class="nameDiv"> <input type="text" placeholder="Име" class="nameTextReadOnlyInput"  value="' . $res['product_name'] . '" data-product-id="' . $res['product_id'] . '" readonly="readonly"></div>
                 <div class="priceDiv"><input type="text" placeholder="Цена" class="priceTextReadOnlyInput" value="' . $res['price'] . ' лв." data-product-id="' . $res['product_id'] . '" readonly="readonly"></div>                 
                    <input type="button" class="orderbtn" data-product-id="' . $res['product_id'] . '" value="Поръчай">
                    <input type="button" class="redactionbtn" data-product-id="' . $res['product_id'] . '" value="Редактиране">
                </div>
              </div>';
        $counter++;
    }
    if ($counter == 0) {
        echo '<label id="noresults"> Няма открити резултати</label>';
    }
    $stmt->close();
    $conn->close();
}
?>

