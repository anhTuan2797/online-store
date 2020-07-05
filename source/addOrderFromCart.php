<?php
    include_once 'database.php';
    if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $cartId = $_POST['cartId'];
    $orderAddress = $_POST['orderAddress'];
    $customerId = loadCustomerIdFromCart($cartId);
    addNewOrder($customerId,$cartId,$orderAddress);
    $query = "select product_tbl.product_id, product_price,product_sale, cartProduct_amount from product_tbl inner join shoppingcartdetail_tbl on product_tbl.product_id = shoppingcartdetail_tbl.product_id where cart_id=".$cartId;
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($idField,$priceField,$saleField,$amountField);
        while($stmt->fetch()){
            $orderSum = $priceField*(1-$saleField*0.01)*$amountField;
            addOrderDetail($cartId,$idField,$amountField,$orderSum);
            addOrderSum($cartId,$orderSum);
            removeProductInStock($idField,$amountField);
        }
        deleteCart($cartId);
        $stmt->close();
    }
}
