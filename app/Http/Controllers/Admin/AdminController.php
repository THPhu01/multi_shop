<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\ProductComment;
use App\Models\Order;

class AdminController extends Controller
{
    public function index()
    {
        $product = Product::all();
        $totalSold = 0;
        foreach ($product as $productSold) {
            $productSold = $productSold->sold;
            $totalSold += $productSold;
        }

        $totalQty = 0;
        foreach ($product as $productQty) {
            $productQty = $productQty->qty;
            $totalQty += $productQty;
        }
        $order = Order::all();
        $totalPriceOrder = 0;
        foreach ($order as $productPriceOrder) {
            $productPriceOrder = $productPriceOrder->total;
            $totalPriceOrder += $productPriceOrder;
        }

        $comment = ProductComment::where('parent_id', NULL)->get();
        $commentFeedback = ProductComment::where('status', 1)->get();
        $commentReply = ProductComment::where('status', 2)->where('parent_id', NULL)->get();

        // Đơn hàng
        // 1.Đang xử lí 2.Đang vận chuyển 3.Giao thành công 4. Hủy
        $order1 = Order::where('status', 1)->get();
        $order2 = Order::where('status', 2)->get();
        $order3 = Order::where('status', 3)->get();
        $order4 = Order::where('status', 4)->get();


        return view('admin.index', compact('totalQty', 'totalSold', 'comment', 'commentFeedback', 'commentReply', 'totalPriceOrder', 'order1', 'order2', 'order3', 'order4'));
    }
    public function viewLogin()
    {
        return view('admin.login');
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
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect()->route('admin.viewLogin');
    }
}
