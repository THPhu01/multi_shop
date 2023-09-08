<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Models\Slider as Sliders;
use App\Models\Category;

class Slider extends Controller
{
    //Show danh mục 
    public function listSlider()
    {
        $sliders = Sliders::paginate(6);
        $i = 1;
        return view('admin.list_slider', compact('sliders', 'i'));
    }

    //Thêm danh mục 
    public function createSlider()
    {
        $category = Category::all();
        return view('admin.add_slider', compact('category'));
    }
    public function addSlider(Request $request)
    {
        $data = [];
        $data['category_id'] = $request->category_id;
        $data['status'] = $request->status;
        $getImage =  $request->file('image');
        if ($getImage) {
            $getNameImg = $getImage->getClientOriginalName();
            $nameImage = current(explode('.', $getNameImg));
            $newImage = $nameImage . rand(0, 99) . '.' . $getImage->getClientOriginalExtension();
            $getImage->move('upload/slider', $newImage);
            $data['image'] = $newImage;
            DB::table('slider')->insert($data);
            Toastr::success('Thêm Slider thành công!');
            return redirect()->route('admin.listSlider');
        }
    }

    //Cập nhật danh mục 
    public function editSlider($id)
    {
        $editSlider = Sliders::find($id);
        $category = Category::all();
        return view('admin.edit_slider', compact('editSlider', 'category'));
    }
    public function updateSlider(Request $request, $id,)
    {
        $data = array();
        $data['category_id'] = $request->category_id;
        $getImage =  $request->file('image');
        if ($getImage) {
            $getNameImg = $getImage->getClientOriginalName();
            $nameImage = current(explode('.', $getNameImg));
            $newImage = $nameImage . rand(0, 99) . '.' . $getImage->getClientOriginalExtension();
            $getImage->move('upload/slider', $newImage);
            $data['image'] = $newImage;
            DB::table('slider')->where('id', $id)->update($data);
            Toastr::success('Cập nhật slider thành công!');
            return redirect()->route('admin.listSlider');
        } else {
            $getImgDb = Sliders::find($id);
            $data['image'] = $getImgDb->image;
            DB::table('slider')->where('id', $id)->update($data);
            Toastr::success('Cập nhật slider thành công!');
            return redirect()->route('admin.listSlider');
        }
    }
    //Xóa danh mục 
    public function deleteSlider($id)
    {
        $dlSlider = Sliders::find($id);
        unlink('upload/slider/' . $dlSlider->image);
        $dlSlider->delete();
        Toastr::success('Xóa Slider thành công !');
        return back();
    }

    //Ẩn/Hiện danh mục 
    public function activeSlider($id)
    {
        DB::table('slider')->where('id', $id)->update(['status' => 2]);
        Toastr::success('Đổi trạng thái ẩn thành công!');
        return back();
    }
    public function unActiveSlider($id)
    {
        DB::table('slider')->where('id', $id)->update(['status' => 1]);
        Toastr::success('Đổi trạng thái hiển thị thành công!');
        return back();
    }
}
