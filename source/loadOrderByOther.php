<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $query = "SELECT order_id,customer_id,order_sum,date_format(order_date,'%m/%d/%Y'),order_status FROM school_project.order_tbl 
    WHERE customer_id=".$_GET['customerId'].
        " or order_sum=".$_GET['orderSum'].
        " or order_date="."\"".$_GET['orderDate']."\"".
        " or order_status="."\"".$_GET['orderStatus']."\"";
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($idField,$customerField,$sumField,$dateField,$statusField);
        while($stmt->fetch()){
        echo"<tr>";
        echo"<th>".$idField."</th>";
        echo"<th>".$customerField."</th>";
        echo"<th>".$sumField."</th>";
        echo"<th>".$dateField."</th>";
        echo"<th>".$statusField."</th>";
        if($statusField=="processing"){
        echo"<th>
        <button class = \"round-btn-red\" i onclick=\"showCancelOrderNotification(".$idField.")\">
        <i class=\"fas fa-trash-alt\"></i></button>
        <button class = \"round-btn-blue\" i onclick=\"showUpdateOrderForm(".$idField.",".$customerField.","."'".$dateField."'".",".$sumField.")\">
        <i class=\"fas fa-pencil-alt\"></i></button>
        </th>";
        }
        else{
            echo"<th>
            <button class = \"round-btn-blue\" i onclick=\"showOrderDetail(".$idField.",".$customerField.","."'".$dateField."'".")\">
            <i class=\"fas fa-pencil-alt\"></i></button>
            </th>";
        }
        echo"</tr>";
    }
        $stmt->close();
    }
}