<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductComment;
use Illuminate\Support\Facades\Auth;

class Comment extends Controller
{
    //Show vai trò 
    public function listComment()
    {
        $comments = ProductComment::orderBy('created_at', 'desc')->get();
        $i = 1;
        return view('admin.list_comment', compact('comments', 'i'));
    }

    public function updateComment(Request $request, $id,)
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
        $upRole = ProductComment::find($id);
        $upRole->name = $request->name;
        $upRole->desc = $request->desc;
        $upRole->save();
        Toastr::success('Cập nhật vai trò thành công!');
        return  response()->json([[1]]);
    }
    public function replyComment(Request $request)
    {
        $comment = new ProductComment;
        $comment->name = Auth::user()->name;
        $comment->product_id = $request->comment_product_id;
        $comment->comment = $request->comment_content;
        $comment->status = 2;
        $comment->parent_id = $request->comment_id;
        $comment->save();

        $commentId = ProductComment::find($request->comment_id);
        $commentId->status = 2;
        $commentId->save();

        Toastr::success('Phản hồi bình luận thành công!');
        return back();
    }

    //Xóa vai trò 
    public function deleteComment($id)
    {
        $dlComment = ProductComment::find($id);
        $dlComment->delete();
        Toastr::success('Xóa bình luận thành công!');
        return back();
    }
}
