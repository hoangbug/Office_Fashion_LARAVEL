<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductRequest;
use Validator;
use Illuminate\Support\Facades\Storage;
use DB;
use Yajra\Datatables\Datatables;

use App\Models\Admin\Product\Product;
use App\Models\Admin\Product\Category;
use App\Models\Admin\Product\Brand;
use App\Models\Admin\Product\DetailImage;
use App\Models\Admin\Product\DetailSize;
use App\Models\User\ShoppingCart\OrderDetail;

class ProductController extends Controller
{
    public function index(Request $request){
        $category = Category::all();
        $brand = Brand::all();
        if(request()->ajax()) {
            if(!empty($request->start_date) && !empty($request->end_date)) {
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                if(($start_date) == ($end_date)){
                    $data = Product::select('id', 'name', 'main_image', 'price', 'sale', 'views', 'status')->whereDate('created_at', '=', $start_date)->get()->toArray();
                }else{
                    $data = Product::select('id', 'name', 'main_image', 'price', 'sale', 'views', 'status')->whereBetween('created_at', array($start_date, $end_date))->get()->toArray();
                }
            }
            // dd($data);
            foreach($data as $key => $value){
                $status = $value['status'];
                if(($status) == 1){
                    $data[$key]['status'] = 'Sản phẩm mới';
                }elseif(($status) == 2){
                    $data[$key]['status'] = 'Đang bán';
                }elseif(($status) == 3){
                    $data[$key]['status'] = 'Bán chạy nhất';
                }elseif(($status) == 4){
                    $data[$key]['status'] = 'Giảm giá sốc';
                }elseif(($status) == 5){
                    $data[$key]['status'] = 'Đã hết hàng';
                }
            }
            return Datatables::of($data)->make(true);
        }

        return view('admin/pages/product.view-product',[
            'category' => $category,
            'brand' => $brand
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'brand_id' => 'required',
            'name' => 'required|min:10|max:150',
            'main_image' => 'required|image|mimes:jpeg,png,jpg',
            'price' => 'required|min:0|regex:/^\d+(,\d{3})*(\.\d{1,3})?$/'
        ]);

        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image')->hashName();
            Storage::putFile('public/images/product', $request->file('main_image'));

            $product = new Product;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->name = $request->name;
            $product->main_image = $image;
            $product->price = $request->price;
            $product->description = $request->description;

            $product->save();
        }
    }

    public function show(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $data = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->join('brands', 'products.brand_id', '=', 'brands.id')->select('products.id', 'products.name', 'categories.name_cate', 'brands.name_brand', 'products.main_image', 'products.price', 'products.description', 'products.sale', 'products.views', 'products.status', 'products.created_at', 'products.updated_at')->where('products.id', '=', $request->id)->get()->toArray();
                // dd($data[0]->main_image);
                return view('admin/pages/product.detail-product', [
                    'data' => $data,
                ]);
            }
        }
    }

    public function edit(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $id = $request->id;
                $category = Category::select('id', 'name_cate')->get()->toArray();
                $brand = Brand::select('id', 'name_brand')->get()->toArray();

                $product = Product::select('*')->where('id', '=', $id)->get()->toArray();

                $checkItems = DB::table('products')->join('categories', 'products.category_id', '=', 'categories.id')->select('items')->where('products.id', '=', $id)->get()->toArray();

                $checkSize = DB::table('detail_sizes')->join('products', 'detail_sizes.product_id', '=', 'products.id')->select('detail_sizes.id', 'detail_sizes.product_id', 'detail_sizes.name_size', 'detail_sizes.quantity')->where('products.id', '=', $id)->get()->toArray();

                $checkImage = DB::table('detail_images')->join('products', 'detail_images.product_id', '=', 'products.id')->select('detail_images.id', 'detail_images.product_id', 'detail_images.sub_image')->where('products.id', '=', $id)->get()->toArray();

                return view('admin/pages/product.update-product', [
                    'data' => $product,
                    'category' => $category,
                    'brand' => $brand,
                    'checkItems' => $checkItems,
                    'select_detail' => $checkSize,
                    'image_detail' => $checkImage,
                ]);
            }
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'category_id' => 'required',
            'brand_id' => 'required',
            'name_product' => 'required|min:10|max:150',
            'main_image' => 'image|mimes:jpeg,png,jpg',
            'image_old' => 'required',
            'price' => 'required|min:0|regex:/^\d+(,\d{3})*(\.\d{1,3})?$/',
            'sale' => 'required|min:0|max:100',
            'description' => 'required',
            'status' => 'required|min:0',
            'name_size' => 'required',
            'quantity' => 'required|min:0',
        ]);
        $id = $request->id;
        $name_size = explode(',', $request->name_size);
        $quantity = explode(',', $request->quantity);
        var_dump($quantity);

        $product = Product::find($id);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name_product;
        if ($request->hasFile('main_image')) {
            $image = $request->file('main_image')->hashName();
            Storage::putFile('public/images/product', $request->file('main_image'));
            $product->main_image = $image;

            $path = 'storage/images/product/' . $request->image_old;
            if (file_exists($path)) {
                unlink($path);
            }
        }
        $product->price = $request->price;
        $product->description = $request->description;
        $product->sale = $request->sale;
        $product->status = $request->status;
        $product->save();

        //* product size
        $check = DB::table('detail_sizes')->join('products', 'detail_sizes.product_id', '=', 'products.id')->select('detail_sizes.id', 'detail_sizes.product_id')->where('products.id', '=', $id)->get()->toArray();
        if (empty($check)) {
            for ($i = 0; $i < count($name_size); $i++) {
                $detail_size = new DetailSize;
                $detail_size->product_id = $id;
                $detail_size->name_size = $name_size[$i];
                $detail_size->quantity = $quantity[$i];
                $detail_size->save();
            }
        } else {
            for ($i = 0; $i < count($check); $i++) {
                $detail_size = DetailSize::find($check[$i]->id);
                $detail_size->product_id = $id;
                $detail_size->name_size = $name_size[$i];
                $detail_size->quantity = $quantity[$i];
                $detail_size->save();
            }
        }

        //* product image
        $checkImage = DB::table('detail_images')->join('products', 'detail_images.product_id', '=', 'products.id')->select('detail_images.id', 'detail_images.product_id', 'detail_images.sub_image')->where('products.id', '=', $id)->get()->toArray();
        if ($request->hasFile('sub_image')) {
            if (empty($checkImage)) {
                $image = $request->file('sub_image');
                $des_path = 'public/images/product';
                foreach ($image as $photo) {
                    $main_image = time() . '_' . rand() . '_' . $image[0]->getClientOriginalName();
                    $photo->storeAs($des_path, $main_image);
                    $data[] = $main_image;
                }
                for ($i = 0; $i < count($request->sub_image); $i++) {
                    $detail_image = new DetailImage;
                    $detail_image->product_id = $id;
                    $detail_image->sub_image = $data[$i];
                    $detail_image->save();
                }
            } else {
                $image = $request->file('sub_image');
                $des_path = 'public/images/product';
                foreach ($image as $photo) {
                    $main_image = time() . '_' . rand() . '_' . $image[0]->getClientOriginalName();
                    $photo->storeAs($des_path, $main_image);
                    $data[] = $main_image;
                }
                for ($i = 0; $i < count($request->sub_image); $i++) {
                    $detail_image = DetailImage::find($checkImage[$i]->id);
                    $detail_image->product_id = $id;
                    $detail_image->sub_image = $data[$i];
                    $detail_image->save();

                    $path_delete = 'storage/images/product/' . $checkImage[$i]->sub_image;
                    if (file_exists($path_delete)) {
                        unlink($path_delete);
                    }
                }
            }
        }
    }

    public function destroy(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $id = $request->id;
                $product = Product::select('main_image')->where('id', '=', $id)->get()->toArray();
                $des_path = 'storage/images/product/' . $product[0]['main_image'];
                if (file_exists($des_path)) {
                    unlink($des_path);
                }
                $checkImage = DB::table('detail_images')->join('products', 'detail_images.product_id', '=', 'products.id')->select('detail_images.sub_image')->where('products.id', '=', $id)->get()->toArray();
                for ($i = 0; $i < count($checkImage); $i++) {
                    $path_delete = 'storage/images/product/' . $checkImage[$i]->sub_image;
                    if (file_exists($path_delete)) {
                        unlink($path_delete);
                    }
                }
                Product::find($id)->delete();
            }
        }
    }


}
