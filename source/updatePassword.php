<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $hashedPassword = password_hash($_POST['newPassword'],PASSWORD_DEFAULT);
    $query = "UPDATE school_project.customer_tbl 
    SET customer_password="."\"".$hashedPassword."\""
    ." WHERE customer_id= ".$_POST['customerId'];
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->close();
        echo("update success");
    }
}