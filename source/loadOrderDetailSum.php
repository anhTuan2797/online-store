<?php
include_once 'database.php';
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    $myDatabase = new database();
    $query = "SELECT orderDetail_sum FROM school_project.orderDetail_tbl WHERE product_id=".$_GET['productId']." AND order_id=".$_GET['orderId'];
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($sumField);
        $stmt->fetch();
        echo($sumField);
        $stmt->close();
    }
}
