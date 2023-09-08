<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User as Users;
use App\Models\User_role;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class User extends Controller
{
    public function listUser()
    {
        $users = Users::paginate(6);
        $roles = Role::all();
        $i = 1;
        return view('admin.list_user', compact('users', 'roles', 'i'));
    }
    public function updateRoleUser(Request $request)
    {
        if (Auth::id() == $request->user_id) {
            Toastr::success('Không được phân quyền chính mình!');
            return redirect()->back();
        }
        $user = Users::where('email', $request->email)->first();
        $user->roles()->detach();
        if ($request->admin_role) {
            $user->roles()->attach(Role::where('name', 'Admin')->first());
        }
        if ($request->author_role) {
            $user->roles()->attach(Role::where('name', 'Author')->first());
        }
        if ($request->guest_role) {
            $user->roles()->attach(Role::where('name', 'Guest')->first());
        }
        Toastr::success('Cấp quyền thành công!');
        return redirect()->back();
    }
    //Xóa vai trò 
    public function deleteUser($id)
    {
        if (Auth::id() == $id) {
            Toastr::success('Không được quyền xóa chính mình!');
            return redirect()->back();
        }
        $dlUser = Users::find($id);
        if ($dlUser) {
            $dlUser->roles()->detach();
            $dlUser->delete();
        }
        Toastr::success('Xóa User thành công!');
        return back();
    }
}
