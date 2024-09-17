@extends('layouts.admin.dashboard')
@section('contents')
@if(Session::has('error'))
<script>
Swal.fire({
    position: 'top-end',
    icon: 'error',
    text: '{{Session::get('error')}}',
    toast: 'true',
    showConfirmButton: false,
    timer: '5000',
})
</script>
@endif
@php
    $allcategories = App\Models\Category::orderBy('categories_id', 'DESC')->get();
    $allType = ['Basic', 'Standard', 'Premium'];
@endphp
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('update_service') }}" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i><b> Edit Service</b></h4>
                        </div>
                        <div class="col-md-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-7">
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <input type="hidden" name="id" value="{{$allData->service_id}}">
                <input type="hidden" name="slug" value="{{$allData->service_slug}}">
                <div class="form-group row mb-3 @error('name') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>service:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="{{$allData->service_name}}" required>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('categories_id') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Category:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <select class="form-control" name="categories_id" id="categories_id" required>
                        <option value="">Select categories</option>
                        @foreach($allcategories as $data)
                        <option value="{{$data->categories_id}}" @if($data->categories_id==$allData->category_id) selected="selected" @endif>{{$data->categories_name}}</option>
                        @endforeach
                    </select>
                    @error('categories_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('type') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Type:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <select class="form-control" name="type" id="type" required>
                        <option value="">Select type</option>
                        @foreach($allType as $data)
                        <option value="{{$data}}" @if($data==$allData->type) selected="selected" @endif>{{$data}}</option>
                        @endforeach
                    </select>
                    @error('type')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('details') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Details:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <textarea class="form-control" name="details" rows="3" cols="12" required>{{$allData->service_details}}</textarea>
                    @error('details')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('price') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Price:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <input type="number" class="form-control" name="price" value="{{$allData->price}}">
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('photo') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Photo:</b></label>
                    <div class="col-sm-6">
                    <input type="file" onchange="readURL(this);" class="form-control" name="photo" value="{{$allData->service_photo}}">
                    @error('photo')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br>
                    <img id="service_photo_preview" src="#" alt=""/>
                    </div>
                </div>
                <div class="form-group row mb-3 @error('seating_img') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Seating arrangement photo:<span class="text-danger"></span></b></label>
                    <div class="col-sm-6">
                    <input type="file" onchange="readURL(this);" class="form-control" name="seating_img" value="{{old('seating_img')}}">
                    @error('seating_img')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br>
                    <img id="service_seating_img_preview" src="#" alt=""/>
                    </div>
                </div>
                <div class="form-group row mb-3 @error('stage_img') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Stage photo:<span class="text-danger"></span></b></label>
                    <div class="col-sm-6">
                    <input type="file" onchange="readURL(this);" class="form-control" name="stage_img" value="{{old('stage_img')}}">
                    @error('stage_img')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <br>
                    <img id="service_stage_img_preview" src="#" alt=""/>
                    </div>
                </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-md btn-dark">Edit service</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection