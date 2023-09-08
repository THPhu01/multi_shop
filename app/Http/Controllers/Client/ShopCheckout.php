<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Symfony\Component\Console\Output\Output;

class ShopCheckout extends Controller
{
    public function checkout(Request $request)
    {
        if (Auth::check()) {
            $meta_title = "MultiShop | Thanh Toán ";
            $url_canonical = $request->url();
            $city = City::orderby('matp', 'desc')->get();
            return view('client.checkout', compact('city', 'meta_title', 'url_canonical'));
        }
        return redirect()->route('client.login')->with('msg', 'Bạn cần phần phải đăng nhập!');
    }
    public function ordersNotification(Request $request)
    {
        $meta_title = "MultiShop | Thanh Toán thành công ";
        $url_canonical = $request->url();
        return view('client.orderNotification', compact('meta_title', 'url_canonical'));
    }
    public function orders(Request $request)
    {
        $city = City::where('matp', $request->city)->pluck('name_city')->first();
        $quanhuyen = Province::where('maqh', $request->quan)->pluck('name_quanhuyen')->first();
        $xaphuong = Wards::where('xaid', $request->xa)->pluck('name_xaphuong')->first();

        $address = $request->address;

        $address = $city . ', ' . $quanhuyen . ', ' . $xaphuong . ', ' . $address;
        $data = array();
        $data['user_id'] = $request->user_id;
        $data['full_name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['address'] = $address;
        $data['note'] = $request->note;
        $data['total'] = $request->total;
        $data['feeship'] = $request->feeship;
        $data['status'] = 1;
        $data['payment'] = $request->payment;
        $data['created_at'] = now();
        $orderId = DB::table('orders')->insertGetId($data);

        //order_details
        $product = Cart::content();
        foreach ($product as $product) {
            $data = array();
            $data['order_id'] = $orderId;
            $data['product_id'] = $product->id;
            $data['name'] = $product->name;
            $data['price'] = $product->price;
            $data['qty'] = $product->qty;
            $data['created_at'] = now();
            DB::table('order_details')->insert($data);
        }
        Cart::destroy();
        Toastr::success('Thanh toán thành công!');
    }
    public function selectDeliveryClient(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $quanhuyen = Province::where('matp', $data['ma_id'])->get();
                $output .= '<option value=""> -- Chọn Quận/Huyện --</option>';
                foreach ($quanhuyen as $quan) {
                    $output .= '<option value="' . $quan->maqh . '"> ' . $quan->name_quanhuyen . '</option>';
                }
            } else {
                $xaphuong = Wards::where('maqh', $data['ma_id'])->get();
                $output .= '<option value=""> -- Chọn Phường/Xã --</option>';
                foreach ($xaphuong as $xa) {
                    $output .= '<option value="' . $xa->xaid . '"> ' . $xa->name_xaphuong . '</option>';
                }
            }
        }
        echo $output;
    }
    public function priceDelivery(Request $request)
    {
        // $data = $request->all();
        $free = Feeship::where('id_matp', $request->city)->first();
        $output = '';
        if ($free) {
            $output = $free->feeship;
        } else {
            $output = 175000;
        }
        return $output;
    }
  
}
