<?php
include_once'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $query = "DELETE FROM orderDetail_tbl WHERE order_id =" . $_POST['orderId']." AND product_id=".$_POST['productId'];
    echo($query);
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->close();
    }
}
