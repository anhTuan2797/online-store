<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery.js"></script>
    <link rel="stylesheet" href="style.css">
    <script src="app.js"></script>
    <link rel="stylesheet" href="fontawesome-free-5.13.0-web/css/all.css">
    <script>
    $(function () {
        $('#mainFooter').load('footer.html');
    })
</script>
</head>
<body>
<nav class="main-nav">
        <ul class="nav-links">
            <li>
                <div class="logo">
                    <a href="landingPage.php"><img src="../database/img/logoText50x51.png" alt="logo"></a>
                </div>
            </li>
            <li>
                <form action="#" method="get" class="search-bar" style="display: flex;">
                    <input type="text" name="searchBarInput" id="searchBarInput" placeholder="Search...">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </li>
            <li>
                <div class="dropdown">
                    <a href="#"><i class="fas fa-user"></i></a>
                    <div class="dropdown-contents">
                        <?php
                            if(!isset($_SESSION['userId'])){
                                echo '<div class="login-sign-up-group">';
                                echo '<button id="openLoginButton" class="modal-button" onclick="openLoginModal()">login</button>';
                                echo '<button id="openSignUpButton" class="modal-button" onclick="openSignUpModal()">
                                Sign up</button>';
                            }
                            else {
                                echo '<div class="user-group">';
                                echo '<a href="profile.php">profile</a>';
                                echo '<a href="signOut.php">sign out</a>';
                            }
                        ?>
                    </div>
                </div>
            </li>
            <li>
                <a href="#"><i class="fas fa-shopping-cart"></i></a>
            </li>
        </ul>
        <div class="modal" id="modal">
                        <div class="modal-contents">
                            <nav class="modal-navbar">
                                <ul class="modal-nav-links">
                                    <li>
                                        <a href="#" id="loginPageButton">login</a>
                                    </li>
    
                                    <li>
                                        <a href="#" id="signUpPageButton">sign up</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="login-page" id="loginPage">
                                <form action="#" method="get" id="loginForm" class="login-form">
                                    <div class="grid-item"></div>
                                    <div class="grid-item">
                                        <input type="email" name="loginAccountInput" id="loginAccountInput"
                                            placeholder="Account">
                                    </div>
                                    <div class="grid-item"></div>
                                    <div class="grid-item">
                                        <input type="password" name="loginPasswordInput" id="loginPasswordInput"
                                            placeholder="password">
                                    </div>
                                    <div class="grid-item"></div>
                                    <div class="login-sign-up-error-message" id="loginErrorMessage">
                                    </div>
                                    <div class="grid-item"></div>
                                    <div class="grid-item">
                                        <button type="button" onclick="login()">login</button>
                                    </div>
                                </form>
                            </div>
                            <div class="sign-up-page" id="signUpPage">
                                <form action="#" method="post" id="signUpForm" class="sign-up-form">
                                    <div class="grid-item"></div>
                                    <div class="grid-item">
                                        <input type="text" name="signUpNameInput" id="signUpNameInput"
                                            placeholder="name">
                                    </div>
    
                                    <div class="grid-item"></div>
                                    <div>
                                        <input type="radio" name="gender" id="signUpGenderInput" value="male">
                                        <label for="male">male</label>
                                        <input type="radio" name="gender" id="signUpGenderInput" value="female">
                                        <label for="male">female</label>
                                        <input type="radio" name="gender" id="signUpGenderInput" value="other">
                                        <label for="male">other</label>
                                    </div>

                                    <div class="grid-item"></div>
                                    <div class="grid-item">
                                        <input type="email" name="signUpEmailInput" id="signUpEmailInput"
                                            placeholder="email">
                                    </div>
    
                                    <div class="grid-item"></div>
                                    <div class="grid-item">
                                        <input type="tel" name="signUpTelInput" id="signUpTelInput" placeholder="tel">
                                    </div>
    
                                    <div class="grid-item"></div>
                                    <div class="grid-item">
                                        <input type="password" name="signUpPasswordInput" id="signUpPasswordInput"
                                            placeholder="password">
                                    </div>
    
                                    <div class="grid-item"></div>
                                    <div class="grid-item">
                                        <input type="password" name="signUpRePasswordInput" id="signUpRePasswordInput"
                                            placeholder="confirm password">
                                    </div>
    
                                    <div class="grid-item"></div>
                                    <div class="login-sign-up-error-message" id="signUpErrorMessage">
                                    </div>

                                    <div class="grid-item"></div>
                                    <div class="grid-item">
                                        <button type="button" onclick="signUp()">sign up</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
</nav>
<main class="profile-main-contents">
    <h1>account detail</h1>
    <form method="post" class="profile-update-form">
        <?php
            include_once 'database.php';
            $myDatabase = new database();
            $query = "SELECT customer_email,customer_name,customer_sex,customer_tel FROM school_project.customer_tbl
             WHERE customer_id=".$_SESSION['userId'];
            $stmt = $myDatabase->prepare($query);
            if($stmt){
                $stmt->execute();
                $stmt->bind_result($emailField,$nameField,$sexField,$telField);
                $stmt->fetch();
                echo "<label >email</label>";
                echo "<p>".$emailField."</p>";
                echo "<label for=\"customer name\">name</label>";
                echo "<input type=\"text\"  id=\"profileCustomerNameInput\" value=\"".$nameField."\">";
                echo "<label >gender</label>";
                echo "<div>";
                if(!strcmp($sexField,"male")){
                    echo "<input type=\"radio\" name=\"customerGender\" id=\"profileCustomerRadioMale\" value=\"male\" checked=\"checked\">
                    <label for=\"customerGenderMale\">male</label>";
                    echo "<input type=\"radio\" name=\"customerGender\" id=\"profileCustomerRadioFemale\" value=\"female\">
                    <label for=\"customerGenderFemale\">female</label>";
                    echo "<input type=\"radio\" name=\"customerGender\" id=\"profileCustomerRadioOther\" value=\"other\">
                    <label for=\"customerGenderOther\">other</label>";
                }
                elseif(!!strcmp($sexField,"female")){
                    echo "<input type=\"radio\" name=\"customerGender\" id=\"profileCustomerRadioMale\" value=\"male\">
                    <label for=\"customerGenderMale\">male</label>";
                    echo "<input type=\"radio\" name=\"customerGender\" id=\"profileCustomerRadioFemale\" value=\"female\" checked=\"checked\">
                    <label for=\"customerGenderFemale\">female</label>";
                    echo "<input type=\"radio\" name=\"customerGender\" id=\"profileCustomerRadioOther\" value=\"other\">
                    <label for=\"customerGenderOther\">other</label>";
                }
                else{
                    echo "<input type=\"radio\" name=\"customerGender\" id=\"profileCustomerRadioMale\" value=\"male\">
                    <label for=\"customerGenderMale\">male</label>";
                    echo "<input type=\"radio\" name=\"customerGender\" id=\"profileCustomerRadioFemale\" value=\"female\">
                    <label for=\"customerGenderFemale\">female</label>";
                    echo "<input type=\"radio\" name=\"customerGender\" id=\"profileCustomerRadioOther\" value=\"other\" checked=\"checked\">
                    <label for=\"customerGenderOther\">other</label>";
                }
                echo "</div>";
                echo "<label for=\"customer tel\">tel</label>";
                echo "<input type=\"tel\"  id=\"profileCustomerTelInput\" value=\"".$telField."\">";
                echo "<p id='customerUpdateErrorMessage' style='color: red'></p>";
                echo "<button type=\"button\" onclick=\"updateCustomer()\">submit</button>";
            }
        ?>
        <script>
            function updateCustomer(){
                $('#customerUpdateErrorMessage').empty();
                var customerId = <?php echo($_SESSION['userId']);?>;
                var customerName = $('#profileCustomerNameInput').val();
                var customerSex = $('input[name="customerGender"]:checked').val();
                var customerTel = $('#profileCustomerTelInput').val();
                if(!customerName){
                    $('#customerUpdateErrorMessage').append("empty field");
                }
                else if(!customerTel){
                    $('#customerUpdateErrorMessage').append("empty field");
                }
                else if(customerTel.length<10){
                    $('#customerUpdateErrorMessage').append("invalid telephone number");
                }
                else {
                    $.ajax({
                        type: "post",
                        url: "updateCustomer.php",
                        data: {
                            customerId: customerId,
                            customerName: customerName,
                            customerSex: customerSex,
                            customerTel: customerTel
                        },
                        success: function (result) {
                    $('#customerUpdateErrorMessage').append(result);
                        }
                    });
                }
            }
        </script>
    </form>
    <h1>change password</h1>
    <form method="post" class="profile-update-form">
        <label for="customerUpdateForm">password</label>
        <input type="password" id="profileCustomerPasswordInput">
        <label for="customerUpdateForm">confirm password</label>
        <input type="password" id="profileCustomerRePasswordInput">    
        <p id="passwordUpdateErrorMessage" style="color: red"></p>
        <button type="button" onclick="changePassword()">submit</button>
    </form>
    <script>
        function changePassword(){
            $('#passwordUpdateErrorMessage').empty();
            var customerId = <?php echo($_SESSION['userId']);?>;
            var password = $('#profileCustomerPasswordInput').val();
            var rePassword = $('#profileCustomerRePasswordInput').val();
            if(password!=rePassword){
                $('#passwordUpdateErrorMessage').append("passwords don't match");
            }
            else{
                $.ajax({
                    type: "post",
                    url: "updatePassword.php",
                    data: {
                        customerId: customerId,
                        newPassword: password
                    },
                    success: function (result) {
                        $('#passwordUpdateErrorMessage').append(result);
                    }
                });
            }
        }
    </script>
    <h1>order detail</h1>
    <div class="profile-all-orders">
        <table class="all-orders-table">
            <tr>
                <th>id</th>
                <th>date</th>
                <th>detail</th>
                <th>sum</th>
                <th>address</th>
                <th>status</>
            </tr>
            <?php
                $myDatabase = new database();
                $query = "SELECT order_id,order_sum,order_date,order_status,order_address FROM school_project.order_tbl WHERE customer_id=" .$_SESSION['userId'];
                $stmt = $myDatabase->prepare($query);
                if($stmt){
                    $stmt->execute();
                    $stmt->bind_result($idField,$sumField,$dateField,$statusField,$addressField);
                    while($stmt->fetch()){
                        echo "<th>".$idField."</th>";
                        echo "<th>".$dateField."</th>";
                        $orderDetail = loadOrderDetail($idField);
                        $count = 0;
                        echo "<th>";
                        while(count($orderDetail)>$count){
                            echo ($orderDetail[$count]." x".$orderDetail[$count+1]);
                            echo "<br>";
                            $count += 2;
                        }
                        echo "</th>";
                        echo "<th>".$sumField."</th>";
                        echo "<th>".$addressField."</th>";
                        echo "<th>".$statusField."</th>";
                    }
                }
            ?>
        </table>
    </div>
</main>
<div id="mainFooter"></div>
</body>
</html>