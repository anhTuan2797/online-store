<?php
include_once 'database.php';
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    $myDatabase = new database();
    $query = "SELECT order_sum FROM school_project.order_tbl WHERE order_id=".$_GET['orderId'];
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($sumField);
        $stmt->fetch();
        echo($sumField);
        $stmt->close();
    }
}