<?php

include 'connectdb.php';
$query = "SELECT products.product_id, products.product_name, products.product_img, products.price FROM products ";
$join = " ";
$where = " ";
$orderby = " ";
$params = array();
if (isset($_GET['order'])) {
    $order = $_GET['order'];
    switch ($order) {
        case 'nameasc':
            $orderby = " ORDER BY products.product_name ASC";
            break;
        case 'namedesc':
            $orderby = " ORDER BY products.product_name DESC";
            break;
        case 'priceasc':
            $orderby = " ORDER BY products.price ASC";
            break;
        case 'pricedesc':
            $orderby = " ORDER BY products.price DESC";
            break;
        default:
            break;
    }
}
if (isset($_GET['bijou'])) {
    $join .= " JOIN bijou ON products.bijou=bijou.bijou_id ";
    if (is_array($_GET['bijou'])) {
        $where .= " (";
        foreach ($_GET['bijou'] as $value) {
            $where .= "  bijou.bijou_type=? OR";
            $params[$value] = $value;
        }
        $where = substr($where, 0, -3);
        $where .= "  ) AND";
    } else {
        $where .= "  bijou.bijou_type=? AND";
        $params[$_GET['bijou']] = $_GET['bijou'];
    }
}
if (isset($_GET['metal'])) {
    $join .= " JOIN metal ON products.metal=metal.metal_id ";
    if (is_array($_GET['metal'])) {
        $where .= "  ( ";
        foreach ($_GET['metal'] as $value) {
            $where .= "  metal.metal_type=? OR ";
            $params[$value] = $value;
        }
        $where = substr($where, 0, -3);
        $where .= "  ) AND";
    } else {
        $where .= "  metal.metal_type=? AND";
        $params[$_GET['metal']] = $_GET['metal'];
    }
}
if (isset($_GET["color"]) && $_GET["color"] != "all") {
    $join .= " JOIN color ON products.color=color.color_id ";
    $where .= "  color.color_type=? AND";
    $params[$_GET['color']] = $_GET['color'];
}

if (isset($_GET["products"]) && $_GET["products"] === "all") {
    $where = substr($where, 0, -3);
} else if (isset($_GET["products"]) && $_GET["products"] === "news") {
    $where .= " DATEDIFF(NOW(),date(date_added)) < 14 ";
} else if (isset($_GET["products"]) && $_GET["products"] === "promo") {
    $where .= " promo > 0 ";
}
$count = strlen($where);
$hasParams = FALSE;
if ($count > 1) {
    $query = $query . $join . " WHERE " . $where . $orderby;
} else {
    $query = $query . $orderby;
}

$count = count($params);
if ($count > 0) {
    $hasParams = TRUE;
}
if (($stmt = $conn->prepare($query))) {
    if ($hasParams) {
        $params = array_merge(array(str_repeat('s', count($params))), array_values($params));
        $ref = array();
        foreach ($params as $key => $value) {
            $ref[$key] = &$params[$key];
        }
        call_user_func_array(array(&$stmt, 'bind_param'), $ref);
    }
    if (isset($_SESSION['admin']) && $_SESSION['admin'] === TRUE) {
        showProductsForAdmin($stmt, $conn);
    } else {
        showProductsForUser($stmt, $conn);
    }
}
?>
