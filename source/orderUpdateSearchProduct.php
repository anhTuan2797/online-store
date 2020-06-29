<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $query = "SELECT product_id,product_name,product_inStock,product_price,product_sale,product_platform FROM school_project.product_tbl WHERE product_id=" .$_GET['productId'];
    // echo($query);
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($idField,$nameField,$inStockField,$priceField,$saleField,$platformField);
        while($stmt->fetch()){
          if($inStockField==0) echo "product is out of stock";
          else{
            $PriceWithSale = $priceField*(1-$saleField/100);
            echo("<span style=\"color: red\">Id : </span>".$idField." "."<span style=\"color: red\">name : </span>".$nameField." "."<span style=\"color: red\">In stock : </span>".$inStockField." "."<span style=\"color: red\">Price with sale: </span>".$PriceWithSale);
            echo"   ";
            echo "<input type=\"number\" id=\"orderFormProductAmount\" min=\"1\" max=\"".$inStockField."\" value=\"1\">";
            echo"   ";
            echo"<button class = \"round-btn-green\" i onclick=\"addProductToOrder(".$idField.",".$PriceWithSale.")\">
            <i class=\"fa fa-plus\" aria-hidden=\"true\"></i></button>";
          }
        }
        $stmt->close();
    }
}