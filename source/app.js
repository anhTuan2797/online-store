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
            removeUpdateModalContents();
        }
    });
    // close modal when esc is press
    window.addEventListener('keydown', function (event) {
        if (event.key == 'Escape') {
            closeModal();
            removeUpdateModalContents();
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
    $(".admin-modal-form").remove();
}

// remove update modal contents
function removeUpdateModalContents() {
    $("#updateModal").empty();
    $("#updateModal").hide();
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
// !admin page functions
// toggle sidebar button
function toggleSidebarButton() {
    $(".admin-navbar").css("width", "0");
    $(".admin-wrapper").css("grid-template-columns", "0%,100%");
}

// load all customer function
function loadAllCustomers() {
    $('#resultTable').removeClass('result-table-product');
    // todo: remove class result table orders
    $('#resultTable').addClass('result-table-customer');
    $("#resultTable").load("loadAllCustomer.php");
}
// load all product function
function loadAllProduct() {
    // alert("product click");
    $('#resultTable').removeClass('result-table-customer');
    // todo: remove class result table orders
    $('#resultTable').addClass('result-table-product');
    $('#resultTable').load("loadAllProduct.php");
}
// show delete customer notification:
function showDeleteCustomerNotification(customerId) {
    var text = '<div class="modal" style="display: block;">' +
        '<div class="notification">' +
        '<p>Are you sure you want to delete this customer?</p>' +
        ' <button id = "deleteConfirm" onclick="deleteCustomer(' + customerId + ')">yes</button>' +
        '</div>' +
        '</div>';
    $('.admin-page').append(text);
}
// show edit product notification:
function showEditProductNotification(
    productId, productName, productInStock, productPrice, productPlatform, productSale, productCategory, productDetail, productImgUrl) {
    var text =
        '<form method="post" class="admin-modal-form">' +
        '<h1 id="formProductId">Product id: ' + productId + '</h1>' +
        '<label for=" productName">Name</label>' +
        '<input type="text" name="productName" id="formProductName' + productId + '" value="' + productName + '">' +
        '<label for="productInStock">In stock</label>' +
        '<input type="number" name="productInStock" id="formProductInStock' + productId + '" value="' + productInStock + '">' +
        '<label for="productPrice">Price</label>' +
        '<input type="number" name="productPrice" id="formProductPrice' + productId + '" value="' + productPrice + '">' +
        '<label for="productPlatform">Platform</label>' +
        '<input type="text" name="productPlatform" id="formProductPlatform' + productId + '" value="' + productPlatform + '">' +
        '<label for="productDetail">Detail</label>' +
        '<textarea name="productDetail" id="formProductDetail' + productId + '" cols="30" rows="10">' + productDetail + '</textarea>' +
        '<label for="productImgUrl">Img Url</label>' +
        '<input type="text" name="productImgUrl" id="formProductImgUrl' + productId + '" value="' + productImgUrl + '">' +
        '<label for="productCategory">Category</label>' +
        '<input type="text" name="productCategory" id="formProductCategory' + productId + '" value="' + productCategory + '">' +
        '<label for="productSale">Sale</label>' +
        '<input type="number" name="productSale" id="formProductSale' + productId + '" value="' + productSale + '">' +
        '<button type="button" onclick="updateProduct(' + productId + ')">submit</button>' +
        '</form>';
    $("#updateModal").append(text);
    $("#updateModal").show();
}
// update product
function updateProduct(productId) {
    var productName = $('#formProductName' + productId).val();
    var productInStock = $('#formProductInStock' + productId).val();
    var productPrice = $('#formProductPrice' + productId).val();
    var productPlatform = $('#formProductPlatform' + productId).val();
    var productSale = $('#formProductSale' + productId).val();
    var productCategory = $('#formProductCategory' + productId).val();
    var productDetail = $('#formProductDetail' + productId).val();
    var productImgUrl = $('#formProductImgUrl' + productId).val();
    $.ajax({
        type: "post",
        url: "updateProduct.php",
        data: {
            productId: productId,
            productName: productName,
            productInStock: productInStock,
            productPrice: productPrice,
            productPlatform: productPlatform,
            productSale: productSale,
            productCategory: productCategory,
            productDetail: productDetail,
            productImgUrl: productImgUrl
        },
        success: function (response) {
            removeUpdateModalContents();
            loadAllProduct();
        }
    });
}
// delete customer
function deleteCustomer(customerId) {
    $.ajax({
        type: "post",
        url: "deleteCustomer.php",
        data: {
            customerId: customerId
        },
        success: function (response) {
            console.log("success");
            closeModal();
            $("#resultTable").load("loadAllCustomer.php");
        }
    });
}

// search customer
function searchCustomer() {
    var customerId = $('#userId').val();
    var customerTel = $('#userTel').val();
    var customerEmail = $('#userEmail').val();
    var customerName = $('#userName').val();
    var customerSex = $('#userSex').val();
    if (customerId) {
        $.ajax({
            type: "get",
            url: "searchCustomerById.php",
            data: {
                customerId: customerId
            },
            success: function (result) {
                $('#resultTable').empty();
                $('#resultTable').append(result);
            }
        });
    } else if (customerTel) {
        $.ajax({
            type: "get",
            url: "searchCustomerByTel.php",
            data: {
                customerTel: customerTel
            },
            success: function (result) {
                $('#resultTable').empty();
                $('#resultTable').append(result);
            }
        });
    } else if (customerEmail) {
        // alert(customerEmail);
        customerEmail = "'" + customerEmail + "'";
        $.ajax({
            type: "get",
            url: "searchCustomerByEmail.php",
            data: {
                customerEmail: customerEmail
            },
            success: function (result) {
                $('#resultTable').empty();
                $('#resultTable').append(result);
            }
        });
    } else if ((customerName) || (customerSex)) {
        customerName = "'" + customerName + "'";
        customerSex = "'" + customerSex + "'";
        $.ajax({
            type: "get",
            url: "searchCustomerByNameAndSex.php",
            data: {
                customerName: customerName,
                customerSex: customerSex
            },
            success: function (result) {
                $('#resultTable').empty();
                $('#resultTable').append(result);
            }
        });
    } else {
        $('#resultTable').empty();
    }
}
//change to customer table
function changeToCustomersTable() {
    $('#adminPageContentsCustomer').show();
    $('#adminPageContentsProduct').hide();
    $('#resultTable').empty();
    $('#adminPageFooter').empty();
    var text = '<button id="ShowAllCustomerBtn" onclick="loadAllCustomers()"><i class="fa fa-list-alt fa-3x"' +
        'aria-hidden="true"></i></button>';
    $('#adminPageFooter').append(text);
    $('#adminPageHeader').html("customers");
    $('#customersBtn').css({
        'color': 'white'
    });
    // todo: add order button
    $('#productsBtn').css({
        'color': '#666'
    });

}
//change to orders table
function changeToOrdersTable() {
    alert("click");

}
//change to products table
function changeToProductsTable() {
    $('#adminPageContentsCustomer').hide();
    $('#adminPageContentsProduct').show();
    $('#resultTable').empty();
    $('#adminPageFooter').empty();
    var text = '<button id="loadAllProductBtn" onclick="loadAllProduct()"><i class="fa fa-list-alt fa-3x"' +
        'aria-hidden="true"></i></button>' +
        '<button id="addProductBtn" onclick="test()"><i class="fa fa-plus fa-3x" aria-hidden="true"></i></button>';
    $('#adminPageFooter').append(text);
    $('#adminPageHeader').html("products");
    $('#customersBtn').css({
        'color': '#666'
    });
    // todo: add order button
    $('#productsBtn').css({
        'color': 'white'
    });
}

function test() {
    alert("click");
}