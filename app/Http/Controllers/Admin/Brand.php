<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand as Brands;

class Brand extends Controller
{
    //Show danh mục 
    public function listBrand()
    {
        $brands = Brands::paginate(6);
        $i = 1;
        return view('admin.list_brand', compact('brands', 'i'));
    }

    //Thêm danh mục 
    public function createBrand()
    {
        return view('admin.add_brand');
    }
    public function addBrand(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
        ], [
            'name.required' => 'Tên không được để trống !',
            'image.required' => 'Ảnh không được để trống !',
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $data = [];
        $data['name'] = $request->name;
        $data['status'] = $request->status;
        $getImage =  $request->file('image');
        if ($getImage) {
            $getNameImg = $getImage->getClientOriginalName();
            $nameImage = current(explode('.', $getNameImg));
            $newImage = $nameImage . rand(0, 99) . '.' . $getImage->getClientOriginalExtension();
            $getImage->move('upload/brand', $newImage);
            $data['image'] = $newImage;
            DB::table('brand')->insert($data);
            Toastr::success('Thêm thương hiệu thành công!');
            return  response()->json([[1]]);
        }
    }

    //Cập nhật danh mục 
    public function editBrand($id)
    {
        $editBrand = Brands::find($id);
        return view('admin.edit_brand', compact('editBrand'));
    }
    public function updateBrand(Request $request, $id,)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Tên thương hiệu không được để trống !',
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $data = array();
        $data['name'] = $request->name;
        $getImage =  $request->file('image');
        if ($getImage) {
            $getNameImg = $getImage->getClientOriginalName();
            $nameImage = current(explode('.', $getNameImg));
            $newImage = $nameImage . rand(0, 99) . '.' . $getImage->getClientOriginalExtension();
            $getImage->move('upload/brand', $newImage);
            $data['image'] = $newImage;
            DB::table('brand')->where('id', $id)->update($data);
            Toastr::success('Cập nhật thương hiệu thành công!');
            return  response()->json([[1]]);
        } else {
            $getImgDb = Brands::find($id);
            $data['image'] = $getImgDb->image;
            DB::table('brand')->where('id', $id)->update($data);
            Toastr::success('Cập nhật thương hiệu thành công!');
            return  response()->json([[1]]);
        }
    }
    //Xóa danh mục 
    public function deleteBrand($id)
    {
        $dlBrand = Brands::find($id);
        unlink('upload/brand/' . $dlBrand->image);
        $dlBrand->delete();
        Toastr::success('Xóa thương hiệu thành công !');
        return back();
    }

    //Ẩn/Hiện danh mục 
    public function activeBrand($id)
    {
        DB::table('brand')->where('id', $id)->update(['status' => 2]);
        Toastr::success('Đổi trạng thái ẩn thành công!');
        return back();
    }
    public function unActiveBrand($id)
    {
        DB::table('brand')->where('id', $id)->update(['status' => 1]);
        Toastr::success('Đổi trạng thái hiển thị thành công!');
        return back();
    }
}
