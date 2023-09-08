<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Models\Category as Cate;

class Category extends Controller
{
    //Show danh mục 
    public function listCategory()
    {
        $categorys = Cate::paginate(6);
        $i = 1;
        return view('admin.list_category', compact('categorys', 'i'));
    }

    //Thêm danh mục 
    public function createCategory()
    {
        
        return view('admin.add_category');
    }
    public function addCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Tên danh mục không được để trống !',
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $data = array();
        $data['name'] = $request->name;
        $data['status'] = $request->status;

        DB::table('category')->insert($data);
        Toastr::success('Thêm danh mục thành công!');
        return  response()->json([[1]]);
    }

    //Cập nhật danh mục 
    public function editCategory($id)
    {
        $editCategory = Cate::find($id);
        return view('admin.edit_category', compact('editCategory'));
    }
    public function updateCategory(Request $request, $id,)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Tên danh mục không được để trống !',
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $upCate = Cate::find($id);
        $upCate->name = $request->name;
        $upCate->save();
        Toastr::success('Cập nhật danh mục thành công!');
        return  response()->json([[1]]);
    }
    //Xóa danh mục 
    public function deleteCategory($id)
    {
        $dlCate = Cate::find($id);
        $dlCate->delete();
        Toastr::success('Xóa danh mục thành công!');
        return back();
    }

    //Ẩn/Hiện danh mục 
    public function activeCategory($id)
    {
        DB::table('category')->where('id', $id)->update(['status' => 2]);
        Toastr::success('Đổi trạng thái ẩn thành công!');
        return back();
    }
    public function unActiveCategory($id)
    {
        DB::table('category')->where('id', $id)->update(['status' => 1]);
        Toastr::success('Đổi trạng thái hiển thị thành công!');
        return back();
    }
}
