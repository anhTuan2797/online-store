<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $query = "UPDATE school_project.order_tbl
    SET order_status = \"canceled\"
    WHERE order_id=" .$_POST['orderId'];
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->close();
        addProductFromCancelOrder($_POST['orderId']);
    }
}