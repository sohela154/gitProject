@extends('layouts.admin.dashboard')
@section('contents')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title"><i class="fab fa-gg-circle"></i><b> View Service</b></h4>
                        </div>
                        <div class="col-md-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dt-responsive view_table">
                        <thead class="thead-dark">
                        </thead>
                        <tbody>
                        <tr>
                        <td><b>Service</b></td>
                        <td>:</td>
                        <td>{{$data->service_name}}</td>
                        </tr>
                        <tr>
                        <td><b>Category</b></td>
                        <td>:</td>
                        <td>{{$data->categoriesInfo->categories_name}}</td>
                        </tr>
                        <tr>
                        <td><b>Details</b></td>
                        <td>:</td>
                        <td>{{$data->service_details}}</td>
                        </tr>
                        <tr>
                        <td><b>Price</b></td>
                        <td>:</td>
                        <td>
                            @if($data->price!=NULL)
                                {{number_format($data->price)}}
                            @endif                            
                        </td>
                        </tr>
                        <tr>
                        <td><b>Type</b></td>
                        <td>:</td>
                        <td>{{$data->type}}</td>
                        </tr>
                        <tr>
                        <td><b>Photo</b></td>
                        <td>:</td>
                        <td><img src="{{asset('uploads/service/'.$data->service_img)}}" height="100px" width="160px"></td>
                        </tr>
                        <tr>
                        <td><b>Seating arrangement photo</b></td>
                        <td>:</td>
                        <td><img src="{{asset('uploads/service/'.$data->seating_img)}}" height="100px" width="160px"></td>
                        </tr>
                        <tr>
                        <td><b>Stage photo</b></td>
                        <td>:</td>
                        <td><img src="{{asset('uploads/service/'.$data->stage_img)}}" height="100px" width="160px"></td>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection