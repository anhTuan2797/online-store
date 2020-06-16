//!global variables:
// slide variables:
var myShoesSlidesIndex = 0;
var myTShirtSlidesIndex = 0;
var myJeanSlidesIndex = 0;
var mySnapbackSlidesIndex = 0;

// !main function
$(function () {
    // !nav bar functions
    // close modal when click outside modal contents
    $("#modal").click(function (e) {
        if (e.target.className == 'modal') {
            closeModal();
        }
    });
    // close modal when esc is press
    window.addEventListener('keydown', function (event) {
        if (event.key == 'Escape') {
            closeModal();
        }
    })
    //change to sign up page when sign up button is press
   $("#signUpPageButton").click(changeToSignUpPage);
   $("#loginPageButton").click(changeToLoginPage);

   //!main contents functions
   slideShow("shoes-slide",myShoesSlidesIndex);
   slideShow("t-shirt-slide",myTShirtSlidesIndex);
   slideShow("jean-slide", myJeanSlidesIndex);
   slideShow("snapback-slide",mySnapbackSlidesIndex);
});

// open login modal function
function openLoginModal() {
    $("#modal").show();
    changeToLoginPage();
    $("body").css("overflow", "hidden");
}
// open sign up modal function
function openSignUpModal(){
    $("#modal").show();
    changeToSignUpPage();
    $("body").css("overflow", "hidden");
}
// close modal function
function closeModal() {
    $("#modal").hide();
    $("body").css("overflow","auto");
}

// change modal to sign up page function
function changeToSignUpPage(){
    $("#signUpPage").show();
    $("#loginPage").hide();
    $("#signUpPageButton").css({
        "color": "#0066FF",
        "border-bottom": "1px solid #0066FF",
    });
    $("#loginPageButton").css({
        "color": "black",
        "border-bottom": "none",
    });
}
// change to login page function 
function changeToLoginPage(){
    $("#loginPage").show();
    $("#signUpPage").hide();
    $("#loginPageButton").css({
        "color": "#0066FF",
        "border-bottom": "1px solid #0066FF",
    });
    $("#signUpPageButton").css({
        "color": "black",
        "border-bottom": "none",
    });
}

// change slide function
function slideShow(className,mySlidesIndex){
    var y = className;
    var i;
    var x = document.getElementsByClassName(y);
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    mySlidesIndex++;
    if (mySlidesIndex > x.length) {
        mySlidesIndex = 1;
    }
    x[mySlidesIndex - 1].style.display = "grid";
    setTimeout(function () {
        slideShow(className,mySlidesIndex);
    }, 2000);
}
