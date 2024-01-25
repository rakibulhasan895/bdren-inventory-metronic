<?php

namespace App\Http\Controllers\backend\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\DataTables\ProductDataTable;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ModelSystem;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(ProductDataTable $dataTable)
    {
        $brands = Brand::orderBy('id', 'desc')->get();
        $models = ModelSystem::orderBy('id', 'desc')->get();
        $categories = Category::orderBy('id', 'desc')->get();
        $products = Product::orderBy('id', 'desc')->get();
        return $dataTable->render('pages.products.list', compact('products','brands','models','categories'));
    }

    
    public function productStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'asset_code' => 'required|unique:products',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',

        ]);
        // try {

        if ($request->file('image')) {

            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();

            $img = $manager->read($request->file('image'));

            $img = $img->resize(370, 246);
            $save_url = $request->file('image')->storeAs('public/products', $name_gen);
        }

        $product = new Product();
        $product->brand_id = $request->brand_id;
        $product->model_id = $request->model_id;
        $product->category_id = $request->category_id;
        $product->added_by = Auth::user()->id;
        $product->code  = $request->code;
        $product->name  = $request->name;
        $product->description = $request->description;
        $product->avatar = $save_url;
        $product->asset_code = $request->asset_code;
        $product->consumable = $request->consumable;
        $product->save();
        return redirect(route('product.index'))->with('success', 'Product Created Successfully!');
        // } catch (\Exception $e) {
        //     return redirect(route('product.index'))->withInput()->with('error', 'Something Went Wrong! Please try again!');
        // }
    }
}
