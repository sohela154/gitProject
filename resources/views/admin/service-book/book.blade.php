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

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('bookServiceSubmit') }}" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$id}}">
            @csrf
            
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title card_title"><i class="fab fa-gg-circle"></i><b> Book Service</b></h4>
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
                <div class="form-group row mb-3 @error('details') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Write details about your program:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <textarea class="form-control" name="details" rows="3" cols="12" required>{{old('details')}}</textarea>
                    @error('details')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                <div class="form-group row mb-3 @error('date_time') is-invalid @enderror">
                    <label class="col-sm-3 col-form-label"><b>Program date & time:<span class="text-danger">*</span></b></label>
                    <div class="col-sm-6">
                    <input type="text" class="form-control" name="date_time" value="{{old('date_time')}}" required>
                    @error('date_time')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-md btn-dark">Book Service</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<script>

</script>
@endsection