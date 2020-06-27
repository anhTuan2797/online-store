<?php
include_once 'database.php';
if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && ( $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest' ) )
{
        $myDatabase = new database();
        $query = "SELECT *
    FROM school_project.category_tbl";
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($idField);
        while($stmt->fetch()){
            if($idField == $_GET['productCategory']){
                echo"<option value=\"".$idField."\"selected>".$idField."</option>";
            }
            else{
                echo"<option value=\"".$idField."\">".$idField."</option>";
            }
        }
        $stmt->close();
    }
}
