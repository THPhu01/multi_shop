<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductGallery;
use App\Models\Slider;
use App\Models\ProductComment;
use Illuminate\Support\Facades\DB;


class Shop extends Controller
{


    public function shopCategory(Request $request, $id)
    {
        $nameCate = Category::where('id', $id)->first();
        $imgSlider = Slider::where('category_id', $id)->where('status', 1)->get();
        $products = Product::where('category_id', $id)->where('status', 1)->sort()->orderby('created_at', 'desc')->get();
        $productAll = Product::where('category_id', $id)->where('status', 1)->get();

        $url_canonical = $request->url();
        $meta_title = "MultiShop | $nameCate->name ";

        $getNameBrand = $productAll->unique('brand_id')->pluck('brand_id');
        $brandAll = Brand::whereIn('id', $getNameBrand)->get();

        if (isset($request->brand)) {
            $brand = $request->brand;
            $imgSlider = Slider::where('category_id', $id)->where('status', 1)->get();
            $products = Product::where('brand_id', $brand)->where('category_id', $id)->where('status', 1)->sort()->orderby('created_at', 'desc')->get();
            return view('client.product', compact('products', 'nameCate', 'brandAll', 'meta_title', 'url_canonical', 'imgSlider'));
        }
        return view('client.product', compact('products', 'nameCate', 'brandAll', 'meta_title', 'url_canonical', 'imgSlider'));
    }

    public function shopCheck(Request $request)
    {
        $price = $request->input('price');
        $brands = $request->input('brands');
        $category_id = $request->input('category_id');

        $query = Product::query();
        $nameCate = Category::where('id', $category_id)->first();
        $product = Product::where('category_id', $category_id)->where('status', 1)->get();
        $productAll = Product::where('category_id', $category_id)->where('status', 1)->get();
        $getNameBrand = $productAll->unique('brand_id')->pluck('brand_id');
        $brandAll = Brand::whereIn('id', $getNameBrand)->get();



        if (!empty($price)) {
            $priceRanges = [];

            foreach ($price as $range) {
                $rangeValues = explode('-', $range);
                if (count($rangeValues) === 2) {
                    $minPrice = (int)$rangeValues[0];
                    $maxPrice = (int)$rangeValues[1];

                    if ($minPrice >= 0 && $maxPrice > $minPrice) {
                        $priceRanges[] = [$minPrice, $maxPrice];
                    }
                } elseif ($range === '13000000') {
                    $priceRanges[] = [13000000, 999999999];
                } elseif ($range === '25000000') {
                    $priceRanges[] = [25000000, 999999999];
                } elseif ($range === '2000000') {
                    $priceRanges[] = [1, 2000000];
                } elseif ($range === '10000000') {
                    $priceRanges[] = [1, 10000000];
                }
            }
            // if (!empty($priceRanges)) {
            //     $query->where(function ($query) use ($priceRanges) {
            //         foreach ($priceRanges as $range) {
            //                 $query->orWhereBetween('price', $range);       
            //         }
            //     });
            // }
            if (!empty($priceRanges)) {
                $query->where(function ($query) use ($priceRanges) {
                    $query->orWhere(function ($query) use ($priceRanges) {
                        foreach ($priceRanges as $range) {
                            $query->orWhereBetween('price', $range);
                            $query->orWhereBetween('price_sale', $range);
                        }
                    });
                });
            }
        }


        if (!empty($brands)) {
            $query->whereIn('brand_id', $brands);
        }
        $query->where('category_id', $category_id)->sort()->orderBy('price', 'asc');

        $products = $query->get();
        if (empty($price) && empty($brands)) {
            $products = Product::where('category_id', $category_id)->where('status', 1)->sort()->orderby('created_at', 'desc')->get();
            response()->json($products);
            return view('client.product_check', compact('products', 'nameCate', 'brandAll'));
        }
        response()->json($products);
        return view('client.product_check', compact('products', 'nameCate', 'brandAll'));
    }

    public function shopSearch(Request $request)
    {
        if ($request->search) {
            $output = '';
            $product = Product::where('status', 1)->where('name', 'LIKE', '%' . $request->search . '%')->get();
            if (count($product) > 0) {
                $output = '
                    <ul class="items-search-ul" style="padding-left:0px">
                ';

                foreach ($product as $sp) {
                    $output .= '
                        <li class="item-search">
                            <a class="item-image" href="' . route('client.shop.detail', [$sp->id]) . '">
                                <img src="' .  asset('upload/product') . '/' . $sp->image  . '" style="width:70px">
                            </a>

                            <div class="item-content">
                                <a href="' . route('client.shop.detail', [$sp->id]) . '" title="' . $sp->name . '">
                                    <span>' . $sp->name . '</span>
                                </a>
                                <div class="d-flex align-items-center mt-1" style="font-size:15px">
                                ';
                    if ($sp->price_sale) {
                        $output .= '
                                        <span style="color: red;">
                                        ' . number_format($sp->price_sale, 0, '', '.') . 'đ
                                        </span>
                                        <span class="text-muted ml-2">
                                            <del>
                                            ' . number_format($sp->price, 0, '', '.') . 'đ
                                            </del>
                                        </span>';
                    } else {
                        $output .= '
                        <span class="text-muted ml-2">
                        ' . number_format($sp->price, 0, '', '.') . 'đ
                        
                    </span>';
                    }
                    $output .= '
                                </div>
                            </div>
                        </li>
                    ';
                }
                $output .= '
                </ul>
            ';
            } else {
                $output .= '
                <li class="item-search"><a>Sản phẩm không tồn tại</a></li>
            ';
            }

            echo $output;
        }
    }

    public function quickView(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $gallery = ProductGallery::where('product_id', $product_id)->get();

        $output['product_gallery'] = '';
        foreach ($gallery as $gl) {
            $output['product_gallery'] = '<img class="w-100 h-100" src="' .  asset('upload/gallery') . '/' . $gl->image  . '">';
        }
        $output['product_id'] = $product->id;
        $output['product_name'] = $product->name;
        if ($product->price_sale > 0) {
            $output['product_price_sale'] = ' <span style="color: red;">
                                        ' . number_format($product->price_sale, 0, '', '.') . 'đ
                                        </span>
                                        <span class="text-muted ml-2">
                                            <del>
                                            ' . number_format($product->price, 0, '', '.') . 'đ
                                            </del>
                                        </span>';
        } else {
            $output['product_price'] = ' <span class="text-muted ml-2">
            ' . number_format($product->price, 0, '', '.') . 'đ
            
        </span>';
        }
        $output['product_desc'] = $product->desc;
        $output['product_image'] = '<img class="w-100 h-100" src="' .  asset('upload/product') . '/' . $product->image  . '">';

        echo json_encode($output);
    }
}
