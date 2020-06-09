//var
var myShoesSlidesIndex = 0;
var myTShirtSlidesIndex = 0;
var myJeanSlidesIndex = 0;
var mySnapbackSlidesIndex = 0;
//main function 
window.addEventListener('load', function () {
    // !navbar
    //close modal when click outside modal contents
    var modal = document.getElementById('modal');
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none';
            document.getElementsByTagName('body')[0].style.overflow = 'auto';
        }
    }
    // close modal when press esc
    window.addEventListener('keydown', function (event) {
        if (event.key == 'Escape') {
            modal.style.display = 'none';
            document.getElementsByTagName('body')[0].style.overflow = 'auto';
        }
    })
    // change to login page
    document.getElementById('loginPageButton').onclick = function () {
        document.getElementById('loginPage').style.display = 'block';
        document.getElementById('signUpPage').style.display = 'none';
        document.getElementById('loginPageButton').style.color =
            '#0066FF';
        document.getElementById('loginPageButton').style.borderBottom =
            '1px solid #0066FF';
        document.getElementById('signUpPageButton').style.color =
            'black';
        document.getElementById('signUpPageButton').style.borderBottom =
            'none';
    }
    // change to sign up page
    document.getElementById('signUpPageButton').onclick = function () {
        document.getElementById('loginPage').style.display = 'none';
        document.getElementById('signUpPage').style.display = 'block';
        document.getElementById('loginPageButton').style.borderBottom =
            'none';
        document.getElementById('signUpPageButton').style.color =
            '#0066FF';
        document.getElementById('signUpPageButton').style.borderBottom =
            '1px solid #0066ff';
        document.getElementById('loginPageButton').style.color =
            'black';
        document.getElementById('loginPageButton').style.borderBottom =
            'none';
    }
    //!main contents
    // slideshow function
    carousel("shoes-slide",myShoesSlidesIndex);
    carousel("t-shirt-slide",myTShirtSlidesIndex);
    carousel("jean-slide", myJeanSlidesIndex);
    carousel("snapback-slide",mySnapbackSlidesIndex);
})

// !navbar
// open sign up modal
function openSignUpModal() {
    document.getElementById('modal').style.display = 'block';
    document.getElementById('loginPage').style.display = 'none';
    document.getElementById('signUpPage').style.display = 'block';
    document.getElementById('loginPageButton').style.borderBottom =
        'none';
    document.getElementById('signUpPageButton').style.color =
        '#0066FF';
    document.getElementById('signUpPageButton').style.borderBottom =
        '1px solid #0066ff';
    document.getElementById('loginPageButton').style.color =
        'black';
    document.getElementById('loginPageButton').style.borderBottom =
        'none';
    document.getElementsByTagName('body')[0].style.overflow = 'hidden';
}
//open login modal
function openLoginModal() {
    document.getElementById('modal').style.display = 'block';
    document.getElementById('loginPage').style.display = 'block';
    document.getElementById('signUpPage').style.display = 'none';
    document.getElementById('loginPageButton').style.color =
        '#0066FF';
    document.getElementById('loginPageButton').style.borderBottom =
        '1px solid #0066FF';
    document.getElementById('signUpPageButton').style.color =
        'black';
    document.getElementById('signUpPageButton').style.borderBottom =
        'none';
    document.getElementsByTagName('body')[0].style.overflow = 'hidden';
}
// change slide
function carousel(className, mySlidesIndex) {
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
        carousel(className,mySlidesIndex);
    }, 2000);
}