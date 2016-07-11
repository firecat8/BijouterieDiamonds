<div class="main" id="mainline3">
    <hr class="clear">
    <h1>Последно добавени</h1>
    <div class="topproducts">
        <?php
        include 'connectdb.php';
        $query = "SELECT product_id, product_name, product_img, price FROM products ORDER BY date_added DESC LIMIT 4";
        $stmt=$conn->prepare($query);
        showProductsForUser($stmt, $conn);
        ?>
    </div>
    <hr class="clear">
</div>