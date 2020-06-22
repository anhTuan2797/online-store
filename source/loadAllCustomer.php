<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
    $myDatabase = new database();
    $query = "SELECT customer_id,customer_name,customer_sex,customer_email,customer_tel 
    FROM school_project.customer_tbl";
    $stmt = $myDatabase->prepare($query);
    $table = "
    <tr>
    <th>id</th>
    <th>name</th>
    <th>sex</th>
    <th>email</th>
    <th>tel</th>
    <th></th>
    </tr>
    <tr>
    <form method=\"get\"></form>
    <th><input type=\"number\" name=\"user_id\" id=\"userId\"></th>
    <th><input type=\"text\" name=\"user_name\" id=\"userName\"></th>
    <th><input type=\"text\" name=\"user_sex\" id=\"userSex\"></th>
    <th><input type=\"email\" name=\"user_email\" id=\"userEmail\"></th>
    <th><input type=\"tel\" name=\"user_tel\" id=\"userTel\"></th>
    </tr>
    ";
    echo $table;
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($idField,$NameField,$sexField,$emailField,$telField);
        while($stmt->fetch()){
            echo"<tr?>";
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
    }
    $stmt->close();
} 
