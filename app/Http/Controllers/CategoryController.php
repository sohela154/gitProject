<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use Carbon\Carbon;
use Session;


class CategoryController extends Controller{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index(){
        $all = Category::orderBy('categories_id', 'DESC')->get();
        return view('admin.category.all',compact('all'));
    }

    public function add(){
        return view('admin.category.add');
    }

    public function edit($slug){
        $data = Category::where('categories_slug', $slug)->first();
        return view('admin.category.edit',compact('data'));
    }
    
    public function submit(Request $request){
        $this->validate($request,[
            'name'=>'required|max:255|unique:categories,categories_name',
        ],[
            'name.required'=>'category name is required.',
            'name.max'=>'This category name must not be greater than 255 characters.',
            'name.unique'=>'This category name has already been taken.',
        ]);
        $slug = Str::slug($request->name, '-');
        
        $insert = Category::insert([
            'categories_name'=>$request->name,
            'categories_slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        
        if($insert){
            Session::flash('success','Category successfully added!');
            return redirect()->route('all_category');
        }else{
            Session::flash('error','Category addtion process failed!');
        
            return redirect()->route('add_category');
        }
    }

    public function update(Request $request){

        $id = $request->id;
        $this->validate($request,[
            'name'=>'required|max:255|unique:categories,categories_name,'.$id.',categories_id',
        ],[
            'name.required'=>'Category name is required.',
            'name.max'=>'This category name must not be greater than 255 characters.',
            'name.unique'=>'This category name has already been taken.',
        ]);
        $slug = Str::slug($request->name, '-');
        $update = Category::where('categories_id',$id)->update([
            'categories_name'=>$request->name,
            'categories_slug'=>$slug,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($update){
            Session::flash('success','Category name successfully edited!');
            
            return redirect()->route('all_category');
        }else{
            Session::flash('error','Category name edit process failed!');
            return redirect()->route('edit_category');
        }
    }
}
