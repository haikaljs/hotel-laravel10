@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Manage Teams</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">All Teams</li>
                </ol>
            </nav>
        </div>
       
        <div class="ms-auto">
            <a href="{{ route('add.team') }}" class="btn btn-outline-primary px-5 radius-30">Add Team</a>
        </div>
    </div>
    <!--end breadcrumb-->
    
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
                            <td><img src="{{ asset($item->image) }}" alt="" width="90px;" height="60px;"></td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->position }}</td>
                            <td>{{ $item->facebook }}</td>
                            <td>
                                <a href="{{ route('team.edit', $item->id) }}" class="btn btn-sm px-3 btn-warning radius-30">Edit</a>
                                <a id="delete" href="{{ route('delete.team', $item->id) }}" class="btn btn-sm px-3 btn-danger radius-30">Delete</a>
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