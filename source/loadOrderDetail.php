<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $query = "SELECT school_project.orderDetail_tbl.product_id,product_name,orderDetail_amount,orderDetail_sum
    FROM school_project.product_tbl INNER JOIN school_project.orderDetail_tbl 
    ON school_project.orderDetail_tbl.product_id = school_project.product_tbl.product_id  
    WHERE order_id=".$_GET['orderId'];
    $stmt = $myDatabase->prepare($query);
    $rowCount = countRow($_GET['orderId']);
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($idField,$nameField,$amountField,$sumField);
        $orderSum =0;
        $status = $_GET['orderStatus'];
        echo '<table class="order-detail-result">
            <tr>
            <th> product id </th>
            <th>product name</th>
            <th>amount</th>
            <th>sum</th>
            <th></th>
            </tr>
            <tr>';
        while($stmt->fetch()){
            $orderSum+= $sumField;
            echo"<th>".$idField."</th>";
            echo"<th>".$nameField."</th>";
            echo"<th>".$amountField."</th>";
            echo"<th>".$sumField."</th>";
            if(!strcmp($status,"processing")){
            echo"<th><button class = \"round-btn-red\" i onclick=\"deleteProductFromOrder(".$idField.",".$rowCount.")\">
            <i class=\"fas fa-trash-alt\"></i></button></th>";
            }
            else{
                echo"<th></th>";
            }
        }
        echo'</tr>
            <tr>
            <th style="grid-column: 1/span 3; background-color: #666">sum</th>
            <th>'.$orderSum.'</th>
            </tr>
            </table>';
        $stmt->close();
    }
}

function countRow($OrderId){
    $myDatabase = new database();
    $query = "SELECT school_project.orderDetail_tbl.product_id,product_name,orderDetail_amount,orderDetail_sum
    FROM school_project.product_tbl INNER JOIN school_project.orderDetail_tbl 
    ON school_project.orderDetail_tbl.product_id = school_project.product_tbl.product_id  
    WHERE order_id=".$OrderId;
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        while($stmt->fetch()){
        }
        return $stmt->num_rows();
    }
}