<?php

namespace App\Http\Controllers\backend\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\CategoryDataTable;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $dataTable)
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return $dataTable->render('pages.categories.list', compact('categories'));
    }

    public function categoryStore(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:categories',
            'name' => 'required',

        ]);
        // try {
            $category = new Category();
            $category->added_by = Auth::user()->id;
            $category->code  = $request->code;
            $category->name  = $request->name;
            $category->parents  = $request->parents;
            $category->description = $request->description;
            $category->save();
            return redirect(route('category.index'))->with('success', 'Category Created Successfully!');
        // } catch (\Exception $e) {
        //     return redirect(route('category.index'))->withInput()->with('error', 'Something Went Wrong! Please try again!');
        // }
    }
}
