<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use App\Models\Product as Shop;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductGallery;

class Product extends Controller
{
    //Show sảm phẩm sản phẩm
    public function listProduct(Request $request)
    {
        $product = Shop::orderBy('created_at', 'desc')->get();
        $category = Category::all();
        $i = 1;
        return view('admin.list_Product', compact('product', 'category', 'i'));
    }

    //Thêm sảm phẩm sản phẩm
    public function createProduct()
    {
        $category = Category::all();
        $brands = Brand::all();

        return view('admin.add_product', compact('category', 'brands'));
    }
    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
            'percent' => 'required',
            'qty' => 'required',

        ], [
            'name.required' => 'Tên không được để trống !',
            'image.required' => 'Ảnh không được để trống !',
            'price.required' => 'Giá không được để trống !',
            'percent.required' => 'Giảm giá (%) không được để trống !',
            'desc.required' => 'Mô tả không được để trống !',
            'content.required' => 'Nội dung không được để trống !',
            'qty.required' => 'Số lượng không được để trống !',
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $data = array();
        $data['name'] = $request->name;
        $data['price'] = $request->price;
        $data['qty'] = $request->qty;
        $data['desc'] = $request->desc;
        $data['content'] = $request->content;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['status'] = $request->status;
        $data['created_at'] = now();

        if ($request->percent != 0) {
            $percent = $request->percent;
            $price = $request->price;
            $priceSale = (1 - ($percent / 100)) * $price;
            $data['price_sale'] = $priceSale;
            $data['percent'] = $percent;
        } else {
            $data['price_sale'] = 0;
            $data['percent'] = $request->percent;
        };
        $getImage =  $request->file('image');
        if ($getImage) {
            $getNameImg = $getImage->getClientOriginalName();
            $nameImage = current(explode('.', $getNameImg));
            $newImage = $nameImage . rand(0, 99) . '.' . $getImage->getClientOriginalExtension();
            $getImage->move('upload/product', $newImage);
            $data['image'] = $newImage;
            DB::table('product')->insert($data);
            Toastr::success('Thêm sản phẩm thành công!');
            return  response()->json([[1]]);
        }
    }

    //Cập nhật sảm phẩm sản phẩm
    public function editProduct($id)
    {
        $cate = Category::all();
        $brand = Brand::all();
        $editProduct = Shop::find($id);
        return view('admin.edit_Product', compact('editProduct', 'cate', 'brand'));
    }
    public function updateProduct(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'percent' => 'required',
            'qty' => 'required',
        ], [
            'name.required' => 'Tên không được để trống !',
            'price.required' => 'Giá không được để trống !',
            'percent.required' => 'Giảm giá (%) không được để trống !',
            'desc.required' => 'Mô tả không được để trống !',
            'content.required' => 'Nội dung không được để trống !',
            'qty.required' => 'Số lượng không được để trống !',
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        }
        $data = array();
        $data['name'] = $request->name;
        $data['price'] = $request->price;
        $data['qty'] = $request->qty;
        $data['desc'] = $request->desc;
        $data['content'] = $request->content;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['status'] = $request->status;
        $data['created_at'] = now();

        if ($request->percent != 0) {
            $percent = $request->percent;
            $price = $request->price;
            $priceSale = (1 - ($percent / 100)) * $price;
            $data['price_sale'] = $priceSale;
            $data['percent'] = $percent;
        } else {
            $data['price_sale'] = 0;
            $data['percent'] = $request->percent;
        };
        $getImage =  $request->file('image');
        if ($getImage) {
            $getNameImg = $getImage->getClientOriginalName();
            $nameImage = current(explode('.', $getNameImg));
            $newImage = $nameImage . rand(0, 99) . '.' . $getImage->getClientOriginalExtension();
            $getImage->move('upload/product', $newImage);
            $data['image'] = $newImage;
            DB::table('product')->where('id', $id)->update($data);
            Toastr::success('Cập nhật sản phẩm thành công!');
            return  response()->json([[1]]);
        } else {
            $getImgDb = Shop::find($id);
            $data['image'] = $getImgDb->image;
            DB::table('product')->where('id', $id)->update($data);
            Toastr::success('Cập nhật sản phẩm thành công!');
            return  response()->json([[1]]);
        }
    }
    //Xóa sảm phẩm sản phẩm
    public function deleteProduct($id)
    {
        $dlProduct = Shop::find($id);
        unlink('upload/product/' . $dlProduct->image);
        $dlProduct->delete();
        Toastr::success('Xóa sản phẩm thành công!');
        return back();
    }

    //Ẩn/Hiện sảm phẩm sản phẩm
    public function activeProduct($id)
    {
        DB::table('product')->where('id', $id)->update(['status' => 2]);
        Toastr::success('Đổi trạng thái ẩn thành công!');
        return back();
    }
    public function unActiveProduct($id)
    {
        DB::table('product')->where('id', $id)->update(['status' => 1]);
        Toastr::success('Đổi trạng thái hiển thị thành công!');
        return back();
    }

    // Thư viện ảnh
    public function productGallery($id)
    {
        $product_id = $id;
        $nameProduct = Shop::find($id);
        return view('admin.add_product_gallery', compact('product_id', 'nameProduct'));
    }
    public function selectGallery(Request $request)
    {
        $product_id = $request->input('product_id');
        $gallery = ProductGallery::where('product_id', $product_id)->get();
        $gallery_count = $gallery->count();

        $output = '
            <table class="table table-bordered table-striped verticle-middle" style="
            text-align: center;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
        ';
        if ($gallery_count > 0) {
            $i = 0;
            foreach ($gallery as $ga) {
                $i++;
                $output .= '
                <tr>
                <td>' . $i . '</td>
                <td>
                <img src=" ' . asset('upload/gallery') . '/' . $ga->image . '"
                alt="" style="width:108px">
                <div class="form-group mx-sm-3 mb-2 mt-3">
                    <input type="file" class="file_image" data-gallery_id="' . $ga->id . '" id="file-' . $ga->id . '" name="file" accept="image/*"/>
                </div>
                </td>
                <td>
                    <span>
                        <a href="' . route('admin.deleteGallery', [$ga->id]) . '" onclick="confirmation(event)"
                        data-gallery-id="' . $ga->id . '" class="delete-gallery"
                            data-toggle="tooltip" data-placement="top" title="Xóa">
                            <i class="fa fa-close color-danger"></i>
                        </a>
                    </span>
                </td>
            </tr>
                ';
            }
            $output .= '
            </tbody>
            </table>
            ';
        } else {
            $output .= '
            <tr>
                <td colspan="4">
                    <div class="alert alert-danger">Sản phẩm chưa thêm thư viện ảnh!</div>
                </td>
            </tr>
            ';
        }

        echo $output;
    }

    public function addGallery(Request $request, $id)
    {

        $getImage =  $request->file('image');
        if ($getImage) {
            foreach ($getImage as $image) {
                $getNameImg = $image->getClientOriginalName();
                $nameImage = current(explode('.', $getNameImg));
                $newImage = $nameImage . rand(0, 99) . '.' . $image->getClientOriginalExtension();
                $image->move('upload/gallery', $newImage);

                $gallery = new ProductGallery();
                $gallery->image = $newImage;
                $gallery->product_id = $id;
                $gallery->save();
            }
        }
        Toastr::success('Thêm thư viện ảnh thành công!');
        return redirect()->back();
    }
    public function updateGallery(Request $request)
    {

        $getImage =  $request->file('file');
        $gallery_id =  $request->gallery_id;
        if ($getImage) {
            $getNameImg = $getImage->getClientOriginalName();
            $nameImage = current(explode('.', $getNameImg));
            $newImage = $nameImage . rand(0, 99) . '.' . $getImage->getClientOriginalExtension();
            $getImage->move('upload/gallery', $newImage);

            $gallery =  ProductGallery::find($gallery_id);
            unlink('upload/gallery/' . $gallery->image);
            $gallery->image = $newImage;
            $gallery->save();
        }
    }

    public function deleteGallery($id)
    {

        $gallery = ProductGallery::find($id);
        unlink('upload/gallery/' . $gallery->image);
        $gallery->delete();
        Toastr::success('Xóa thư viện ảnh thành công!');
        return redirect()->back();
    }
}
