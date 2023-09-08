<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductComment;
use Illuminate\Support\Facades\Validator;

class ShopDetail extends Controller
{
    public function shopDetail(Request $request, $id)
    {
        $shopId = Product::where('id', $id)->where('status', 1)->first();
        $shopGallery = ProductGallery::where('product_id', $id)->get();
        $meta_title = "MultiShop | $shopId->name ";
        $url_canonical = $request->url();
        //Sản phẩm tương tự
        $shopLq = Product::where('category_id', $shopId->productCategory->id)->where('brand_id', $shopId->productBrand->id)->where('status', 1)->whereNotIn('id', [$id])->get();
        return view('client.product_detail', compact('shopId', 'shopLq', 'meta_title', 'url_canonical', 'shopGallery'));
    }

    public function showComments(Request $request)
    {
        $sp_id = $request->product_id_comment;
        $comments = ProductComment::where('product_id', $sp_id)->orderBy('created_at', 'desc')->get();
        $shopId = Product::where('id', $sp_id)->where('status', 1)->first();
        $output = '';
        $output .= '
        <h4 class="mb-4">' . $comments->count() . ' đánh giá for "' . $shopId->name . '"</h4>
        ';
        foreach ($comments as $comment) {
            if (empty($comment->parent_id)) {
                $output .= '
            <div class="media mb-2">
            <img src="' .  asset('client/img/avatar-icon.png') . '" alt="Image"
                class="img-fluid mr-3 mt-1" style="width: 45px;">
            <div class="media-body">
                <h6>' . $comment->name . '<small> - <i>' . $comment->created_at . '</i></small></h6>
                <p>' . $comment->comment . '</p>
            </div>
        </div>
           ';
                foreach ($comments as $reply) {
                    if ($reply->parent_id === $comment->id) {
                        $output .= '
                        <div class="media mb-2" style="list-style-type: decimal;margin: 0px 40px;
                        background-color: #F5F5F5;">
                        <img src="' .  asset('client/img/avatar-admin.jpg') . '" alt="Image"
                            class="img-fluid mr-3 mt-1" style="width: 45px;">
                        <div class="media-body">
                            <h6>@Admin<small> - <i>' . $reply->created_at . '</i></small></h6>
                            <p>' . $reply->comment . '</p>
                        </div>
                    </div>
                       ';
                    }
                }
            }
        }



        echo $output;
    }
    public function addComments(Request $request)
    {
        $sp_id = $request->product_id_comment;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;

        $validator = Validator::make($request->all(), [
            'comment_name' => 'required',
            'comment_content' => 'required'
        ], [
            'comment_name.required' => 'Tên không được để trống !',
            'comment_content.required' =>  'Nội dung đánh giá không được để trống !',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }

        $comments = new ProductComment();
        $comments->product_id = $sp_id;
        $comments->name = $comment_name;
        $comments->comment =  $comment_content;
        $comments->status =  1;
        $comments->parent_id =  null;
        $comments->save();
        return response()->json([[1]]);
    }
}
