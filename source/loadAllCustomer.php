<?php
include_once 'database.php';
$myDatabase = new database();
$query = "SELECT * FROM school_project.customer_tbl";
$stmt = $myDatabase->prepare($query);
echo"
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
if($stmt){
    $stmt->execute();
    $stmt->bind_result($field1,$field2,$field3,$field4,$field5,$field6);
    while($stmt->fetch()){
        echo"<tr?>";
        echo"<th>".$field1."</th>";
        echo"<th>".$field2."</th>";
        echo"<th>".$field3."</th>";
        echo"<th>".$field4."</th>";
        echo"<th>".$field5."</th>";
        echo"<th>
        <button class = \"round-btn-red\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></button>
        <button class = \"round-btn-blue\"><i class=\"fas fa-edit\"></i></button>
        </th>";
        echo"</tr>";
    }
}
$stmt->close();