<?php

namespace App\Http\Controllers\backend\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ModelDataTable;
use App\Models\ModelSystem;
use Illuminate\Support\Facades\Auth;

class ModelController extends Controller
{
    public function index(ModelDataTable $dataTable)
    {
        $models = ModelSystem::orderBy('id', 'desc')->get();
        return $dataTable->render('pages.models.list', compact('models'));
    }

    public function modelStore(Request $req)
    {
        $validated =  $req->validate([
            'code' => 'required|unique:model_systems',
            'name' => 'required',
        ]);
        try {
            $model = new ModelSystem();
            $model->code = $req->code;
            $model->name = $req->name;
            $model->description = $req->description;
            $model->added_by = Auth::user()->id;
            $model->save();
            return redirect(route('model.index'))->with('success', 'Model Created Successfully!');
        } catch (\Exception $e) {
            return redirect(route('model.index'))->withInput()->with('error', 'Something Went Wrong! Please try again!');
        }
    }

}
