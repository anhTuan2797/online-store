<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $query = "INSERT INTO school_project.product_tbl(
        category_id,
        product_detail,
        product_imgUrl, 
        product_inStock, 
        product_name, 
        product_platform, 
        product_price, 
        product_sale
        )
        VALUE("
            ."\"".$_POST['productCategory']."\"".","
            ."\"".$_POST['productDetail']."\"".","
            ."\"".$_POST['productImgUrl']."\"".","
            .$_POST['productInStock'].","
            ."\"".$_POST['productName']."\"".","
            ."\"".$_POST['productPlatform']."\"".","
            .$_POST['productPrice'].","
            .$_POST['productSale']
            .")";
        $stmt = $myDatabase->prepare($query);
        if($stmt){
            $stmt->execute();
            $stmt->close();
            }
}