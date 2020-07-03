<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    if(!checkEmailAndPassword($_POST['customerEmail'],$_POST['customerPassword'])){
        echo "wrong email or password";
    }
    else {
        session_start();
        $userId = checkEmailAndPassword($_POST['customerEmail'],$_POST['customerPassword']);
        $_SESSION['userId'] = $userId;
        echo ($_SERVER['HTTP_REFERER']);
    }
}