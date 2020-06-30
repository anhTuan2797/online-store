//!global variables:
// slide variables:
var myRpgSlidesIndex = 0;
var myTShirtSlidesIndex = 0;
var myActionSlidesIndex = 0;
var myCasualSlidesIndex = 0;

// !main function
$(function () {
    // !nav bar functions
    // close modal when click outside modal contents
    $(window).click(function (e) {
        if (e.target.className == 'modal') {
            closeModal();
            removeUpdateModalContents();
            $('#notificationModal').remove();
        }
    });
    // close modal when esc is press
    window.addEventListener('keydown', function (event) {
        if (event.key == 'Escape') {
            closeModal();
            removeUpdateModalContents();
            $('#notificationModal').remove();
        }
    })
    //change to sign up page when sign up button is press
    $("#signUpPageButton").click(changeToSignUpPage);
    $("#loginPageButton").click(changeToLoginPage);

    //!main contents functions
    slideShow("rpg-slide", myRpgSlidesIndex);
    slideShow("shooter-slide", myTShirtSlidesIndex);
    slideShow("action-slide", myActionSlidesIndex);
    slideShow("casual-slide", myCasualSlidesIndex);

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
    $("#resultTable").load("loadAllCustomer.php");
}
// load all product function
function loadAllProduct() {
    $('#resultTable').load("loadAllProduct.php");
}

// load all orders function
function loadAllOrder() {
    $('#resultTable').load("loadAllOrder.php");
}

// show delete customer notification:
function showDeleteCustomerNotification(customerId) {
    var text = '<div class="modal" style="display: block;" id="notificationModal">' +
        '<div class="notification">' +
        '<p style="color: red;">Customer Id: ' + customerId + '</p>' +
        '<p>Are you sure you want to delete this customer?</p>' +
        ' <button id = "deleteConfirm" onclick="deleteCustomer(' + customerId + ')">yes</button>' +
        '</div>' +
        '</div>';
    $('.admin-page').append(text);
}

// show cancel order notification
function showCancelOrderNotification(orderId) {
    var text = '<div class="modal" style="display: block;" id="notificationModal">' +
        '<div class="notification">' +
        '<p style="color: red;">Order Id: ' + orderId + '</p>' +
        '<p>Are you sure you want to cancel this order?</p>' +
        ' <button id = "deleteConfirm" onclick="cancelOrder(' + orderId + ')">yes</button>' +
        '</div>' +
        '</div>';
    $('.admin-page').append(text);
}

// show update product form:
function showUpdateProductForm(
    productId, productName, productInStock, productPrice, productPlatform, productSale, productCategory, productDetail, productImgUrl) {
    $.ajax({
        type: "get",
        url: "loadAllCategory.php",
        data: {
            productCategory: productCategory
        },
        success: function (result) {
            var text =
                '<form method="post" class="admin-modal-form">' +
                '<h1 id="formProductId">Product id: ' + '<span style="color: red">' + productId + '</span>' + '</h1>' +
                '<p id="errorMessage"></p>' +
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
                '<select id="formProductCategory' + productId + '"name="formProductCategory">' + result + '</select>' +
                '<label for="productSale">Sale</label>' +
                '<input type="number" name="productSale" id="formProductSale' + productId + '" value="' + productSale + '">' +
                '<button type="button" onclick="updateProduct(' + productId + ')">submit</button>' +
                '</form>';
            $("#updateModal").append(text);
            $("#updateModal").show();
        }
    });
}

// show update order form
function showUpdateOrderForm(orderId, customerId, orderDate,orderAddress) {
    $.ajax({
        type: "get",
        url: "loadOrderDetail.php",
        data: {
            orderId: orderId,
            orderStatus: "processing"
        },
        success: function (result) {
            var text = '<div class="order-update-form">' +
                '<h1>Order id: ' + '<span style="color: red" id="formOrderId">' + orderId + '</span>' + '<br>Customer id: ' + '<span style="color: red">' + customerId + '</span>' + '<br>Date: ' + '<span style="color: red">' + orderDate + '</span>' + '</h1>' +
                '<label for="detailProductId">Address </label>' +
                '<input type="text" name="orderFormAddress" id="orderFormAddress" value="'+orderAddress+'">' +
                '<button onclick="updateOrderAddress('+orderId+')">test</button>'+
                '<p id="errorMessage"></p>' +
                '<form id="orderDetailBox" style="border: 1px solid black">' +
                '<label for="detailProductId">Product Id: </label>' +
                '<input type="number" name="orderFormProductId" id="orderFormProductId">' +
                '<button type="button" onclick="orderUpdateSearchProduct()"><i class="fa fa-search"aria-hidden="true"></i></button>' +
                '<div id="orderFormProductResult"></div>' +
                '</form>' +
                '<div class="order-detail" id="orderDetailResult">' +
                result+
                '</div>' +
                '</div>';
            $("#updateModal").append(text);
            $("#updateModal").show();
        }
    });
}

// show order detail
function showOrderDetail(orderId, customerId, orderDate, orderAddress) {
    $.ajax({
        type: "get",
        url: "loadOrderDetail.php",
        data: {
            orderId: orderId,
            orderStatus: ""
        },
        success: function (result) {
            var text = '<div class="order-update-form">' +
                '<h1>Order id: ' + '<span style="color: red" id="formOrderId">' + orderId + '</span>' + '<br>Customer id: ' + '<span style="color: red">' + customerId + '</span>' + '<br>Date: ' + '<span style="color: red">' + orderDate + '</span>' + '</h1>' +
                '<p id="errorMessage"></p>' +
                '<div class="order-detail">' +
                result+
                '</div>' +
                '</div>';
            $("#updateModal").append(text);
            $("#updateModal").show();
        }
    });
}

//  show add product form:
function showAddProductForm() {
    $.ajax({
        type: "get",
        url: "loadAllCategory.php",
        data: {
            productCategory: ""
        },
        success: function (result) {
            var text = '<form method="post" class="admin-modal-form">' +
                '<h1>add new product</h1>' +
                '<p id="errorMessage"></p>' +
                '<label for=" productName">Name</label>' +
                '<input type="text" name="productName" id="productNameInput">' +
                '<label for="productInStock">In stock</label>' +
                '<input type="number" name="ProductInStock" id="productInStockInput">' +
                '<label for="productPrice">Price</label>' +
                '<input type="number" name="productPrice" id="productPriceInput">' +
                '<label for="productPlatform">Platform</label>' +
                '<input type="text" name="productPlatform" id="productPlatformInput">' +
                '<label for="productDetail">Detail</label>' +
                '<textarea name="productDetail" id="productDetailInput" cols="30" rows="10"></textarea>' +
                '<label for="productImgUrl">Img Url</label>' +
                '<input type="text" name="productImgUrl" id="productImgUrlInput">' +
                '<label for="productCategory">Category</label>' +
                '<select id="productCategoryInput"name="formProductCategory">' + result + '</select>' +
                '<label for="productSale">Sale</label>' +
                '<input type="number" name="productSale" id="productSaleInput">' +
                '<button type="button" onclick="addProduct()">submit</button>' +
                '</form>';
            $("#updateModal").append(text);
            $("#updateModal").show();
        }
    });
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
    if ((productName == '') || (productInStock == '') || (productPrice == '') || (productPlatform == '') || (productSale == '') || (productCategory == '') || (productDetail == '') || (productImgUrl == '')) {
        $('#errorMessage').empty();
        $('#errorMessage').append("empty value");
    } else {
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
}
// update order address
function updateOrderAddress(orderId){
    var orderNewAddress = $('#orderFormAddress').val();
    $.ajax({
        type: "post",
        url: "updateOrderAddress.php",
        data: {
            orderId: orderId,
            orderNewAddress: orderNewAddress
        },
        success: function (response) {
            loadAllOrder();
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
            $('#notificationModal').remove();
            $("#resultTable").load("loadAllCustomer.php");
        }
    });
}

// delete product from order
function deleteProductFromOrder(productId, rowCount) {
    var orderId = $('#formOrderId').text();
    if (rowCount == 1) {
        showCancelOrderNotification(orderId);
    } else {
        $.ajax({
            type: "get",
            url: "loadOrderDetailSum.php",
            data: {
                productId: productId,
                orderId: orderId
            },
            success: function (result) {
                var orderNewSum = parseInt(result);
                $.ajax({
                    type: "get",
                    url: "loadOrderSum.php",
                    data: {
                        orderId: orderId
                    },
                    success: function (result) {
                        orderNewSum = parseInt(result) - orderNewSum;
                        $.ajax({
                            type: "post",
                            url: "updateOrderSum.php",
                            data: {
                                orderId: orderId,
                                orderNewSum: orderNewSum
                            },
                            success: function (result) {
                                $.ajax({
                                    type: "post",
                                    url: "deleteProductFromOrder.php",
                                    data: {
                                        orderId: orderId,
                                        productId: productId
                                    },
                                    success: function (response) {
                                        $.ajax({
                                            type: "get",
                                            url: "loadOrderDetail.php",
                                            data: {
                                                orderId: orderId,
                                                orderStatus: "processing"
                                            },
                                            success: function (result) {
                                                $('#orderDetailResult').empty();
                                                $('#orderDetailResult').append(result);
                                                loadAllOrder();
                                            }
                                        });
                                    }
                                });
                            }
                        });

                    }
                });
            }
        });
    }
}

//  cancel order function
function cancelOrder(orderId) {
    $.ajax({
        type: "post",
        url: "cancelOrder.php",
        data: {
            orderId: orderId
        },
        success: function (response) {
            $('#notificationModal').remove();
            removeUpdateModalContents();
            $("#resultTable").load("loadAllOrder.php");
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

// search product
function searchProduct() {
    var productId = $('#productId').val();
    var productName = $('#productName').val();
    var productInStock = $('#productInStock').val();
    var productPrice = $('#productPrice').val();
    var productPlatform = $('#productPlatform').val();
    var productSale = $('#productSale').val();
    var productCategory = $('#productCategory').val();
    if (productId) {
        $.ajax({
            type: "get",
            url: "searchProductById.php",
            data: {
                productId: productId
            },
            success: function (result) {
                $('#resultTable').empty();
                $('#resultTable').append(result);
            }
        });
    } else if (productName) {
        $.ajax({
            type: "get",
            url: "searchProductByName.php",
            data: {
                productName: productName
            },
            success: function (result) {
                $('#resultTable').empty();
                $('#resultTable').append(result);
            }
        });
    } else if (productSale) {
        $.ajax({
            type: "get",
            url: "searchProductBySale.php",
            data: {
                productSale: productSale
            },
            success: function (result) {
                $('#resultTable').empty();
                $('#resultTable').append(result);
            }
        });
    } else {
        if (!productPrice) productPrice = 0;
        if (!productInStock) productInStock = 0;
        $.ajax({
            type: "get",
            url: "searchProductByOther.php",
            data: {
                productInStock: productInStock,
                productPrice: productPrice,
                productCategory: productCategory,
                productPlatform: productPlatform

            },
            success: function (result) {
                $('#resultTable').empty();
                $('#resultTable').append(result);
            }
        });
    }
}

// search product for order update form
function orderUpdateSearchProduct() {
    var productId = $('#orderFormProductId').val();
    $.ajax({
        type: "get",
        url: "orderUpdateSearchProduct.php",
        data: {
            productId: productId
        },
        success: function (result) {
            $('#orderFormProductResult').empty();
            $('#orderFormProductResult').append(result);
        }
    });
}
//  add a product to database
function addProduct() {
    var productName = $('#productNameInput').val();
    var productInStock = $('#productInStockInput').val();
    var productPrice = $('#productPriceInput').val();
    var productPlatform = $('#productPlatformInput').val();
    var productDetail = $('#productDetailInput').val();
    var productCategory = $('#productCategoryInput').val();
    var productImgUrl = $('#productImgUrlInput').val();
    var productSale = $('#productSaleInput').val();
    if ((productName == '') || (productInStock == '') || (productPrice == '') || (productPlatform == '') || (productSale == '') || (productCategory == '') || (productDetail == '') || (productImgUrl == '')) {
        $('#errorMessage').empty();
        $('#errorMessage').append("empty value");
    } else {
        $.ajax({
            type: "post",
            url: "addProduct.php",
            data: {
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

}

// search order
function searchOrder(){
    var orderId = $('#orderId').val();
    var customerId = $('#customerId').val();
    var orderSum = $('#orderSum').val();
    var orderDate= $('#orderDate').val();
    var orderStatus = $('#orderStatus').val();
    if(orderId){
        $.ajax({
            type: "get",
            url: "loadOrderById.php",
            data: {
                orderId: orderId
            },
            success: function (result) {
                $('#resultTable').empty();
                $('#resultTable').append(result);
            }
        });
    } else{
        if(!customerId) customerId=0;
        if(!orderSum) orderSum =0;
        $.ajax({
            type: "get",
            url: "loadOrderByOther.php",
            data: {
                customerId: customerId,
                orderSum: orderSum,
                orderDate: orderDate,
                orderStatus: orderStatus
            },
            success: function (result) {
                $('#resultTable').empty();
                $('#resultTable').append(result);
            }
        });
    }
}

// add a product to order
function addProductToOrder(productId, productPrice) {
    var orderId = $('#formOrderId').text();
    var productAmount = $('#formProductAmount').val();
    $.ajax({
        type: "post",
        url: "addProductToOrder.php",
        data: {
            orderId: orderId,
            productId : productId,
            productAmount: productAmount,
            productPrice: productPrice
        },
        success: function (response) {
            $.ajax({
                type: "post",
                url: "addOrderSum.php",
                data: {
                    orderId:orderId,
                    orderNewSum: productPrice*productAmount
                },
                success: function (response) {
                    $.ajax({
                        type: "get",
                        url: "loadOrderDetail.php",
                        data: {
                            orderId: orderId,
                            orderStatus: "processing"
                        },
                        success: function (result) {
                            $('#orderDetailResult').empty();
                            $('#orderDetailResult').append(result);
                            loadAllOrder();
                        }
                    });
                }
            });
        }
    });
}

// remove a product from order
function removeOneProduct(productId,orderId,productAmount,productSum){
    if(productAmount>1){
    var oneProductPrice = productSum/productAmount;
    $.ajax({
        type: "post",
        url: "removeOneProduct.php",
        data: {
            productId: productId,
            orderId: orderId,
            productPrice: oneProductPrice
        },
        success: function (response) {
            $.ajax({
                type: "get",
                url: "loadOrderDetail.php",
                data: {
                    orderId: orderId,
                    orderStatus: "processing"
                },
                success: function (result) {
                    $('#orderDetailResult').empty();
                    $('#orderDetailResult').append(result);
                    loadAllOrder();
                }
            });
        }
    });
}
}

//change to customer table
function changeToCustomersTable() {
    $('#adminPageContentsCustomer').show();
    $('#adminPageContentsProduct').hide();
    $('#adminPageContentsOrder').hide();
    $('#resultTable').empty();
    $('#resultTable').removeClass('result-table-product');
    $('#resultTable').removeClass('result-table-order');
    $('#resultTable').addClass('result-table-customer');
    $('#adminPageFooter').empty();
    var text = '<button id="ShowAllCustomerBtn" onclick="loadAllCustomers()"><i class="fa fa-list-alt fa-3x"' +
        'aria-hidden="true"></i></button>';
    $('#adminPageFooter').append(text);
    $('#adminPageHeader').html("customers");
    $('#customersBtn').css({
        'color': 'white'
    });
    $('#ordersBtn').css({
        'color': '#666'
    })
    $('#productsBtn').css({
        'color': '#666'
    });

}
//change to orders table
function changeToOrdersTable() {
    $('#adminPageContentsCustomer').hide();
    $('#adminPageContentsProduct').hide();
    $('#adminPageContentsOrder').show();
    $('#resultTable').empty();
    $('#resultTable').removeClass('result-table-product');
    $('#resultTable').removeClass('result-table-customer');
    $('#resultTable').addClass('result-table-order');
    $('#adminPageFooter').empty();
    var text = '<button id="loadAllOrdersBtn" onclick="loadAllOrder()"><i class="fa fa-list-alt fa-3x"' +
        'aria-hidden="true"></i></button>';
    $('#adminPageFooter').append(text);
    $('#adminPageHeader').html("orders");
    $('#customersBtn').css({
        'color': '#666'
    });
    $('#productsBtn').css({
        'color': '#666'
    });
    $('#ordersBtn').css({
        'color': 'white'
    })
}
//change to products table
function changeToProductsTable() {
    $('#adminPageContentsCustomer').hide();
    $('#adminPageContentsOrder').hide();
    $('#adminPageContentsProduct').show();
    $('#resultTable').empty();
    $('#resultTable').removeClass('result-table-customer');
    $('#resultTable').removeClass('result-table-order');
    $('#resultTable').addClass('result-table-product');
    $('#adminPageFooter').empty();
    var text = '<button id="loadAllProductBtn" onclick="loadAllProduct()"><i class="fa fa-list-alt fa-3x"' +
        'aria-hidden="true"></i></button>' +
        '<button id="addProductBtn" onclick="showAddProductForm()"><i class="fa fa-plus fa-3x" aria-hidden="true"></i></button>';
    $('#adminPageFooter').append(text);
    $('#adminPageHeader').html("products");
    $('#customersBtn').css({
        'color': '#666'
    });
    $('#ordersBtn').css({
        'color': '#666'
    })
    $('#productsBtn').css({
        'color': 'white'
    });
}

function test() {
    alert("click");
}