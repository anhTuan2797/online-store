<?php
include_once'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $query = "DELETE FROM customer_tbl WHERE customer_id =" . $_POST['customerId'];
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
    }
    $stmt->close();
}

