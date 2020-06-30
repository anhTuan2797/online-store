<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $query="UPDATE school_project.orderDetail_tbl
            SET orderDetail_sum= orderDetail_sum-orderDetail_sum/orderDetail_amount,
                orderDetail_amount=orderDetail_amount-1
            WHERE product_id=".$_POST['productId']." AND order_id=".$_POST['orderId'];
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->close();
        removeProductInStock($_POST['productId'],-1);
        addOrderSum($_POST['orderId'],-$_POST['productPrice']);
    }
}