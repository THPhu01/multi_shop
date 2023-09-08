<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class MyAccount extends Controller
{
    public function myAccount(Request $request)
    {
        if (Auth::check()) {
            $meta_title = "MultiShop | Quản lí tài khoản ";
            $url_canonical = $request->url();

            $listOrders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(4);
            return view('client.my_account', compact('meta_title', 'url_canonical', 'listOrders'));
        }
        return redirect()->route('client.login')->with('msg', 'Bạn cần phần phải đăng nhập!');
    }

    public function myAccountInfo($id, Request $request)
    {
        $meta_title = "MultiShop | Quản lí tài khoản ";
        $url_canonical = $request->url();

        return view('client.info_myaccount', compact('meta_title', 'url_canonical'));
    }
    public function myAccountUpInfo($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
        ], [
            'name.required' => 'Tên không được để trống !',
            'phone.required' => 'Điện thoại không được để trống !',
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $up = User::find($id);

        $data = [
            'name' =>  $request->name,
            'phone' =>  $request->phone,
        ];

        if ($request->password_old) {
            $validator = Validator::make($request->all(), [
                'password_old' => 'required',
                'password_new' => 'required|min:6',
                'password_confirm' => 'same:password_new',
                'name' => 'required',
                'phone' => 'required',
            ], [
                'password_old.required' => 'Mật khẩu không được để trống !',
                'password_new.required' => 'Mật khẩu không được để trống !',
                'name.required' => 'Tên không được để trống !',
                'phone.required' => 'Điện thoại không được để trống !',

                'password_new.min' => 'Mật khẩu phải trên :min !',
                'password_confirm.same' => 'Mật khẩu không trùng hợp với mật khẩu mới !',
            ]);
            if (!$validator->passes()) {
                return response()->json([
                    'status' => 0,
                    'error' => $validator->errors()->toArray()
                ]);
            }
            $user = Auth::user();
            if (!Hash::check($request->password_old, $user->password)) {
                return response()->json([
                    'password_old' => 'Mật khẩu cũ không đúng, vui lòng xem lại'
                ]);
            }

            $data = [
                'password' =>  bcrypt($request->password_new),
                'name' =>  $request->name,
                'phone' =>  $request->phone,
            ];
        }

        $up->update($data);
        Toastr::success('Cập thông tin thành công!');
        return  response()->json([[1]]);
    }

    public function orderDetailMyAccount(Request $request, $id)
    {
        $i = 1;
        $order = Order::find($id);
        $orderDetail = OrderDetail::where('order_id', $id)->get();
        // dd($orderDetail);
        return view('client.order_detail_myAccount', compact('order', 'orderDetail', 'i'));
    }
    public function myAccountCancelOrder(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->cancel_order = $request->cancel;
        $order->status = $request->status;
        $order->save();
    }
}
