<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Brian2694\Toastr\Facades\Toastr;


class ShopCart extends Controller
{
    public function showCart(Request $request)
    {
        $meta_title = "MultiShop | Giỏ hàng ";
        $url_canonical = $request->url();
        $shop = Product::all();
        return view('client.product_cart', compact('meta_title', 'url_canonical', 'shop'));
    }

    public function addCart(Request $request)
    {
        $productId = $request->id_sp;
        $qty = $request->qty;
        $product = Product::where('id', $productId)->first();
        if ($product->price_sale != 0) {
            $price = $product->price_sale;
        } else {
            $price = $product->price;
        }
        $data['id'] = $product->id;
        $data['qty'] = $qty;
        $data['name'] = $product->name;
        $data['price'] = $price;
        $data['options']['image'] = $product->image;
        $data['options']['price'] = $product->price;
        $data['options']['price_sale'] = $product->price_sale;
        Cart::add($data);
        return redirect()->route('client.shop.cart');
    }

    public function updateCart(Request $request)
    {
        $rowId = $request->row_id;
        $qty = $request->qty;
        $price = $request->price;
        Cart::update($rowId, $qty);
        $totalSp = $qty * $price;
        $newTotal = Cart::subtotal();

        return response()->json([
            'totalSp' => $totalSp,
            'rowId' => $rowId,
            'newTotal' => $newTotal,

        ]);
    }
    public function deleteCart(Request $request)
    {
        $url = route('client.home');
        $rowId = $request->rowId;
        Cart::remove($rowId);
        $newTotal = Cart::subtotal();
        $cartCount = Cart::content()->count();
        $html = ' 
        <div class="container" style="height: 400px !important">
            <div class="row px-xl-12 mx-auto cart-custom-container">
                <div class="cart-custom-img"></div>
                    <div class="cart-custom-p">Giỏ hàng của bạn còn trống</div>
                        <a href="' . $url . '" class="cart-custom-a">
                            <button class="btn btn-block btn-primary my-3 py-3 ">
                                Mua ngay
                            </button>
                        </a>
                </div>
            </div>
        </div>';
        $output = '';
        $product = Cart::content();
        $product = $product->reverse();
        $output .= '
        <div class="shopping-cart-header">
        <i class="fas fa-shopping-cart text-primary"></i>
        <div class="shopping-cart-total">
            <span class="lighter-text">Tổng:</span>
            <span
                class="main-color-text">' . number_format(Cart::subtotal(), 0, '', '.') . '<span
                    class="price">đ</span></span>
        </div>
    </div>


    <ul class="shopping-cart-items">
    
    ';
        if (Cart::count() > 0) {
            foreach ($product as $sp) {
                $output .= '
            <li class="clearfix-box">
            <img src="' . asset('upload/product') . '/' . $sp->options->image . '"
                style="width: 60px;" alt="item1" />
            <span class="item-name"><a
                    href="' . route('client.shop.detail', [$sp->id]) . '"style="color:black">' . mb_substr($sp->name, 0, 20) . '...
                </a> </span>
';
                if ($sp->options->price_sale != 0) {
                    $output .= '
                <div class="d-flex align-items-center">
                    <span class="item-price"
                        style="color:red;font-size: 15px;">
                        ' . number_format($sp->options->price_sale, 0, '', '.') . '
                    </span>

                    <del style="font-size: 14px;">
                        ' . number_format($sp->options->price, 0, '', '.') . '</del>
                </div>
            ';
                } else {
                    $output .= '
                <span class="item-price"
                    style="font-size: 15px;color:#6C757D;">
                    ' . number_format($sp->price, 0, '', '.') . '</span>';
                }
                $output .= '
            <span class="item-quantity"
                style="font-size: 14px;display: block;">Số lượng:
                ' . $sp->qty . '            </li>';
            }
            $output .= '
</ul>
<div class="d-flex">

    <a href="' . route('client.shop.cart') . '"
        class="button cart-box col-12">Giỏ
        hàng</a>
</div>
</div>
            ';
        }


        return response()->json([
            'message' => $html,
            'cart_count' => $cartCount,
            'newTotal' => $newTotal,
            'output' => $output,

        ]);
    }
    public function deleteAllCart()
    {
        $url = route('client.home');
        Cart::destroy();
        $cartCount = Cart::content()->count();
        $html = ' 
        <div class="container" style="height: 400px !important">
            <div class="row px-xl-12 mx-auto cart-custom-container">
                <div class="cart-custom-img"></div>
                    <div class="cart-custom-p">Giỏ hàng của bạn còn trống</div>
                        <a href="' . $url . '" class="cart-custom-a">
                            <button class="btn btn-block btn-primary my-3 py-3 ">
                                Mua ngay
                            </button>
                        </a>
                </div>
            </div>
        </div>';
        $output = '';
        $product = Cart::content();
        $output .= '
        <div class="shopping-cart-header">
        <i class="fas fa-shopping-cart text-primary"></i>
        <div class="shopping-cart-total">
            <span class="lighter-text">Tổng:</span>
            <span
                class="main-color-text">' . number_format(Cart::subtotal(), 0, '', '.') . '<span
                    class="price">đ</span></span>
        </div>
    </div>


    <ul class="shopping-cart-items">
    
    ';
        if (Cart::count() > 0) {
            foreach ($product as $sp) {
                $output .= '
            <li class="clearfix-box">
            <img src="' . asset('upload/product') . '/' . $sp->options->image . '"
                style="width: 60px;" alt="item1" />
            <span class="item-name"><a
                    href="' . route('client.shop.detail', [$sp->id]) . '"style="color:black">' . mb_substr($sp->name, 0, 20) . '...
                </a> </span>
';
                if ($sp->options->price_sale != 0) {
                    $output .= '
                <div class="d-flex align-items-center">
                    <span class="item-price"
                        style="color:red;font-size: 15px;">
                        ' . number_format($sp->options->price_sale, 0, '', '.') . '
                    </span>

                    <del style="font-size: 14px;">
                        ' . number_format($sp->options->price, 0, '', '.') . '</del>
                </div>
            ';
                } else {
                    $output .= '
                <span class="item-price"
                    style="font-size: 15px;color:#6C757D;">
                    ' . number_format($sp->price, 0, '', '.') . '</span>';
                }
                $output .= '
            <span class="item-quantity"
                style="font-size: 14px;display: block;">Số lượng:
                ' . $sp->qty . '            </li>';
            }
            $output .= '
</ul>
<div class="d-flex">

    <a href="' . route('client.shop.cart') . '"
        class="button cart-box col-12">Giỏ
        hàng</a>
</div>
</div>
            ';
        }



        return response()->json([
            'message' => $html,
            'cart_count' => $cartCount,
            'output' => $output,
        ]);
    }
    public function addCartView(Request $request)
    {
        if ($request->cart_product_price_sale != 0) {
            $price = $request->cart_product_price_sale;
        } else {
            $price = $request->cart_product_price;
        }
        $data['id'] = $request->cart_product_id;
        $data['qty'] = $request->cart_product_qty;
        $data['name'] = $request->cart_product_name;
        $data['price'] = $price;
        $data['options']['image'] = $request->cart_product_image;
        $data['options']['price'] = $request->cart_product_price;
        $data['options']['price_sale'] = $request->cart_product_price_sale;
        Cart::add($data);
        $cartCount = Cart::content()->count();
        $output = '';
        $product = Cart::content();
        $product = $product->reverse();

        $output .= '
        <div class="shopping-cart-header">
        <i class="fas fa-shopping-cart text-primary"></i>
        <div class="shopping-cart-total">
            <span class="lighter-text">Tổng:</span>
            <span
                class="main-color-text">' . number_format(Cart::subtotal(), 0, '', '.') . '<span
                    class="price">đ</span></span>
        </div>
    </div>


    <ul class="shopping-cart-items">
    
    ';
        if (Cart::count() > 0) {
            foreach ($product as $sp) {
                $output .= '
            <li class="clearfix-box">
            <img src="' . asset('upload/product') . '/' . $sp->options->image . '"
                style="width: 60px;" alt="item1" />
            <span class="item-name"><a
                    href="' . route('client.shop.detail', [$sp->id]) . '"style="color:black">' . mb_substr($sp->name, 0, 20) . '...
                </a> </span>
';
                if ($sp->options->price_sale != 0) {
                    $output .= '
                <div class="d-flex align-items-center">
                    <span class="item-price"
                        style="color:red;font-size: 15px;">
                        ' . number_format($sp->options->price_sale, 0, '', '.') . '
                    </span>

                    <del style="font-size: 14px;">
                        ' . number_format($sp->options->price, 0, '', '.') . '</del>
                </div>
            ';
                } else {
                    $output .= '
                <span class="item-price"
                    style="font-size: 15px;color:#6C757D;">
                    ' . number_format($sp->price, 0, '', '.') . '</span>';
                }
                $output .= '
            <span class="item-quantity"
                style="font-size: 14px;display: block;">Số lượng:
                ' . $sp->qty . '            </li>';
            }
            $output .= '
</ul>
<div class="d-flex">

    <a href="' . route('client.shop.cart') . '"
        class="button cart-box col-12">Giỏ
        hàng</a>
</div>
</div>
            ';
        }


        return response()->json([
            'cart_count' => $cartCount,
            'output' => $output,
        ]);
    }
    public function addQuickViewCart(Request $request)
    {
        $id = $request->id;
        $product = Product::find($id);
        if ($product->price_sale != 0) {
            $price = $product->price_sale;
        } else {
            $price = $product->price;
        }
        $data['id'] = $product->id;
        $data['qty'] = 1;
        $data['name'] = $product->name;
        $data['price'] = $price;
        $data['options']['image'] = $product->image;
        $data['options']['price'] = $product->price;
        $data['options']['price_sale'] = $product->price_sale;
        Cart::add($data);
        $cartCount = Cart::content()->count();
        $output = '';
        $product = Cart::content();
        $product = $product->reverse();

        $output .= '
        <div class="shopping-cart-header">
        <i class="fas fa-shopping-cart text-primary"></i>
        <div class="shopping-cart-total">
            <span class="lighter-text">Tổng:</span>
            <span
                class="main-color-text">' . number_format(Cart::subtotal(), 0, '', '.') . '<span
                    class="price">đ</span></span>
        </div>
    </div>


    <ul class="shopping-cart-items">
    
    ';
        if (Cart::count() > 0) {
            foreach ($product as $sp) {
                $output .= '
            <li class="clearfix-box">
            <img src="' . asset('upload/product') . '/' . $sp->options->image . '"
                style="width: 60px;" alt="item1" />
            <span class="item-name"><a
                    href="' . route('client.shop.detail', [$sp->id]) . '"style="color:black">' . mb_substr($sp->name, 0, 20) . '...
                </a> </span>';
                if ($sp->options->price_sale != 0) {
                    $output .= '
                <div class="d-flex align-items-center">
                    <span class="item-price"
                        style="color:red;font-size: 15px;">
                        ' . number_format($sp->options->price_sale, 0, '', '.') . '
                    </span>

                    <del style="font-size: 14px;">
                        ' . number_format($sp->options->price, 0, '', '.') . '</del>
                </div>
            ';
                } else {
                    $output .= '
                <span class="item-price"
                    style="font-size: 15px;color:#6C757D;">
                    ' . number_format($sp->price, 0, '', '.') . '</span>';
                }
                $output .= '
            <span class="item-quantity"
                style="font-size: 14px;display: block;">Số lượng:
                ' . $sp->qty . '            </li>';
            }
            $output .= '
</ul>
<div class="d-flex">

    <a href="' . route('client.shop.cart') . '"
        class="button cart-box col-12">Giỏ
        hàng</a>
</div>
</div>
            ';
        }


        return response()->json([
            'cart_count' => $cartCount,
            'output' => $output,
        ]);
    }
    public function showCartIcon()
    {
        $output = '';
        $product = Cart::content();
        $product = $product->reverse();
        $output .= '
            <div class="shopping-cart-header">
            <i class="fas fa-shopping-cart text-primary"></i>
            <div class="shopping-cart-total">
                <span class="lighter-text">Tổng:</span>
                <span
                    class="main-color-text">' . number_format(Cart::subtotal(), 0, '', '.') . '<span
                        class="price">đ</span></span>
            </div>
        </div>


        <ul class="shopping-cart-items">
        
        ';
        if (Cart::count() > 0) {
            foreach ($product as $sp) {
                $output .= '
                <li class="clearfix-box">
                <img src="' . asset('upload/product') . '/' . $sp->options->image . '"
                    style="width: 60px;" alt="item1" />
                <span class="item-name"><a
                        href="' . route('client.shop.detail', [$sp->id]) . '"style="color:black">' . mb_substr($sp->name, 0, 20) . '...
                    </a> </span>
';
                if ($sp->options->price_sale != 0) {
                    $output .= '
                    <div class="d-flex align-items-center">
                        <span class="item-price"
                            style="color:red;font-size: 15px;">
                            ' . number_format($sp->options->price_sale, 0, '', '.') . 'đ
                        </span>

                        <del style="font-size: 14px;">
                            ' . number_format($sp->options->price, 0, '', '.') . 'đ</del>
                    </div>
                ';
                } else {
                    $output .= '
                    <span class="item-price"
                        style="font-size: 15px;color:#6C757D;">
                        ' . number_format($sp->price, 0, '', '.') . 'đ</span>';
                }
                $output .= '
                <span class="item-quantity"
                    style="font-size: 14px;display: block;">Số lượng:
                    ' . $sp->qty . '            </li>';
            }
            $output .= '
    </ul>
    <div class="d-flex">

        <a href="' . route('client.shop.cart') . '"
            class="button cart-box col-12">Giỏ
            hàng</a>
    </div>
</div>
                ';
        }

        echo $output;
    }
}
