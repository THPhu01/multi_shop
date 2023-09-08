<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class Orders extends Controller
{
    //Show đơn hàng
    public function listOrders(Request $request)
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(6);
        $i = 1;

        return view('admin.orders', compact('orders', 'i'));
    }
    public function orderDetail(Request $request, $id)
    {
        $i = 1;
        $order = Order::find($id);
        $orderDetail = OrderDetail::where('order_id', $id)->get();
        // dd($orderDetail);
        return view('admin.order_detail', compact('order', 'orderDetail', 'i'));
    }
    public function deleteOrder(Request $request, $id)
    {
        $orderDetail = OrderDetail::where('order_id', $id)->get();
        foreach($orderDetail as $detail ) {
            $detail->delete();
        }

        $dlOrder = Order::find($id);
        $dlOrder->delete();


        Toastr::success('Xóa đơn hàng thành công !');
        return back();
    }
    public function deleteOrderDetail(Request $request, $id)
    {
        $dlOrder = OrderDetail::find($id);
        $dlOrder->delete();
        Toastr::success('Xóa chi tiết đơn hàng thành công !');
        return back();
    }

    public function updateQtyStatusOrderDetail(Request $request)
    {
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->status = $data['order_status'];
        $order->save();

        if ($order->status == 3) {
            foreach ($data['product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_qty = $product->qty;
                $product_sold = $product->sold;

                foreach ($data['qty'] as $key2 => $qty) {

                    if ($key == $key2) {
                        $product_remain = $product_qty - $qty;
                        $product->qty = $product_remain;
                        $product->sold = $product_sold + $qty;
                        $product->save();
                    }
                }
            }
        }
        Toastr::success('Cập nhật trạng thái thành công !');
    }
    public function updateQtyOrderDetail(Request $request)
    {
        $data = $request->all();
        $order_detail = OrderDetail::where('product_id', $data['product_id'])->where('order_id', $data['order_id'])->first();
        $order_detail->qty = $data['product_qty'];
        $order_detail->save();

        //Cập nhật tổng tiền đơn hàng tổng
        $order_detail_total = OrderDetail::where('order_id', $data['order_id'])->get();
        $newTotal = 0;
        foreach ($order_detail_total as $sp) {
            $subtotal = $sp->price * $sp->qty;
            $newTotal += $subtotal;
        }
        $order_total = Order::find($data['order_id']);
        $order_total->total = $newTotal;
        $order_total->save();

        $newTotalOrder =  $data['order_feeship'] + $newTotal;
        return response()->json([
            'product_id' => $data['product_id'],
            'total' => $data['total'],
            'order_detail_total' => $newTotal,
            'order_id' => $data['order_id'],
            'order_total' => $newTotalOrder,

        ]);
    }
}
