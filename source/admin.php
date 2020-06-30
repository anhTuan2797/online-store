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
                    <a href="#" id="customersBtn" style="color:white;" onclick="changeToCustomersTable()">
                        <i class="fa fa-user fa-4x" aria-hidden="true"></i>
                        <p>customers</p>
                    </a>
                </li>
                <li>
                    <a href="#" id="ordersBtn" onclick="changeToOrdersTable()">
                        <i class="fas fa-truck-moving fa-4x"></i>
                        <p>orders</p>
                    </a>
                </li>
                <li>
                    <a href="#" id="productsBtn" onclick="changeToProductsTable()">
                        <i class="fas fa-box fa-4x"></i>
                        <p>products</p>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="admin-page-header" style="text-transform: uppercase; letter-spacing: 2px;" id="adminPageHeader">
            customers
        </div>
        <div class="table-contents" id="tableContents">
            <table class="admin-page-contents-customer" id="adminPageContentsCustomer">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>sex</th>
                    <th>email</th>
                    <th>tel</th>
                    <th> </th>
                </tr>
                <tr>
                    <form method="get"" id=" customerSearchForm"></form>
                    <th><input type="number" name="user_id" id="userId"></th>
                    <th><input type="text" name="user_name" id="userName"></th>
                    <th><input type="text" name="user_sex" id="userSex"></th>
                    <th><input type="email" name="user_email" id="userEmail"></th>
                    <th><input type="tel" name="user_tel" id="userTel"></th>
                    <th><button onclick="searchCustomer()"><i class="fa fa-search fa-2x"
                                aria-hidden="true"></i></button></th>
                </tr>
            </table>
            <table class="admin-page-contents-order" id="adminPageContentsOrder" style="display: none;">
                <tr>
                    <th>id</th>
                    <th>customer id</th>
                    <th>sum</th>
                    <th>date</th>
                    <th>address</th>
                    <th>status</th>
                    <th></th>
                </tr>
                <tr>
                    <form method="get"" id=" orderSearchForm"></form>
                    <th><input type="number" name="order_id" id="orderId"></th>
                    <th><input type="number" name="customer_id" id="customerId"></th>
                    <th><input type="number" name="order_sum" id="orderSum"></th>
                    <th><input type="date" name="order_date" id="orderDate"></th>
                    <th><input type="text" name="order_status" id="orderStatus"></th>
                    <th><button onclick="searchOrder()"><i class="fa fa-search fa-2x"
                                aria-hidden="true"></i></button></th>
                </tr>
            </table>
            <table class="admin-page-contents-product" id="adminPageContentsProduct" style="display: none;">
                <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>in stock</th>
                    <th>price</th>
                    <th>platform</th>
                    <th>sale</th>
                    <th>category</th>
                    <th></th>
                </tr>
                <tr>
                    <form method="get">
                        <th><input type="number" name="productId" id="productId"></th>
                        <th><input type="text" name="productName" id="productName"></th>
                        <th><input type="number" name="productInStock" id="productInStock"></th>
                        <th><input type="number" name="productPrice" id="productPrice"></th>
                        <th><input type="text" name="productPlatform" id="productPlatform"></th>
                        <th><input type="number" name="productSale" id="productSale"></th>
                        <th><input type="text" name="productCategory" id="productCategory"></th>
                        <th><button onclick="searchProduct()" type="button"><i class="fa fa-search fa-2x" aria-hidden="true"></i></button></th>
                    </form>
                </tr>
            </table>
            <table class="result-table-customer" id="resultTable">
            </table>
        </div>
        <div class="modal" id="updateModal">
        </div>
        <div class="admin-page-footer" id="adminPageFooter">
            <button id="ShowAllCustomerBtn" onclick="loadAllCustomers()"><i class="fa fa-list-alt fa-3x"
                    aria-hidden="true"></i></button>
        </div>
        
    </div>
</body>

</html>