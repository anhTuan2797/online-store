<?php
    include_once 'database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
    <script src="app.js"></script>
    <link rel="shortcut icon" href="#">
</head>

<body>
    <div class="admin-page">
        <nav class="admin-sidebar">
            <ul>
                <li>
                    <a href="#" id="customersBtn" style="color:white;"> 
                        <i class="fa fa-user fa-4x" aria-hidden="true"></i>
                        <p>customers</p>
                    </a>
                </li>
                <li>
                    <a href="#" id="ordersBtn">
                        <i class="fas fa-truck-moving fa-4x"></i>
                        <p>orders</p>
                    </a>
                </li>
                <li>
                    <a href="#" id="productsBtn">
                        <i class="fas fa-box fa-4x"></i>
                        <p>products</p>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="admin-page-header" style="text-transform: uppercase; letter-spacing: 2px;">
            customers
        </div>

        <table class="admin-page-contents-customers" id="customerSearchResult">
            <tr>
                <th>id</th>
                <th>name</th>
                <th>sex</th>
                <th>email</th>
                <th>tel</th>
                <th></th>
            </tr>
            <tr>
                <form method="get"></form>
                <th><input type="number" name="user_id" id="userId"></th>
                <th><input type="text" name="user_name" id="userName"></th>
                <th><input type="text" name="user_sex" id="userSex"></th>
                <th><input type="email" name="user_email" id="userEmail"></th>
                <th><input type="tel" name="user_tel" id="userTel"></th>
                <th></th>
            </tr>
        </table>

        <div class="admin-page-footer">
            <button id="adminShowAllCustomerBtn" onclick="showAllCustomers()"><i class="fa fa-list-alt fa-3x"
                    aria-hidden="true"></i></button>
        </div>
    </div>
</body>
</html>