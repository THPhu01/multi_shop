<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use Brian2694\Toastr\Facades\Toastr;


class Delivery extends Controller
{
    public function delivery(Request $request)
    {
        $city = City::orderBy('matp', 'asc')->get();
        return view('admin.delivery', compact('city'));
    }
    public function selectDelivery(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $quanhuyen = Province::where('matp', $data['ma_id'])->get();
                $output .= '<option value=""> -- Chọn quận huyện --</option>';
                foreach ($quanhuyen as $quan) {
                    $output .= '<option value="' . $quan->maqh . '"> ' . $quan->name_quanhuyen . '</option>';
                }
            } else {
                $xaphuong = Wards::where('maqh', $data['ma_id'])->get();
                $output .= '<option value=""> -- Chọn xã phường --</option>';
                foreach ($xaphuong as $xa) {
                    $output .= '<option value="' . $xa->xaid . '"> ' . $xa->name_xaphuong . '</option>';
                }
            }
        }
        echo $output;
    }
    public function createDelivery(Request $request)
    {
        $data = $request->all();
        $feeship = new Feeship();
        $feeship->id_matp = $data['city'];
        $feeship->id_maqh = $data['quan'];
        $feeship->id_xa = $data['xa'];
        $feeship->feeship = $data['feeship'];
        Toastr::success('Thêm vận chuyển thành công!');
        $feeship->save();
    }

    public function showDelivery()
    {
        $feeship = Feeship::orderby('id', 'desc')->get();
        $i = 1;
        $output = '';
        $output .= ' <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Phí vận chuyển</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped verticle-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên thành phố</th>
                                    <th scope="col">Tên quận huyện</th>
                                    <th scope="col">Tên phường xã</th>
                                    <th scope="col">Phí vậ chuyện</th>
                                </tr>
                            </thead>
                            <tbody>';
        foreach ($feeship as $ship) {
            $output .= ' <tr>
                                        <td>' . $i++ . '</td>
                                        <td>' . $ship->city->name_city . '</td>
                                        <td>' . $ship->quanhuyen->name_quanhuyen . '</td>
                                        <td>' . $ship->phuongxa->name_xaphuong . '</td>
                                        <td contenteditable data-feeship_id="' . $ship->id . '" class="fee_feeship_edit" > 
                                        ' . number_format($ship->feeship, 0, '', '.') . '
                                        </td>
                                    </tr>';
        }
        $output .= ' </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>';
        echo $output;
    }
    public function updateDelivery(Request $request)
    {
        $data = $request->all();
        $feeship = Feeship::find($data['feeship_id']);
        $feeValue = str_replace('.', '', $data['fee_value']);
        $feeship->feeship = $feeValue;
        $feeship->save();
    }
}
