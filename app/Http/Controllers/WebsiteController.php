<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Session;
use Image;
use File;
use Auth;
use App\Models\Service;
use App\Models\ServiceRequest;
use App\Models\User;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\CustomerMail;

class WebsiteController extends Controller{
    public function index(){
        $all = Service::orderBy('service_id', 'DESC')->get();
        return view('website.index',compact('all'));
    }

    public function bookService($id){
        return view('admin.service-book.book', compact('id'));
    }

    public function bookServiceSubmit(Request $request){
        $this->validate($request,[
            'details'=>'required',
            'date_time'=>'required',
        ],[
            'details.required'=>'Service details is required.',
            'date_time.required'=>'Program date & time is required.',
        ]);

        $customerId = Auth::user()->id;
        $insertID = ServiceRequest::insertGetId([
            'service_id'=>$request->id,
            'status'=>"Pending",
            'details'=>$request->details,
            'date_time'=>$request->date_time,
            'requested_by'=>$customerId,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        $customerId = Auth::user()->id;
        $all = ServiceRequest::orderBy('service_id', 'DESC')->where('requested_by', $customerId)->get();
        return view('admin.service-book.customer-book-info',compact('all'));
    }

    public function customerBook(){
        $customerId = Auth::user()->id;
        $all = ServiceRequest::orderBy('service_id', 'DESC')->where('requested_by', $customerId)->get();
        return view('admin.service-book.customer-book-info',compact('all'));
    }

    public function allBook(){
        $all = ServiceRequest::orderBy('service_id', 'DESC')->get();
        return view('admin.service-book.all-book-info',compact('all'));
    }

    public function confirm_booking(Request $request){
        $booked = ServiceRequest::where('id', $request->modal_id)->update([
            'status'=>"Booked",
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        $requestedBy = ServiceRequest::where('id', $request->modal_id)->first();
        $allData = User::where('id', $requestedBy->requested_by)->first();
        try{
            Mail::to($allData->email)->send(new CustomerMail());
            Session::flash('success','Email sent successfully!');
            //return redirect()->route('allBook');
        }
        catch (\Exception $e) {
            Session::flash('error','Email sending failed!');
            //return redirect()->route('allBook');
        }
        
        if($booked){
            Session::flash('success','Booking request successfully confirmed!');
            return redirect()->route('allBook');
        }else{
            Session::flash('error','Booking request confirmation process failed!');
            return redirect()->route('allBook');
        }
    }

    public function view($id){
        $data = Service::where('service_id', $id)->first();
        $allReview = Review::where('service_id', $id)->get();
		return view('website.view-service', compact('data', 'allReview'));
    }

    public function reviewSubmit(Request $request){
        $this->validate($request,[
            'review'=>'required',
        ],[
            'review.required'=>'Review is required.',
        ]);
    
        $service_id = $request->service_id;
        $customerId = Auth::user()->id;
        $insertID = Review::insertGetId([
            'service_id'=>$request->service_id,
            'review'=>$request->review,
            'reviewed_by'=>$customerId,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        
        if($insertID){
            Session::flash('success','Review successfully added!');
            return redirect()->route('web_view_service', ['id' => $service_id]);
        }else{
            Session::flash('error','Review addition failed!');
            return redirect()->route('view_service', ['id' => $service_id]);
        }
    }

}