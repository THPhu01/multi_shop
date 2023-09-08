<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Models\Role as Roles;

class Role extends Controller
{
    //Show vai trò 
    public function listRole()
    {
        $roles = Roles::all();
        $i = 1;
        return view('admin.list_role', compact('roles', 'i'));
    }

    //Thêm vai trò 
    public function createRole()
    {
        return view('admin.add_role');
    }
    public function addRole(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'desc' => 'required',
        ], [
            'name.required' => 'Tên vai trò không được để trống !',
            'desc.required' => 'Mô tả vai trò không được để trống !',
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $data = array();
        $data['name'] = $request->name;
        $data['desc'] = $request->desc;

        DB::table('role')->insert($data);
        Toastr::success('Thêm vai trò thành công!');
        return  response()->json([[1]]);
    }

    //Cập nhật vai trò 
    public function editRole($id)
    {
        $editRole = Roles::find($id);
        return view('admin.edit_role', compact('editRole'));
    }
    public function updateRole(Request $request, $id,)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'desc' => 'required',
        ], [
            'name.required' => 'Tên vai trò không được để trống !',
            'desc.required' => 'Mô tả vai trò không được để trống !',
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $upRole = Roles::find($id);
        $upRole->name = $request->name;
        $upRole->desc = $request->desc;
        $upRole->save();
        Toastr::success('Cập nhật vai trò thành công!');
        return  response()->json([[1]]);
    }
    //Xóa vai trò 
    public function deleteRole($id)
    {
        $dlRole = Roles::find($id);
        $dlRole->delete();
        Toastr::success('Xóa vai trò thành công!');
        return back();
    }
}
