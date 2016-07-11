<?php

if (isset($_POST['showProducts'])) {
    include './templates/connectdb.php';
    echo showBasket();    
    
}
?>
