<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $query = "UPDATE school_project.customer_tbl 
    SET customer_name="."\"".$_POST['customerName']."\","
        ."customer_sex="."\"".$_POST['customerSex']."\","
        ."customer_tel="."\"".$_POST['customerTel']."\""
    ." WHERE customer_id= ".$_POST['customerId'];
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->close();
        echo("update success");
    }
}