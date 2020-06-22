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
    $(window).click(function (e) {
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
    slideShow("shoes-slide", myShoesSlidesIndex);
    slideShow("t-shirt-slide", myTShirtSlidesIndex);
    slideShow("jean-slide", myJeanSlidesIndex);
    slideShow("snapback-slide", mySnapbackSlidesIndex);

    //!admin page function
    $('#ordersBtn').click(function(){
        alert("click");
    })
});

// open modal function 
function openModal(modalID) {
    $("#" + modalID).show();
    $("body").css("overflow", "hidden");
}

// open login modal function
function openLoginModal() {
    $("#modal").show();
    changeToLoginPage();
    $("body").css("overflow", "hidden");
}
// open sign up modal function
function openSignUpModal() {
    $("#modal").show();
    changeToSignUpPage();
    $("body").css("overflow", "hidden");
}
// close modal function
function closeModal() {
    $(".modal").hide();
    $("body").css("overflow", "auto");
}

// change modal to sign up page function
function changeToSignUpPage() {
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
function changeToLoginPage() {
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
function slideShow(className, mySlidesIndex) {
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
        slideShow(className, mySlidesIndex);
    }, 2000);
}
// toggle sidebar button
function toggleSidebarButton() {
    $(".admin-navbar").css("width", "0");
    $(".admin-wrapper").css("grid-template-columns", "0%,100%");
}

// show all customer function
function showAllCustomers() {
    $("#customerSearchResult").load("loadAllCustomer.php");
}
// show delete customer notification:
function showDeleteCustomerNotification(customerId) {
    var text = '<div class="modal" style="display: block;">' +
        '<div class="notification">' +
        '<p>Are you sure you want to delete this customer?</p>' +
        ' <button id = "deleteConfirm" onclick="deleteCustomer('+customerId+')">yes</button>' +
        '</div>' +
        '</div>';
    $('.admin-page').append(text);
}
// show edit customer form:
function showEditCustomerForm(customerName,customerSex,customerEmail,customerTel){
    var text = '';
}
// delete customer
function deleteCustomer(customerId){
    // alert(customerId);
    $.ajax({
        type: "post",
        url: "deleteCustomer.php",
        data: {customerId : customerId},
        success: function (response) {
            console.log("success");
            closeModal();
            $("#customerSearchResult").load("loadAllCustomer.php");
        }
    });
}

