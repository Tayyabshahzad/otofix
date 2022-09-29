@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
    Customers
@endsection
@section('content')
<div class="content-wrapper" style="width: 83%!important">
    <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<h4 class="page-title">Customers</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Customers</li>
							</ol>
						</nav>
					</div>

				</div>
                <a href="{{ route('admin.user.create')}}" class="btn btn-info btn-sm no-radius">Add Customers</a>
                &nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-primary btn-sm no-radius">Download CSV</button>
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="box">
						<div class="box-body">
							<div class="table-responsive rounded card-table">
								<table class="table border-no" id="categories">
									<thead>
										<tr>
											<th>#</th>
											<th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Registered At</th>
                                            <th>Email Status</th>
                                            <th>Status</th>
											<th>Photo</th>
											<th>Role</th>
											<th>Action</th>
										</tr>
									</thead>
									 <tbody>
                                        @foreach ($users as $user )
                                            <tr class="hover-primary">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->cc }}{{ $user->phone }}</td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>@if($user->email_verified_at != null) <span class="text-success"> Verified </span>   @else  <span class="text-danger"> Not Verified </span>  @endif</td>
                                                <td>{{ ucfirst($user->status) }}</td>
                                                <td> <img src="{{$user->getFirstMediaUrl('profile_photo','thumb'),}}" alt="" class="w-40 h-40 me-10 rounded100"> </td>
                                                <td>{{ ucfirst($user->roles->pluck('name')->implode(',')) }}   </span> </td>
                                                <td>
                                                    <div class="btn-group">
                                                    <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('admin.customers.edit',$user->id) }}">Edit</a>
                                                        <a class="dropdown-item " href="#"  onclick="deleteCat({{ $user->id }})">Delete</a>
                                                    </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                     </tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- /.content -->

	  </div>
</div>
@endsection
@section('footer')
@endsection
@section('page_js')
        <script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
        <script src="{{ asset('assets/js/order.js') }}"></script>
        <script>
            $(function () {
            'use strict';
                $('#categories').DataTable({
                    'paging'      : true,
                    'lengthChange': false,
                    'searching'   : false,
                    'ordering'    : true,
                    'info'        : true,
                    'autoWidth'   : false
                });
            });

        </script>
@endsection
