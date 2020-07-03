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

function checkCustomerEmail($customerEmail){
    $myDatabase = new database();
    $query = "SELECT customer_email from school_project.customer_tbl";
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($emailField);
        while($stmt->fetch()){
            if(!strcmp($customerEmail,$emailField)) return true;
        }
        $stmt->close();
        return false;
    }
}

function checkCustomerTel($customerTel){
    $myDatabase = new database();
    $query = "SELECT customer_tel from school_project.customer_tbl";
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($TelField);
        while($stmt->fetch()){
            if(!strcmp($customerTel,$TelField)) return true;
        }
        $stmt->close();
        return false;
    }
}

function checkEmailAndPassword($email,$password){
    $myDatabase = new database();
    $query = "SELECT customer_id,customer_password FROM school_project.customer_tbl WHERE customer_email="."\"".$email."\"";
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($idField,$passwordField);
        $stmt->fetch();
        if(password_verify($password,$passwordField)){
            return $idField;
        }
        else {
            return false;
        }
    }
}

function loadOrderDetail($orderId){
    $myDatabase = new database();
    $query = "select product_name, orderDetail_amount from orderDetail_tbl inner join product_tbl on orderDetail_tbl.product_id = product_tbl.product_id where order_id =".$orderId;
    $stmt = $myDatabase->prepare($query);
    if($stmt){
        $stmt->execute();
        $stmt->bind_result($nameField,$amountField);
        $result = array();
        $count = 0;
        while($stmt->fetch()){
            $result[$count] = $nameField;
            $result[$count+1] = $amountField;
            $count += 2;
        }
        
        return $result;
    }
}


