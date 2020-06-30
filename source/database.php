<?php
class database {
    private $host="localhost";
    private $port=3307;
    private $user="root";
    private $password="060497";
    private $dbname="school_project";
    private $conn;

    function __construct()
    {
        $this->conn = new mysqli($this->host,$this->user,$this->password,$this->dbname,$this->port)
        or die ('Could not connect to the database server' . mysqli_connect_error());
    }

    function __destruct()
    {
        $this->conn->close();
    }

    function checkConnection(){
        if(is_resource($this->conn)) return true;
        else return false;
    }

    function prepare($query){
        return $this->conn->prepare($query);
    }
}

function removeProductInStock($productId,$productAmount){
    $myDatabase = new database();
    $query = "UPDATE school_project.product_tbl
                SET product_inStock=product_inStock-".$productAmount."
                WHERE product_id=".$productId ;
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->close();
    }
}

function addProductFromCancelOrder($orderId){
    $myDatabase = new database();
    $query = "SELECT product_id,orderDetail_amount 
    From school_project.orderDetail_tbl 
    WHERE order_id=".$orderId;
     $stmt = $myDatabase->prepare($query);
     if($stmt){
        $stmt->execute();
        $stmt->bind_result($idField,$amountField);
        while($stmt->fetch()){
            removeProductInStock($idField,-$amountField);
        }
        $stmt->close();
     }
}

function addOrderSum($orderId,$OrderSum){
    $myDatabase = new database();
    $query = "UPDATE school_project.order_tbl 
    SET order_sum=order_sum+".$OrderSum."        
    WHERE order_id=".$orderId;
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->close();
    }
}




