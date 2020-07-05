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
</head>
</head>

<script>
    $(function () {
        $('#mainFooter').load('footer.html');
    })
    function addToShoppingCart(productId){
        var customerId = "<?php if(isset($_SESSION['userId'])){
            echo($_SESSION['userId']);
        }
        else{
            echo"";
        } ?>";
        if(customerId){
            $.ajax({
                type: "post",
                url: "addProductToShoppingCart.php",
                data: {
                    customerId: customerId,
                    productId: productId,
                    productAmount: 1
                },
                success: function (response) {
                    
                }
            });
        }
        else{
            openLoginModal();
        }
    }
    function addManyProductToCart(productId){
        var customerId = "<?php if(isset($_SESSION['userId'])){
            echo($_SESSION['userId']);
        }
        else{
            echo"";
        } ?>";
        if(customerId){
            var amount = $('#productPageProductAmount').val();
            $.ajax({
                type: "post",
                url: "addProductToShoppingCart.php",
                data: {
                    customerId: customerId,
                    productId: productId,
                    productAmount: amount
                },
                success: function (response) {
                    
                }
            });
        }
        else{
            openLoginModal();
        }
    }
    function buyNow(productId){
        var customerId = "<?php if(isset($_SESSION['userId'])){
            echo($_SESSION['userId']);
        }
        else{
            echo"";
        } ?>";
        if(customerId){
            $.ajax({
                type: "post",
                url: "addProductToShoppingCart.php",
                data: {
                    customerId: customerId,
                    productId: productId,
                    productAmount: 1
                },
                success: function (response) {
                    window.location = 'cart.php';
                }
            });
        }
        else{
            openLoginModal();
        }
    }
</script>

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
            <?php
                if(!isset($_SESSION['userId'])){
                echo '<a href="#"><i class="fas fa-shopping-cart"></i></a>';
                }
                else {
                    echo '<a href="cart.php"><i class="fas fa-shopping-cart"></i></a>';
                }
                ?>
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
<nav class="sub-nav-bar">
            <ul>
                <li>
                    <div class="dropdown">
                        <a href="#"><i class="fas fa-bars"></i> Category</a>
                        <div class="dropdown-contents">
                            <a href="index.php?category=adventure&platform=&orderBy=product_name asc">adventure</a>
                            <a href="index.php?category=rpg&platform=&orderBy=product_name asc">rpg</a>
                            <a href="index.php?category=action&platform=&orderBy=product_name asc">action</a>
                            <a href="index.php?category=casual&platform=&orderBy=product_name asc">casual</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown">
                        <a href="#"><i class="fas fa-bars"></i> platform</a>
                        <div class="dropdown-contents">
                            <a href="index.php?platform=pc&category=&orderBy=product_name asc">pc</a>
                            <a href="index.php?platform=ps4&category=&orderBy=product_name asc">ps4</a>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
<main class="product-page-content">
    <?php
        include_once 'database.php';
        $myDatabase = new database();
        $query = "SELECT product_id,product_name,product_inStock,product_price,product_detail,product_imgUrl,product_sale,product_platform,category_id FROM school_project.product_tbl where product_id =".$_GET['id'];
        $stmt = $myDatabase->prepare($query);
        if($stmt){
            $stmt->execute();
            $stmt->bind_result($idField,$nameField,$inStockField,$priceField,$detailField,$imgField,$saleField,$platformField,$categoryField);
            $stmt->fetch();
                echo "<h1>".$nameField."</h1>";
                echo "<div class=\"product-page-img\">";
                echo "<img src=\"".$imgField."\">";
                echo "</div>";
                echo "<div class=\"product-page-information\">";
                echo "<p><i class=\"fas fa-tags\"></i>product id: <span style=\"color: black;\">".$idField."</span></p>";
                if($inStockField>0){
                echo "<p><i class=\"fas fa-question-circle\"></i>status: <span style=\"color: red;\">available</span></p>";
                }
                else{
                    echo "<p><i class=\"fas fa-question-circle\"></i>status: <span style=\"color: #996666;\">out of stock</span></p>";
                }
                echo "<p><i class=\"fas fa-gamepad\"></i>platform: <span style=\"color: red;\">".$platformField."</span></p>";
                echo "</div>";
                echo "<div class=\"product-page-price\">";
                if($saleField==0){
                echo "<p>price: <br>".($priceField/1000).".000đ</p>";
                }
                else {
                    echo "<p>price: <span style=\"text-decoration: line-through; color: #996666\">".$priceField."</span></p>";
                    echo "<p><span style=\"font-size: 20px;\">".$priceField*(1-$saleField*0.01)."đ </span><span style=\"border-radius: 12px; background-color: red; color: white\">-".$saleField."%</span></p>";
                }
                echo "</div>";
                echo "<div class=\"product-page-buttons\">";
                if($inStockField>0){
                    echo"<input type=\"number\" id=\"productPageProductAmount\" min=\"1\" max="."\"".$inStockField."\""." value=\"1\">";
                    echo"<button style =\"button\" onclick=\"buyNow(".$idField.")\">buy now</button>";
                    echo "<button style =\"button\" onclick=\"addManyProductToCart(".$idField.")\">add to cart</button>";
                }
                echo "</div>";
                echo "</main>";
                echo "<div class=\"product-page-detail\">";
                echo "<h1>Product Detail</h1>";
                echo "<p>".$detailField."</p>";
                echo "</div>";
                echo "<div class=\"product-page-like\">";
                $stmt->close();
                echo "<h1>Same Category</h1>";
                echo "<div class=\"product-page-like-contents\">";
                $query = "SELECT product_id,product_name, product_price,product_sale,product_imgUrl FROM school_project.product_tbl 
                WHERE product_inStock>0 AND category_id="."\"".$categoryField."\" AND product_id !=".$idField." limit 3";
                $stmt = $myDatabase->prepare($query);
                if($stmt){
                    $stmt->execute();
                    $stmt->bind_result($idField,$nameField,$priceField,$saleField,$imgField);
                    while($stmt->fetch()){
                        echo"<div class=\"small-item-container\">";
                        echo"<a href=\"product.php?id=".$idField."\"><img src=\"".$imgField."\"></a>";
                        echo "<div>";
                        echo "<p>".$nameField."</p>";
                        echo "<p>".$priceField."</p>";
                        echo "</div>";
                        echo "<div>";
                        echo "<button type = \"button\" onclick =\"addToShoppingCart(".$idField.")\"><i class='fas fa-shopping-cart'></i></button>";
                        echo "<button type = \"button\" onclick =\"buyNow(".$idField.")\">buy now</button>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
                echo "</div>";
                echo "</div>";
        }
    ?>
<div id="mainFooter"></div>
</body>
</html>