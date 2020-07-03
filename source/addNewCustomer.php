<?php
    include_once 'database.php';
    if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    if(checkCustomerEmail($_POST['customerEmail'])){
        echo"email already used";
    }
    elseif(checkCustomerTel($_POST['customerTel'])){
        echo"tel already used";
    }
    else{
        $hashedPassword = $_POST['customerPassword'];
        $hashedPassword = password_hash($hashedPassword,PASSWORD_DEFAULT);
        $myDatabase = new database();
        $query = "INSERT INTO school_project.customer_tbl(
            customer_name,
            customer_email,
            customer_sex,
            customer_tel,
            customer_password
        )
        VALUE ("
            ."\"".$_POST['customerName']."\"".","
            ."\"".$_POST['customerEmail']."\"".","
            ."\"".$_POST['customerSex']."\"".","
            ."\"".$_POST['customerTel']."\"".","
            ."\"".$hashedPassword."\""
        .")";
        $stmt = $myDatabase->prepare($query);
        if($stmt){
            $stmt->execute();
            $stmt->close();
            echo"sign up completed";
        }
    }
}