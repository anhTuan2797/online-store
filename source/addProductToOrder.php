<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $orderSum = $_POST['productPrice']*$_POST['productAmount'];
    $myDatabase = new database();
    if(checkProduct($_POST['productId'],$_POST['orderId'])) {
        $query = "UPDATE school_project.orderDetail_tbl 
                SET orderDetail_amount = orderDetail_amount +".$_POST['productAmount'].
                ",orderDetail_sum= orderDetail_sum + " .$orderSum;
         $stmt = $myDatabase->prepare($query);
        if($stmt){
        $stmt->execute();
        $stmt->close();
        removeProductInStock($_POST['productId'],$_POST['productAmount']);
        }
    }
    else {
    $query = 'INSERT INTO 
    school_project.orderDetail_tbl (
      order_id, 
      orderDetail_sum, 
      orderDetail_amount, 
      product_id
    )
  values
    ('
        .$_POST['orderId'].','
        .$orderSum.','
        .$_POST['productAmount'].','
        .$_POST['productId'].
    ')';
   $stmt = $myDatabase->prepare($query);
   if($stmt){
       $stmt->execute();
       $stmt->close();
       removeProductInStock($_POST['productId'],$_POST['productAmount']);
   }
}
}

function checkProduct($productId,$orderId){
    $myDatabase = new database();
    $query = "SELECT product_id from school_project.orderDetail_tbl WHERE order_id=".$orderId;
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($idField);
        while($stmt->fetch()){
            if($idField == $productId) return true;
        }
        return false;
    } 
}

