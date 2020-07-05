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
                                echo '<a href="signOut.php?customerId='.$_SESSION['userId'].'">sign out</a>';
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
    <main>
        <div class="new-arrival-poster">
            <img src="../database/img/Sekiro_01.jpg" alt="new arrival" class="new-arrival-poster-img">
            <div class="new-arrival-contents">
                <h1>
                    Turning a burned ah upon.
                </h1>
                <p>Never nepenthe upon denser swung name truly entreating nevernevermore bore maiden. My the eyes of
                    above leave i in forget..</p>
                <a href="product.php?id=26" class="shop-button">shop</a>
            </div>
        </div>
        <div class="new-arrival-poster">
            <img src="../database/img/game-poster.jpg" alt="poster" class="new-arrival-poster-img">
            <div class="new-arrival-contents">
                <h1>
                    Living bird ominous the in.
                </h1>
                <p>Door came whom beating mefilled on then above lenore leave. Bird beak one bore here my i and of
                    spoke,.</p>
                <a href="product.php?id=19" class="shop-button">shop</a>
            </div>
        </div>
        <section class="platform-section">
            <h1>Platform</h1>
            <div class="platform-section-picture">
                <img src="../database/img/pc-section.jpg" alt="pc section">
                <div class="section-picture-contents">
                    <a href='index.php?platform=pc&category=&orderBy=product_name asc' class="section-shop-button">pc</a>
                </div>
            </div>
            <div class="platform-section-picture">
                <img src="../database/img/ps4-section.jpg" alt="ps4 section">
                <div class="section-picture-contents">
                    <a href="index.php?platform=ps4&category=&orderBy=product_name asc" class="section-shop-button">ps4</a>
                </div>
            </div>
        </section>
        <section class="category-section">
            <h1>category</h1>
            <div class="rpg-category">
                <div class="rpg-slide">
                    <img src="../database/img/rpg1.jpg" alt="rpg slide">
                    <div class="slide-button">
                        <a href="index.php?category=rpg&platform=&orderBy=product_name asc">rpg</a>
                    </div>
                </div>

                <div class="rpg-slide">
                    <img src="../database/img/rpg2.jpg" alt="rpg slide">
                    <div class="slide-button">
                        <a href="index.php?category=rpg&platform=&orderBy=product_name asc">rpg</a>
                    </div>
                </div>
                <div class="rpg-slide">
                    <img src="../database/img/rpg3.jpg" alt="rpg slide">
                    <div class="slide-button">
                        <a href="index.php?category=rpg&platform=&orderBy=product_name asc">rpg</a>
                    </div>
                </div>
                <div class="rpg-slide">
                    <img src="../database/img/rpg4.jpg" alt="rpg slide">
                    <div class="slide-button">
                        <a href="index.php?category=rpg&platform=&orderBy=product_name asc">rpg</a>
                    </div>
                </div>
                </div>
            </div>
            <div class="adventure-category">
                <div class="adventure-slide">
                    <img src="../database/img/shooter1.jpg" alt="t shirt slide">
                    <div class="slide-button">
                        <a href="index.php?category=action&platform=&orderBy=product_name asc">action</a>
                    </div>
                </div>

                <div class="adventure-slide">
                    <img src="../database/img/shooter2.jpg" alt="t shirt slide">
                    <div class="slide-button">
                        <a href="index.php?category=action&platform=&orderBy=product_name asc">action</a>
                    </div>
                </div>

                <div class="adventure-slide">
                    <img src="../database/img/shooter3.jpg" alt="t shirt slide">
                    <div class="slide-button">
                        <a href="index.php?category=action&platform=&orderBy=product_name asc">action</a>
                    </div>
                </div>

                <div class="adventure-slide">
                    <img src="../database/img/shooter4.jpg" alt="t shirt slide">
                    <div class="slide-button">
                        <a href="index.php?category=adventure&platform=&orderBy=product_name asc">action</a>
                    </div>
                </div>
            </div>
            <div class="action-category">
                <div class="action-slide">
                    <img src="../database/img/action1.jpg" alt="action slide">
                    <div class="slide-button">
                        <a href="index.php?category=adventure&platform=&orderBy=product_name asc">adventure</a>
                    </div>
                </div>

                <div class="action-slide">
                    <img src="../database/img/action2.jpg" alt="action slide">
                    <div class="slide-button">
                        <a href="index.php?category=adventure&platform=&orderBy=product_name asc">adventure</a>
                    </div>
                </div>

                <div class="action-slide">
                    <img src="../database/img/action3.jpg" alt="action slide">
                    <div class="slide-button">
                        <a href="index.php?category=adventure&platform=&orderBy=product_name asc">adventure</a>
                    </div>
                </div>

                <div class="action-slide">
                    <img src="../database/img/action4.jpg" alt="action slide">
                    <div class="slide-button">
                        <a href="index.php?category=adventure&platform=&orderBy=product_name asc">adventure</a>
                    </div>
                </div>
            </div>
            <div class="casual-category">
                <div class="casual-slide">
                    <img src="../database/img/casual3.jpg" alt="casual slide">
                    <div class="slide-button">
                        <a href="index.php?category=casual&platform=&orderBy=product_name asc"">casual</a>
                    </div>
                </div>

                <div class="casual-slide">
                    <img src="../database/img/casual1.jpg" alt="casual slide">
                    <div class="slide-button">
                        <a href="index.php?category=casual&platform=&orderBy=product_name asc">casual</a>
                    </div>
                </div>

                <div class="casual-slide">
                    <img src="../database/img/casual2.jpg" alt="casual slide">
                    <div class="slide-button">
                        <a href="index.php?category=casual&platform=&orderBy=product_name asc">casual</a>
                    </div>
                </div>
                
            </div>
        </section>
    </main>
    <footer class=" footer">
        <div class="copy-rights">
            <h1>copy right</h1>
            <p>Spoken silence forgotten dirges see lonely, a scarce i sat.</p>
        </div>
        <div class="contacts">
            <h1>contact</h1>
            <p>Spoken silence forgotten dirges see lonely, a scarce i sat.</p>
            <p>The faintly this the floor mystery. Raven the nothing seeming.</p>
            <p>The faintly this the floor mystery. Raven the nothing seeming.</p>
        </div>
        <div class="about">
            <h1>about</h1>
            <p>Have the whether sitting door one, word lenore mien press and bust. I nothing parting with if. Weak
                velvet bird farther devil soul form sainted, shorn silence i into lordly door stock fowl aidenn and,
                cushions much sent angels ah streaming. That he chamber above and tapping perched tufted. Feather.
            </p>
        </div>
        <div class="social-media">
            <h1>social media</h1>
            <ul>
                <li><a href="https://www.facebook.com/"><i><i class="fab fa-facebook-square fa-3x"></i></i></a></li>
                <li><a href="https://www.instagram.com/?hl=vi"><i><i class="fab fa-instagram-square fa-3x"></i></i></a>
                </li>
                <li><a href="https://twitter.com/explore"><i><i class="fab fa-twitter-square fa-3x"></i></i></a></li>
            </ul>
        </div>
    </footer>
</body>
</html>