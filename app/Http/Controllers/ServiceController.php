<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\ServiceRequest;
use Carbon\Carbon;
use Session;
use Image;
use File;
use Auth;

class ServiceController extends Controller{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }
    
    public function index(){
        $all = Service::orderBy('service_id', 'DESC')->get();
        return view('admin.service.all',compact('all'));
    }

    public function add(){
        return view('admin.service.add');
    }

    public function edit($slug){
        $allData = Service::where('service_slug', $slug)->first();
        return view('admin.service.edit', compact('allData'));
    }

    public function view($slug){
        $data = Service::where('service_slug', $slug)->first();
		return view('admin.service.view', compact('data'));
    }

    public function submit(Request $request){
        $categories_id = $request->categories_id;
        
        $this->validate($request,[
            'categories_id'=>'required',
            'details'=>'required',
            'price'=>'required',
            'type'=>'required',
            'photo' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
            'stage_img' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
            'seating_img' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
            'name'=>'required|max:255|unique:services,service_name',
        ],[
            'name.required'=>'Service name is required.',
            'name.max'=>'This service name must not be greater than 255 characters.',
            'name.unique'=>'This service name has already been taken.',
            'categories_id.required'=>'Category name is required.',
            'details.required'=>'Service details is required.',
            'price.required'=>'Service price is required.',
            'type.required'=>'Service type is required.',
            'photo.image'=>'This file must be an image.',
            'photo.required'=>'Service photo is required.',
            'stage_img.image'=>'This file must be an image.',
            'stage_img.required'=>'Stage photo is required.',
            'seating_img.image'=>'This file must be an image.',
            'seating_img.required'=>'Seating photo is required.',
        ]);
        $slug = "service".uniqid();
    
        $insertID = Service::insertGetId([
            'service_name'=>$request->name,
            'category_id'=>$request->categories_id,
            'service_details'=>$request->details,
            'price'=>$request->price,
            'type'=>$request->type,
            'service_slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($request->hasFile('photo')){
            $image1=$request->file('photo');
            $imageName1='service_'.$insertID.'_'.time().'.'.$image1->getClientOriginalExtension();
            Image::make($image1)->resize(200,200)->save('uploads/service/'.$imageName1);
            Service::where('service_id',$insertID)->update([
              'service_img'=>$imageName1,
            ]);
        }
        if($request->hasFile('seating_img')){
            $image2=$request->file('seating_img');
            $imageName2='seating_img_'.$insertID.'_'.time().'.'.$image2->getClientOriginalExtension();
            Image::make($image2)->resize(200,200)->save('uploads/service/'.$imageName2);
            Service::where('service_id',$insertID)->update([
              'seating_img'=>$imageName2,
            ]);
        }
        if($request->hasFile('stage_img')){
            $image3=$request->file('stage_img');
            $imageName3='service_stage_img_'.$insertID.'_'.time().'.'.$image3->getClientOriginalExtension();
            Image::make($image3)->resize(200,200)->save('uploads/service/'.$imageName3);
            Service::where('service_id',$insertID)->update([
              'stage_img'=>$imageName3,
            ]);
        }  
        if($insertID){
            Session::flash('success','Service successfully added!');
            return redirect()->route('all_service');
        }else{
            Session::flash('error','Service addition failed!');
            return redirect()->route('add_service');
        }
    }

    public function update(Request $request){
        $service_id = $request->id;
        $this->validate($request,[
            'name'=>'required|max:255|unique:services,service_name,'.$service_id.',service_id',
            'categories_id'=>'required',
            'details'=>'required',
            'price'=>'required',
            'type'=>'required',
            //'photo' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
            //'stage_img' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
            //'seating_img' => 'image|required|mimes:jpeg,png,jpg,gif,svg',
            //'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=500,max_height=500', // (2048kb max size limit)
        ],[
            'name.required'=>'Service name is required.',
            'name.max'=>'This service name must not be greater than 255 characters.',
            'name.unique'=>'This service name has already been taken.',
            'categories_id.required'=>'categories name is required.',
            'details.required'=>'Service details is required.',
            'price.required'=>'Service price is required.',
            'type.required'=>'Service type is required.',
            'photo.image'=>'This file must be an image.',
            'photo.required'=>'Service photo is required.',
            'stage_img.image'=>'This file must be an image.',
            'stage_img.required'=>'Stage photo is required.',
            'seating_img.image'=>'This file must be an image.',
            'seating_img.required'=>'Seating photo is required.',
        ]);
        $update = Service::where('service_id', $service_id)->update([
            'service_name'=>$request->name,
            'category_id'=>$request->categories_id,
            'service_details'=>$request->details,
            'price'=>$request->price,
            'type'=>$request->type,
            //'service_slug'=>$slug,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($request->hasFile('photo')){
            $image1=$request->file('photo');
            $imageName1='service_'.$service_id.'_'.time().'.'.$image1->getClientOriginalExtension();
            Image::make($image1)->resize(200,200)->save('uploads/service/'.$imageName1);
            Service::where('service_id',$service_id)->update([
              'service_img'=>$imageName1,
            ]);
        }
        if($request->hasFile('seating_img')){
            $image2=$request->file('seating_img');
            $imageName2='seating_img_'.$service_id.'_'.time().'.'.$image2->getClientOriginalExtension();
            Image::make($image2)->resize(200,200)->save('uploads/service/'.$imageName2);
            Service::where('service_id',$service_id)->update([
              'seating_img'=>$imageName2,
            ]);
        }
        if($request->hasFile('stage_img')){
            $image3=$request->file('stage_img');
            $imageName3='service_stage_img_'.$service_id.'_'.time().'.'.$image3->getClientOriginalExtension();
            Image::make($image3)->resize(200,200)->save('uploads/service/'.$imageName3);
            Service::where('service_id',$service_id)->update([
              'stage_img'=>$imageName3,
            ]);
        } 
        if($update){
            Session::flash('success','service successfully updated!');
            return redirect()->route('all_service');
        }else{
            Session::flash('error','service edit process failed!');
            return redirect()->route('edit_service');
        }
    }
    
    public function delete(Request $request){
        $service = Service::where('service_id', $request->modal_id)->first();
        $path = 'uploads/service/'.$service->service_photo;
        if(File::exists($path)){
            File::delete($path);
        } 
        $delete = Service::where('service_id', $request->modal_id)->delete();
        if($delete){
            Session::flash('success','Service successfully deleted!');
            return redirect()->route('all_service');
        }else{
            Session::flash('error','Service delete process failed!');
            return redirect()->route('all_service');
        }
    }

}
