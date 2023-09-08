<?php

use Illuminate\Support\Facades\Route;

// Admin
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Category;
use App\Http\Controllers\Admin\Brand;
use App\Http\Controllers\Admin\Product;
use App\Http\Controllers\Admin\Delivery;
use App\Http\Controllers\Admin\Orders;
use App\Http\Controllers\Admin\Slider;
use App\Http\Controllers\Admin\Role;
use App\Http\Controllers\Admin\User;
use App\Http\Controllers\Admin\Comment;

// Client
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\Shop;
use App\Http\Controllers\Client\ShopCheckout;
use App\Http\Controllers\Client\ShopCart;
use App\Http\Controllers\Client\ShopDetail;
use App\Http\Controllers\Client\MyAccount;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'viewLogin'])->name('admin.viewLogin');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
});

Route::prefix('admin')->middleware('admin')->group(function () {

    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');

    // ***** Danh muc *****
    Route::get('/list-category', [Category::class, 'listCategory'])->name('admin.listCategory');

    Route::middleware('auth.roles')->group(function () {
        //Thêm danh mục
        Route::get('/create-category', [Category::class, 'createCategory'])->name('admin.createCategory');
        Route::post('/add-category', [Category::class, 'addCategory'])->name('admin.addCategory');

        //Cập nhật danh mục sản phẩm
        Route::get('/edit-category/{id}', [Category::class, 'editCategory'])->name('admin.editCategory');
        Route::post('/update-category/{id}', [Category::class, 'updateCategory'])->name('admin.updateCategory');

        //Xóa danh mục sản phẩm
        Route::get('/delete-category/{id}', [Category::class, 'deleteCategory'])->name('admin.deleteCategory');

        //Ẩn / Hiển danh mục sản phẩm
        Route::get('/active-category/{id}', [Category::class, 'activeCategory'])->name('admin.activeCategory');
        Route::get('/unActive-category/{id}', [Category::class, 'unActiveCategory'])->name('admin.unActiveCategory');
    });

    // ***** Thương hiệu *****
    Route::get('/list-brand', [Brand::class, 'listBrand'])->name('admin.listBrand');

    Route::middleware('auth.roles')->group(function () {
        //Thêm thương hiệu
        Route::get('/create-brand', [Brand::class, 'createBrand'])->name('admin.createBrand');
        Route::post('/add-brand', [Brand::class, 'addBrand'])->name('admin.addBrand');

        //Cập nhật thương hiệu sản phẩm
        Route::get('/edit-brand/{id}', [Brand::class, 'editBrand'])->name('admin.editBrand');
        Route::post('/update-brand/{id}', [Brand::class, 'updateBrand'])->name('admin.updateBrand');

        //Xóa thương hiệu sản phẩm
        Route::get('/delete-brand/{id}', [Brand::class, 'deleteBrand'])->name('admin.deleteBrand');

        //Ẩn / Hiển thương hiệu sản phẩm
        Route::get('/active-brand/{id}', [Brand::class, 'activeBrand'])->name('admin.activeBrand');
        Route::get('/unActive-brand/{id}', [Brand::class, 'unActiveBrand'])->name('admin.unActiveBrand');
    });


    // ***** Sản phẩm *****
    Route::get('/list-product', [Product::class, 'listProduct'])->name('admin.listProduct');

    Route::middleware('auth.roles')->group(function () {
        //Thêm sản phẩm
        Route::get('/create-product', [Product::class, 'createProduct'])->name('admin.createProduct');
        Route::post('/add-product', [Product::class, 'addProduct'])->name('admin.addProduct');

        //Cập nhật sản phẩm
        Route::get('/edit-product/{id}', [Product::class, 'editProduct'])->name('admin.editProduct');
        Route::post('/update-product/{id}', [Product::class, 'updateProduct'])->name('admin.updateProduct');

        //Xóa sản phẩm
        Route::get('/delete-product/{id}', [Product::class, 'deleteProduct'])->name('admin.deleteProduct');

        //Ẩn / Hiển sản phẩm
        Route::get('/active-product/{id}', [Product::class, 'activeProduct'])->name('admin.activeProduct');
        Route::get('/unActive-product/{id}', [Product::class, 'unActiveProduct'])->name('admin.unActiveProduct');

        // Thư viện ảnh
        Route::get('/product-gallery/{id}', [Product::class, 'productGallery'])->name('admin.productGallery');
        Route::post('/select-gallery', [Product::class, 'selectGallery'])->name('admin.selectGallery');
        Route::post('/add-gallery/{id}', [Product::class, 'addGallery'])->name('admin.addGallery');
        Route::post('/update-gallery', [Product::class, 'updateGallery'])->name('admin.updateGallery');
        Route::get('/delete-gallery/{id}', [Product::class, 'deleteGallery'])->name('admin.deleteGallery');
    });


    // ***** van chuyen *****
    Route::get('/delivery', [Delivery::class, 'delivery'])->name('admin.delivery');

    Route::middleware('auth.roles')->group(function () {
        Route::post('/select-delivery', [Delivery::class, 'selectDelivery'])->name('admin.select.delivery');
        Route::post('/create-delivery', [Delivery::class, 'createDelivery'])->name('admin.create.delivery');
        Route::post('/show-delivery', [Delivery::class, 'showDelivery'])->name('admin.show.delivery');
        Route::post('/update-delivery', [Delivery::class, 'updateDelivery'])->name('admin.update.delivery');
    });


    // ***** Đơn hàng *****
    Route::get('/list-orders', [Orders::class, 'listOrders'])->name('admin.listOrders');

    Route::get('/delete-orders/{id}', [Orders::class, 'deleteOrder'])->name('admin.deleteOrder')->middleware('auth.roles');

    // ***** Chi tiết đơn hàng *****
    Route::get('/order-detail/{id}', [Orders::class, 'orderDetail'])->name('admin.orderDetail');

    Route::middleware('auth.roles')->group(function () {
        Route::get('/delete-orders-detail/{id}', [Orders::class, 'deleteOrderDetail'])->name('admin.deleteOrderDetail');
        Route::post('/update-qty-status-order-detail', [Orders::class, 'updateQtyStatusOrderDetail'])->name('admin.updateQtyStatusOrderDetail');
        Route::post('/update-qty-order-detail', [Orders::class, 'updateQtyOrderDetail'])->name('admin.updateQtyOrderDetail');
    });

    // ***** Slider *****
    Route::get('/list-slider', [Slider::class, 'listSlider'])->name('admin.listSlider');

    Route::middleware('auth.roles')->group(function () {
        //Thêm Slider
        Route::get('/create-slider', [Slider::class, 'createSlider'])->name('admin.createSlider');
        Route::post('/add-slider', [Slider::class, 'addSlider'])->name('admin.addSlider');

        //Cập nhật slider
        Route::get('/edit-slider/{id}', [Slider::class, 'editSlider'])->name('admin.editSlider');
        Route::post('/update-slider/{id}', [Slider::class, 'updateSlider'])->name('admin.updateSlider');

        //Xóa slider
        Route::get('/delete-slider/{id}', [Slider::class, 'deleteSlider'])->name('admin.deleteSlider');

        //Ẩn / Hiển slider
        Route::get('/active-slider/{id}', [Slider::class, 'activeSlider'])->name('admin.activeSlider');
        Route::get('/unActive-slider/{id}', [Slider::class, 'unActiveSlider'])->name('admin.unActiveSlider');
    });

    // ***** Role *****
    Route::get('/list-role', [Role::class, 'listRole'])->name('admin.listRole');

    Route::middleware('auth.roles')->group(function () {
        //Thêm role
        Route::get('/create-role', [Role::class, 'createRole'])->name('admin.createRole');
        Route::post('/add-role', [Role::class, 'addRole'])->name('admin.addRole');

        //Cập nhật role
        Route::get('/edit-role/{id}', [Role::class, 'editRole'])->name('admin.editRole');
        Route::post('/update-role/{id}', [Role::class, 'updateRole'])->name('admin.updateRole');

        //Xóa role
        Route::get('/delete-role/{id}', [Role::class, 'deleteRole'])->name('admin.deleteRole');
    });

    // ***** User *****
    Route::get('/list-user', [User::class, 'listUser'])->name('admin.listUser');

    Route::middleware('auth.roles')->group(function () {
        Route::post('/update-role-user', [User::class, 'updateRoleUser'])->name('admin.updateRoleUser');
        //Xóa User
        Route::get('/delete-user/{id}', [User::class, 'deleteUser'])->name('admin.deleteUser');
    });

    // ***** Comment *****
    Route::get('/list-comment', [Comment::class, 'listComment'])->name('admin.listComment');

    Route::middleware('auth.roles')->group(function () {

        //Cập nhật Comment
        Route::post('/reply-comment', [Comment::class, 'replyComment'])->name('admin.replyComment');

        //Xóa Comment
        Route::get('/delete-comment/{id}', [Comment::class, 'deleteComment'])->name('admin.deleteComment');
    });
});






Route::prefix('client')->group(function () {

    //Trang chủ
    Route::get('/home', [ClientController::class, 'index'])->name('client.home');

    Route::get('/login', [ClientController::class, 'viewLogin'])->name('client.viewLogin');
    Route::post('/login', [ClientController::class, 'login'])->name('client.login');

    Route::get('/register', [ClientController::class, 'viewRegister'])->name('client.viewRegister');
    Route::post('/register', [ClientController::class, 'register'])->name('client.register');

    Route::get('/logout', [ClientController::class, 'logout'])->name('client.logout');

    // Product
    Route::get('/product-category/{id}', [Shop::class, 'shopCategory'])->name('client.shop.category');
    Route::get('/product-brand/{id}', [Shop::class, 'shopBrand'])->name('client.shop.brand');
    Route::get('/product-check', [Shop::class, 'shopCheck'])->name('client.shop.check');
    Route::post('/product-search', [Shop::class, 'shopSearch'])->name('client.shop.search');
    Route::post('/product-quickview', [Shop::class, 'quickView'])->name('client.shop.quickView');

    Route::get('/product-detail/{id}', [ShopDetail::class, 'shopDetail'])->name('client.shop.detail');
    Route::post('/product-comments', [ShopDetail::class, 'showComments'])->name('client.shop.comments');
    Route::post('/product-add-comments', [ShopDetail::class, 'addComments'])->name('client.shop.add.comment');

    // add cart
    Route::get('/shopping-cart', [ShopCart::class, 'showCart'])->name('client.shop.cart');
    Route::post('/shopping-cart-detail', [ShopCart::class, 'addCart'])->name('client.shop.add.cart');
    Route::post('/shopping-cart', [ShopCart::class, 'addCartView'])->name('client.shop.add.cart.view');
    Route::post('/update-cart', [ShopCart::class, 'updateCart'])->name('client.shop.update.cart');
    Route::post('/delete-cart', [ShopCart::class, 'deleteCart'])->name('client.shop.delete.cart');
    Route::post('/delete-all-cart', [ShopCart::class, 'deleteAllCart'])->name('client.shop.delete.all.cart');
    Route::post('/add-quickview-cart', [ShopCart::class, 'addQuickViewCart'])->name('client.addQuickViewCart');
    Route::get('/show-cart-icon', [ShopCart::class, 'showCartIcon'])->name('client.showCartIcon');

    // Thanh toán
    Route::get('/checkout', [ShopCheckout::class, 'checkout'])->name('client.shop.checkout');
    Route::post('/select-delivery', [ShopCheckout::class, 'selectDeliveryClient'])->name('client.select.delivery');
    Route::post('/orders', [ShopCheckout::class, 'orders'])->name('client.shop.orders');
    Route::get('/orders-notification', [ShopCheckout::class, 'ordersNotification'])->name('client.shop.orders.notification');
    Route::post('/price_delivery', [ShopCheckout::class, 'priceDelivery'])->name('client.price.delivery');

    Route::get('/wishlist', [ClientController::class, 'viewWishlist'])->name('client.view.wishlist');

    // My Account
    Route::get('/my-account', [MyAccount::class, 'myAccount'])->name('client.my.account');
    Route::get('/my-account-info/{id}', [MyAccount::class, 'myAccountInfo'])->name('client.myAccount.info');
    Route::post('/my-account-up-info/{id}', [MyAccount::class, 'myAccountUpInfo'])->name('client.myAccount.upInfo');
    Route::get('/order-detail-my-account/{id}', [MyAccount::class, 'orderDetailMyAccount'])->name('client.orderDetail.myAccount');
    Route::post('/my-account-cancel-order', [MyAccount::class, 'myAccountCancelOrder'])->name('client.myAccount.cancelOrder');

    // Load Sản phẩm trang chủ 
    Route::post('/load-product-dt', [ClientController::class, 'loadProductDt'])->name('client.load.product.dt');
    Route::post('/load-product-laptop', [ClientController::class, 'loadProductLap'])->name('client.load.product.lap');
    Route::post('/load-product-ipad', [ClientController::class, 'loadProductIpad'])->name('client.load.product.ipad');
});
