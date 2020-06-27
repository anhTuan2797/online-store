<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $query = "UPDATE school_project.product_tbl 
    SET product_name="."\"".$_POST['productName']."\","
    ."product_inStock=".$_POST['productInStock'].","
    ."product_price=" .$_POST['productPrice'].","
    ."product_platform=" ."\"".$_POST['productPlatform']."\","
    ."product_sale=" .$_POST['productSale'].","
    ."product_detail=" ."\"".$_POST['productDetail']."\"".","
    ."product_imgUrl=" ."\"".$_POST['productImgUrl']."\"".","
    ."category_id="."\"".$_POST['productCategory']."\""
    ." WHERE product_id= ".$_POST['productId'];
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->close();
    }
}