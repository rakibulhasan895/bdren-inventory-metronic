<?php

namespace App\Http\Controllers\backend\v1;

use App\Http\Controllers\Controller;
use App\DataTables\BrandsDataTable;
use App\Models\Brand;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(BrandsDataTable $dataTable)
    {
        $brands = Brand::orderBy('id', 'desc')->get();
        return $dataTable->render('pages.brands.list', compact('brands'));
    }


    public function brandStore(Request $req)
    {
        $validated =  $req->validate([
            'code' => 'required|unique:brands',
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        try {

            if ($req->file('image')) {

                $manager = new ImageManager(new Driver());

                $name_gen = hexdec(uniqid()) . '.' . $req->file('image')->getClientOriginalExtension();

                $img = $manager->read($req->file('image'));

                $img = $img->resize(370, 246);

                // $img->toJpeg(80)->save(base_path('public/upload/brand/' . $name_gen));
                $save_url = $req->file('image')->storeAs('public/brands', $name_gen);
                // $save_url = 'upload/brand/' . $name_gen;

            }
            $brand = new Brand();
            $brand->code = $req->code;
            $brand->name = $req->name;
            $brand->description = $req->description;
            $brand->added_by = Auth::user()->id;
            $brand->avatar = $save_url;
            $brand->save();

            return redirect(route('brand.index'))->with('success', 'Brand Created Successfully!');
        } catch (\Exception $e) {
            return redirect(route('brand.index'))->withInput()->with('error', 'Something Went Wrong! Please try again!');
        }
    }

    public function brandUpdate(Request $req, $id)
    {
        $validated =  $req->validate([
            'code' => 'required|unique:brands',
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        try {

            if ($req->file('image')) {

                $manager = new ImageManager(new Driver());

                $name_gen = hexdec(uniqid()) . '.' . $req->file('image')->getClientOriginalExtension();

                $img = $manager->read($req->file('image'));

                $img = $img->resize(370, 246);

                // $img->toJpeg(80)->save(base_path('public/upload/brand/' . $name_gen));
                $save_url = $req->file('image')->storeAs('public/brands', $name_gen);
                // $save_url = 'upload/brand/' . $name_gen;

            }
            $brand = new Brand();
            $brand->code = $req->code;
            $brand->name = $req->name;
            $brand->description = $req->description;
            $brand->added_by = Auth::user()->id;
            $brand->avatar = $save_url;
            $brand->save();

            return redirect(route('brand.index'))->with('success', 'Brand Created Successfully!');
        } catch (\Exception $e) {
            return redirect(route('brand.index'))->withInput()->with('error', 'Something Went Wrong! Please try again!');
        }
    }
}
