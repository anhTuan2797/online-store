<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $query = "SELECT*FROM school_project.product_tbl WHERE product_sale=" .$_GET['productSale'];
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($idField,$nameField,$inStockField,$priceField,$detailField,$imgField,$saleField,$categoryField,$platformField);
        while($stmt->fetch()){
            echo"<tr>";
            echo"<th>".$idField."</th>";
            echo"<th>".$nameField."</th>";
            echo"<th>".$inStockField."</th>";
            echo"<th>".$priceField."</th>";
            echo"<th>".$platformField."</th>";
            echo"<th>".$saleField."</th>";
            echo"<th>".$categoryField."</th>";
            echo"<th>
            <button class = \"round-btn-blue\" i onclick=\"showEditProductForm("
            .$idField.","."'".$nameField."'".",".$inStockField.",".$priceField.","."'".$platformField."'".",".$saleField.
            ","."'".$categoryField."'".","."'".$detailField."'".","."'".$imgField."'".")\">
            <i class=\"fas fa-pencil-alt\"></i></button>
            </th>";
            echo"</tr>";
        }
        $stmt->close();
    }
}