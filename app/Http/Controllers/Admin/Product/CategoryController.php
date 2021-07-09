<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Product\Category;
use Illuminate\Support\Facades\Storage;
use DB;
use Yajra\Datatables\Datatables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax()) {
            if(!empty($request->start_date) && !empty($request->end_date)) {
                $start_date = $request->start_date;
                $end_date = $request->end_date;
                if(($start_date) == ($end_date)){
                    $data = Category::select('*')->whereDate('created_at', '=', $start_date)->get()->toArray();
                }else{
                    $data = Category::select('*')->whereBetween('created_at', array($start_date, $end_date))->get()->toArray();
                }
            }
            foreach($data as $key => $value){
                $gender = $value['gender_product'];
                if(($gender) == 1){
                    $data[$key]['gender_product'] = 'Nam';
                }elseif(($gender) == 2){
                    $data[$key]['gender_product'] = 'Nữ';
                }

                $items = $value['items'];
                if(($items) == 1){
                    $data[$key]['items'] = 'Áo nam';
                }elseif(($items) == 2){
                    $data[$key]['items'] = 'Áo nữ';
                }elseif(($items) == 3){
                    $data[$key]['items'] = 'Quần nam';
                }elseif(($items) == 4){
                    $data[$key]['items'] = 'Quần nữ';
                }elseif(($items) == 5){
                    $data[$key]['items'] = 'Giày nam';
                }elseif(($items) == 6){
                    $data[$key]['items'] = 'Giày nữ';
                }elseif(($items) == 7){
                    $data[$key]['items'] = 'Phụ kiện nam';
                }elseif(($items) == 8){
                    $data[$key]['items'] = 'Phụ kiện nữ';
                }

                $status = $value['status'];
                if(($status) == 1){
                    $data[$key]['status'] = 'Đang hoạt động';
                }elseif(($status) == 2){
                    $data[$key]['status'] = 'Dừng hoạt động';
                }

            }
            // dd($data);
            return Datatables::of($data)->make(true);
        }
        return view('admin/pages/category.view-category');
    }

    public function insert(Request $request)
    {
        if(request()->ajax()){
            $request->validate([
                'gender' => 'required|min:1|max:2',
                'items' => 'required|min:1|max:8',
                'name_cate' => 'required'
            ]);
            $items = $request->items;
            $check = Category::select('name_cate')->where('name_cate', '=', $request->name_cate)->get()->toArray();
            if(($request->gender) == 1){
                if($items == 1 || $items == 3 || $items == 5 || $items == 7){
                    if(empty($check)){
                        Category::create([
                            'gender_product' => $request->gender,
                            'items' => $items,
                            'name_cate' => $request->name_cate,
                        ]);
                    }else{
                        echo 1;
                    }
                }
            }elseif(($request->gender) == 2){
                if($items == 2 || $items == 4 || $items == 6 || $items == 8){
                    if(empty($check)){
                        Category::create([
                            'gender_product' => $request->gender,
                            'items' => $items,
                            'name_cate' => $request->name_cate,
                        ]);
                    }else{
                        echo 1;
                    }
                }
            }
        }
    }

    public function destroy(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                Category::find($request->id)->delete();
            }
        }
    }

    public function edit(Request $request)
    {
        if(request()->ajax()){
            if(!empty($request->id) && is_numeric($request->id)){
                $category = Category::select('id', 'gender_product', 'items', 'name_cate', 'status')->where('id', '=', $request->id)->get()->toArray();
                return response()->json(['data' => $category]);
            }
        }
    }

    public function update(Request $request)
    {
        if(request()->ajax()){
            $request->validate([
                'id' => 'required|integer|min:1',
                'gender' => 'required|min:1|max:2',
                'items' => 'required|min:1|max:8',
                'name_cate' => 'required',
                'status' => 'required|min:1|max:2'
            ]);
            $items = $request->items;
            $check = Category::select('id', 'name_cate')->where('id', '=', $request->id)->get()->toArray();
            if($check[0]['name_cate'] == $request->name_cate){
                $category = Category::find($request->id);
                $category->gender_product = $request->gender;
                if(($request->gender) == 1){
                    if($items == 1 || $items == 3 || $items == 5 || $items == 7){
                        $category->items = $items;
                    }
                }elseif(($request->gender) == 2){
                    if($items == 2 || $items == 4 || $items == 6 || $items == 8){
                        $category->items = $items;
                    }
                }
                $category->name_cate = $request->name_cate;
                $category->status = $request->status;
                $category->save();
            }else{
                $checkName = Category::select('name_cate')->where('name_cate', '=', $request->name_cate)->where('id', '<>', $request->id)->get()->toArray();
                if(empty($checkName)){
                    $category = Category::find($request->id);
                    $category->gender_product = $request->gender;
                    if(($request->gender) == 1){
                        if($items == 1 || $items == 3 || $items == 5 || $items == 7){
                            $category->items = $items;
                        }
                    }elseif(($request->gender) == 2){
                        if($items == 2 || $items == 4 || $items == 6 || $items == 8){
                            $category->items = $items;
                        }
                    }
                    $category->name_cate = $request->name_cate;
                    $category->status = $request->status;
                    $category->save();
                }else{
                    echo 1;
                }
            }
        }
    }

}
