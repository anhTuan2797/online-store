<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $query = "SELECT customer_id,customer_name,customer_sex,customer_email,customer_tel 
    FROM school_project.customer_tbl WHERE customer_email=" .$_GET['customerEmail'];
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($idField,$NameField,$sexField,$emailField,$telField);
        while($stmt->fetch()){
            echo"<tr>";
            echo"<th>".$idField."</th>";
            echo"<th>".$NameField."</th>";
            echo"<th>".$sexField."</th>";
            echo"<th>".$emailField."</th>";
            echo"<th>".$telField."</th>";
            echo"<th>
            <button class = \"round-btn-red\" id=\"customerDeleteBtn\" onclick=\"showDeleteCustomerNotification(".$idField.")\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>
            </th>";
            echo"</tr>";
        }
        $stmt->close();
    }
}