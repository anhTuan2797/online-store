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
<script>
    $(function () {
        $('#mainFooter').load('footer.html');
        
    })
    function sortByAscPrice(){
        var url = "<?php  echo ($_SERVER['REQUEST_URI']); ?>";
        console.log(url);
        var res = url.split("&");
        url = res[0]+"&"+res[1]+"&orderBy=product_price*(1-product_sale*0.01)";
        console.log(url);
        window.location = url;
    }

    function sortByDescPrice(){
        var url = "<?php  echo ($_SERVER['REQUEST_URI']); ?>";
        var res = url.split("&");
        url = res[0]+"&"+res[1]+"&orderBy=product_price*(1-product_sale*0.01) desc";
        window.location = url;
    }

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
    <main class="main-content">
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
                <li>
                    <button type="button" onclick="sortByAscPrice()"><i class="fas fa-angle-down"></i> Ascent Price</button>
                    <button type="button" onclick="sortByDescPrice()"><i class="fas fa-angle-up"></i> Descent Price</button>
                </li>
            </ul>
        </nav>
        <section style="display: flex; justify-content: center ">
        <div id="indexPageContents" class="index-page-contents">
        <?php
        include_once 'database.php';
               $myDatabase = new database();
               $query = "SELECT product_id,product_name, product_price,product_sale,product_imgUrl FROM school_project.product_tbl 
               WHERE product_inStock>0 AND (product_platform="."\"".$_GET['platform']."\""."or category_id="."\"".$_GET['category']."\"".")
               ORDER BY ".$_GET['orderBy'];
               $stmt = $myDatabase->prepare($query);
               if($stmt){
                   $stmt->execute();
                   $stmt->bind_result($idField,$nameField,$priceField,$saleField,$imgField);
                   while($stmt->fetch()){
                        echo"<div class='item-container'>";
                        echo "<a href='product.php?id=".$idField."'><img src='".$imgField."' alt='test'></a>";
                        echo"<div>";
                        echo"<p>".$nameField."</p>";
                        if($saleField==0){
                        echo"<p>".$priceField."đ"."</p>";
                        }
                        else{
                        echo"<p><span style='text-decoration: line-through;'>".$priceField."đ"."</span>"." "."<span style='color: red;'>".$priceField*(1-$saleField*0.01)."đ"."</span>"."</p>";
                        }
                        echo"<div><button type='button' onclick='addToShoppingCart(".$idField.")'><i class='fas fa-shopping-cart'></i></button></div>";
                        echo"<div><button type='button' onclick='buyNow(".$idField.")'>buy now</button></div>";
                        echo"</div>";
                        echo"</div>";
                   }
               }
        ?>
        </section>
    </main>
    <div id="mainFooter"></div>
</body>
</html>