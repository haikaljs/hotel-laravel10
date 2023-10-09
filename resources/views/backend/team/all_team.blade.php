@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        
       
        <div class="ms-auto">
            <button type="button" class="btn btn-outline-primary px-5 radius-30">Add Team</button>
        </div>
    </div>
    <!--end breadcrumb-->
    <h6 class="mb-0 text-uppercase">All Team</h6>
    <hr/>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Facebook</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($team as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td><img src="{{ asset($item->image) }}" alt="" width="70px; height:40px;"></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->position }}</td>
                            <td>{{ $item->facebook }}</td>
                            <td>
                                <a href="#" class="btn btn-success">Edit</a>
                                <a href="#" class="btn btn-primary">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    
                   
                    </tbody>
                 
                </table>
            </div>
        </div>
    </div>
   
</div>
@endsection