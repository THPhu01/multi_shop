<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\User;
use App\Models\Slider;
use App\Models\Role;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Social;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $meta_title = "MultiShop | Điện thoại, Laptop, Tablet ";
        $url_canonical = $request->url();

        $imgSlider = Slider::where('category_id', 4)->where('status', 1)->get();
        return view('client.index', compact('meta_title', 'url_canonical', 'imgSlider'));
    }
    public function viewLogin(Request $request)
    {
        $meta_title = "MultiShop | Đăng nhập ";
        $url_canonical = $request->url();
        return view('client.login', compact('meta_title', 'url_canonical'));
    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|',
            'password' => 'required|min:5'
        ], [
            'email.required' => 'Email không được để trống !',
            'password.required' =>  'Mật khẩu không được để trống !',
            'password.min' =>  'Mật khẩu không được nhỏ hơn :min ký tự !',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $user_cred = $request->only('email', 'password');
        if (Auth::attempt($user_cred)) {
            Toastr::success('Đăng nhập thành công !');
            return response()->json([[1]]);
        } else {
            return response()->json([[2]]);
        }
    }
    public function viewRegister(Request $request)
    {
        $meta_title = "MultiShop | Đăng kí ";
        $url_canonical = $request->url();
        return view('client.register', compact('meta_title', 'url_canonical'));
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|',
            'email' => 'required|unique:users',
            'phone' => 'required|min:10|max:11',
            'password' => 'required|min:5'
        ], [
            'name.required' => 'Tên không được để trống !',
            'email.required' => 'Email không được để trống !',
            'email.unique' => 'Email đã tồn tại !',
            'phone.required' =>  'Điện thoại không được để trống !',
            'phone.min' =>  'Điện thoại không được nhỏ hơn :min ký tự !',
            'phone.max' =>  'Điện thoại không được lớn hơn :max ký tự !',
            'password.required' =>  'Mật khẩu không được để trống !',
            'password.min' =>  'Mật khẩu không được nhỏ hơn :min ký tự !',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $request->flash();

        $data = $request->all();
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->phone = $data['phone'];
        $user->password = Hash::make($data['password']);
        $user->save();
        $user->roles()->attach(Role::where('name', 'Guest')->first());
        Toastr::success('Đăng kí thành công!');
        return response()->json([[1]]);
    }
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect()->route('client.home');;
    }

    public function viewWishlist(Request $request)
    {
        $meta_title = "MultiShop | Sản phẩm yêu thích ";
        $url_canonical = $request->url();
        return view('client.product_wishlist', compact('meta_title', 'url_canonical'));
    }

    public function loadProductDt(Request $request)
    {
        $data = $request->all();

        if ($data['id'] > 0) {
            $productDt = Product::where('category_id', 1)->where('price_sale', '>', 0)->where('id', '<', $data['id'])->where('status', 1)->orderby('id', 'desc')->take(8)->get();
        } else {
            $productDt = Product::where('category_id', 1)->where('price_sale', '>', 0)->where('status', 1)->orderby('id', 'desc')->take(8)->get();
        }

        $output = '';
        if (!$productDt->isEmpty()) {
            foreach ($productDt as $dt) {
                $last_id = $dt->id;
                $output .= '
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4" style="height: 414px">
    
                    <div class="product-img position-relative overflow-hidden" style="height:284px">
                        <img class="img-fluid w-100" src="' . asset('upload/product') . '/' . $dt->image . ' "
                            alt="" style="padding: 30px">
                      
                            <div class="product-action">
    
                                <button type="button" class="btn btn-outline-dark btn-square" onclick="AddToCart(this.id)"
                                    id="' . $dt->id . '" name="add-to-cart"><i
                                        class="fa fa-shopping-cart"></i></button>
    
                                <button type="button" class="btn btn-outline-dark btn-square add-to-wishlist"
                                    onclick="add_wishlist(this.id);" id="' . $dt->id . '">
                                    <i class="far fa-heart">
                                    </i>
                                </button>
    
                                <button type="button" class="btn btn-outline-dark btn-square quickview"
                                    data-toggle="modal" data-target="#exampleModalCenter" 
                                    onclick="QuickView(this.id)"
                                    id="' . $dt->id . '">
                                    <i class="fa fa-search"></i>
                                </button>
    
                            </div>
                          
                            <input type="hidden" value="' . $dt->id . '"
                                class="cart_product_id_' . $dt->id . '">
    
                            <input id="wishlist_name-' . $dt->id . '" type="hidden" value="' . $dt->name . '"
                                class="cart_product_name_' . $dt->id . '">
    
                            <input id="wishlist_linkimage-' . $dt->id . '" type="hidden"
                                value="' . $dt->image . '" src="' . asset('upload/product') . '/' . $dt->image . '"
                                class="cart_product_image_' . $dt->id . '">
    
                            <input id="wishlist_image-' . $dt->id . '" type="hidden" value="' . $dt->image . '">
    
                            <input type="hidden" value="' . $dt->price_sale . '"
                                class="cart_product_price_sale_' . $dt->id . '">
    
                            <input type="hidden" value="' . $dt->price . '"
                                class="cart_product_price_' . $dt->id . '">
    
                            <input id="wishlist_price_sale-' . $dt->id . '" type="hidden"
                                value="' . $dt->price_sale . '">
    
                            <input id="wishlist_price-' . $dt->id . '" type="hidden" value="' . $dt->price . '">
    
                            <input type="hidden" value="1" class="cart_product_qty_' . $dt->id . '">
                       
                    </div>
                    <div class="text-center py-4">
                        <a id="wishlist_id-' . $dt->id . '"
                            class="h6 text-decoration-none text-truncate custom-name-product"
                            href="' . route('client.shop.detail', [$dt->id]) . '">' . $dt->name . '</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">';

                if ($dt->price_sale != 0) {
                    $output .= '
                                <h5 style="color: red">
                                ' . number_format($dt->price_sale, 0, '', '.') . 'đ
                            </h5>
                            <span class="text-muted ml-2">
                                <del>
                                    ' . number_format($dt->price, 0, '', '.') . 'đ
                                </del>
                            </span>
                                ';
                } else {
                    $output .= '
                                <h5>
                                    ' . number_format($dt->price, 0, '', '.') . 'đ
                                </h5>
                                ';
                }

                $output .= '
                        </div>
    
                    </div>
                </div>
            </div>
                ';
            }
            $output .= '
            <div class="col-12">
                <nav>
                    <button id="load-product-dt-button" class="button cart-box col-4 mx-auto border-0" data-id=' . $last_id . '>Xem thêm</button>
                </nav>
            </div>
            ';
        } else {
            $output .= '
            <div class="col-12">
                <nav>
                    <button id="" class="button cart-box col-4 mx-auto border-0" style="background-color: black;">Dữ liệu đang cập nhật thêm ....</button>
                </nav>
            </div>
            ';
        }
        echo $output;
    }

    public function loadProductLap(Request $request)
    {
        $data = $request->all();

        if ($data['id'] > 0) {
            $productLap = Product::where('category_id', 2)->where('price_sale', '>', 0)->where('id', '<', $data['id'])->where('status', 1)->orderby('id', 'desc')->take(8)->get();
        } else {
            $productLap = Product::where('category_id', 2)->where('price_sale', '>', 0)->where('status', 1)->orderby('id', 'desc')->take(8)->get();
        }

        $output = '';
        if (!$productLap->isEmpty()) {
            foreach ($productLap as $lap) {
                $last_id = $lap->id;
                $output .= '
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4" style="height: 414px">
    
                    <div class="product-img position-relative overflow-hidden" style="height:284px">
                        <img class="img-fluid w-100" src="' . asset('upload/product') . '/' . $lap->image . ' "
                            alt="" style="padding: 30px">
                      
                            <div class="product-action">
    
                                <button type="button" class="btn btn-outline-dark btn-square" onclick="AddToCart(this.id)"
                                    id="' . $lap->id . '" name="add-to-cart"><i
                                        class="fa fa-shopping-cart"></i></button>
    
                                <button type="button" class="btn btn-outline-dark btn-square add-to-wishlist"
                                    onclick="add_wishlist(this.id);" id="' . $lap->id . '">
                                    <i class="far fa-heart">
                                    </i>
                                </button>
    
                                <button type="button" class="btn btn-outline-dark btn-square quickview"
                                    data-toggle="modal" data-target="#exampleModalCenter" 
                                    onclick="QuickView(this.id)"
                                    id="' . $lap->id . '">
                                    <i class="fa fa-search"></i>
                                </button>
    
                            </div>
                          
                            <input type="hidden" value="' . $lap->id . '"
                                class="cart_product_id_' . $lap->id . '">
    
                            <input id="wishlist_name-' . $lap->id . '" type="hidden" value="' . $lap->name . '"
                                class="cart_product_name_' . $lap->id . '">
    
                            <input id="wishlist_linkimage-' . $lap->id . '" type="hidden"
                                value="' . $lap->image . '" src="' . asset('upload/product') . '/' . $lap->image . '"
                                class="cart_product_image_' . $lap->id . '">
    
                            <input id="wishlist_image-' . $lap->id . '" type="hidden" value="' . $lap->image . '">
    
                            <input type="hidden" value="' . $lap->price_sale . '"
                                class="cart_product_price_sale_' . $lap->id . '">
    
                            <input type="hidden" value="' . $lap->price . '"
                                class="cart_product_price_' . $lap->id . '">
    
                            <input id="wishlist_price_sale-' . $lap->id . '" type="hidden"
                                value="' . $lap->price_sale . '">
    
                            <input id="wishlist_price-' . $lap->id . '" type="hidden" value="' . $lap->price . '">
    
                            <input type="hidden" value="1" class="cart_product_qty_' . $lap->id . '">
                       
                    </div>
                    <div class="text-center py-4">
                        <a id="wishlist_id-' . $lap->id . '"
                            class="h6 text-decoration-none text-truncate custom-name-product"
                            href="' . route('client.shop.detail', [$lap->id]) . '">' . $lap->name . '</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">';

                if ($lap->price_sale != 0) {
                    $output .= '
                                <h5 style="color: red">
                                ' . number_format($lap->price_sale, 0, '', '.') . 'đ
                            </h5>
                            <span class="text-muted ml-2">
                                <del>
                                    ' . number_format($lap->price, 0, '', '.') . 'đ
                                </del>
                            </span>
                                ';
                } else {
                    $output .= '
                                <h5>
                                    ' . number_format($lap->price, 0, '', '.') . 'đ
                                </h5>
                                ';
                }

                $output .= '
                        </div>
    
                    </div>
                </div>
            </div>
                ';
            }
            $output .= '
            <div class="col-12">
                <nav>
                    <button id="load-product-lap-button" class="button cart-box col-4 mx-auto border-0" data-id=' . $last_id . '>Xem thêm</button>
                </nav>
            </div>
            ';
        } else {
            $output .= '
            <div class="col-12">
                <nav>
                    <button id="" class="button cart-box col-4 mx-auto border-0" style="background-color: black;">Dữ liệu đang cập nhật thêm ....</button>
                </nav>
            </div>
            ';
        }
        echo $output;
    }

    public function loadProductIpad(Request $request)
    {
        $data = $request->all();

        if ($data['id'] > 0) {
            $productIpad = Product::where('category_id', 3)->where('price_sale', '>', 0)->where('id', '<', $data['id'])->where('status', 1)->orderby('id', 'desc')->take(8)->get();
        } else {
            $productIpad = Product::where('category_id', 3)->where('price_sale', '>', 0)->where('status', 1)->orderby('id', 'desc')->take(8)->get();
        }

        $output = '';
        if (!$productIpad->isEmpty()) {
            foreach ($productIpad as $ipad) {
                $last_id = $ipad->id;
                $output .= '
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4" style="height: 414px">
    
                    <div class="product-img position-relative overflow-hidden" style="height:284px">
                        <img class="img-fluid w-100" src="' . asset('upload/product') . '/' . $ipad->image . ' "
                            alt="" style="padding: 30px">
                      
                            <div class="product-action">
    
                                <button type="button" class="btn btn-outline-dark btn-square" onclick="AddToCart(this.id)"
                                    id="' . $ipad->id . '" name="add-to-cart"><i
                                        class="fa fa-shopping-cart"></i></button>
    
                                <button type="button" class="btn btn-outline-dark btn-square add-to-wishlist"
                                    onclick="add_wishlist(this.id);" id="' . $ipad->id . '">
                                    <i class="far fa-heart">
                                    </i>
                                </button>
    
                                <button type="button" class="btn btn-outline-dark btn-square quickview"
                                    data-toggle="modal" data-target="#exampleModalCenter" 
                                    onclick="QuickView(this.id)"
                                    id="' . $ipad->id . '">
                                    <i class="fa fa-search"></i>
                                </button>
    
                            </div>
                          
                            <input type="hidden" value="' . $ipad->id . '"
                                class="cart_product_id_' . $ipad->id . '">
    
                            <input id="wishlist_name-' . $ipad->id . '" type="hidden" value="' . $ipad->name . '"
                                class="cart_product_name_' . $ipad->id . '">
    
                            <input id="wishlist_linkimage-' . $ipad->id . '" type="hidden"
                                value="' . $ipad->image . '" src="' . asset('upload/product') . '/' . $ipad->image . '"
                                class="cart_product_image_' . $ipad->id . '">
    
                            <input id="wishlist_image-' . $ipad->id . '" type="hidden" value="' . $ipad->image . '">
    
                            <input type="hidden" value="' . $ipad->price_sale . '"
                                class="cart_product_price_sale_' . $ipad->id . '">
    
                            <input type="hidden" value="' . $ipad->price . '"
                                class="cart_product_price_' . $ipad->id . '">
    
                            <input id="wishlist_price_sale-' . $ipad->id . '" type="hidden"
                                value="' . $ipad->price_sale . '">
    
                            <input id="wishlist_price-' . $ipad->id . '" type="hidden" value="' . $ipad->price . '">
    
                            <input type="hidden" value="1" class="cart_product_qty_' . $ipad->id . '">
                       
                    </div>
                    <div class="text-center py-4">
                        <a id="wishlist_id-' . $ipad->id . '"
                            class="h6 text-decoration-none text-truncate custom-name-product"
                            href="' . route('client.shop.detail', [$ipad->id]) . '">' . $ipad->name . '</a>
                        <div class="d-flex align-items-center justify-content-center mt-2">';

                if ($ipad->price_sale != 0) {
                    $output .= '
                                <h5 style="color: red">
                                ' . number_format($ipad->price_sale, 0, '', '.') . 'đ
                            </h5>
                            <span class="text-muted ml-2">
                                <del>
                                    ' . number_format($ipad->price, 0, '', '.') . 'đ
                                </del>
                            </span>
                                ';
                } else {
                    $output .= '
                                <h5>
                                    ' . number_format($ipad->price, 0, '', '.') . 'đ
                                </h5>
                                ';
                }

                $output .= '
                        </div>
    
                    </div>
                </div>
            </div>
                ';
            }
            $output .= '
            <div class="col-12">
                <nav>
                    <button id="load-product-ipad-button" class="button cart-box col-4 mx-auto border-0" data-id=' . $last_id . '>Xem thêm</button>
                </nav>
            </div>
            ';
        } else {
            $output .= '
            <div class="col-12">
                <nav>
                    <button id="" class="button cart-box col-4 mx-auto border-0" style="background-color: black;">Dữ liệu đang cập nhật thêm ....</button>
                </nav>
            </div>
            ';
        }
        echo $output;
    }
}
