@extends('layouts.admin.dashboard')
@section('contents')
@if(Session::has('success'))
<script>
Swal.fire({
    position: 'top-end',
    icon: 'success',
    text: '{{Session::get('success')}}',
    toast: 'true',
    showConfirmButton: false,
    timer: '5000',
})
</script>
@endif
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
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="card-title"><i class="fab fa-gg-circle"></i><b> All Services</b></h4>
                        </div>
                        <div class="col-md-4 text-right">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="alltableinfo" class="table table-bordered table-striped table-hover dt-responsive">
                        <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Service</th>
                            <th>Category</th>
                            <th>Details</th>
                            <th>Price</th>
                            <th>Type</th>
                            <th>Photo</th>
                            <th>Manage</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $c=1;
                        @endphp
                        @foreach($all as $data)
                        <tr>
                            <td>{{$c++}}</td>
                            <td>{{$data->service_name}}</td>
                            <td>{{$data->categoriesInfo->categories_name}}</td>
                            <td>{{Str::limit($data->service_details, 18, '...')}}</td>
                            <td>{{$data->price}}</td>
                            <td>{{$data->type}}</td>
                            <td><img src="{{asset('uploads/service/'.$data->service_img)}}" height="45px" width="71px"></td>
                            <td>
                                <a href="{{ route('view_service', ['slug' => $data->service_slug]) }}" title="View"><i class="fas fa-plus-square text-dark"></i></a>
                                <a href="{{ route('edit_service', ['slug' => $data->service_slug]) }}" title="Edit"><i class="fas fa-pen-square text-dark"></i></a>
                                <a id="delete" data-toggle="modal" data-target="#deleteModal" data-id="{{$data->service_id}}" title="Delete"><i class="fas fa-trash-alt text-dark"></i></a>
                            </td>
                        </tr>
                        @endforeach
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

<!-- delete modal start -->
<div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post" action="{{ route('delete_service') }}">
      @csrf
      <div class="modal-content">
        <div class="modal-header modal_header">
            <h5 class="modal-title mt-0" id="myModalLabel"><i class="fab fa-gg-circle"></i> Confirm Message</h5>
        </div>
        <div class="modal-body modal_card">
          Are you want to delete this service?
          <input type="hidden" id="modal_id" name="modal_id">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-md btn-dark waves-effect waves-light">Confirm</button>
            <button type="button" class="btn btn-md btn-danger waves-effect" data-dismiss="modal">Close</button>
        </div>
    </div>
    </form>
</div>
</div>
@endsection