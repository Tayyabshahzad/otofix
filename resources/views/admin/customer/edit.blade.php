@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
    Customer Edit
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
								<li class="breadcrumb-item"><a href="{{ route('admin.customers') }}">Customers</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<!-- Main content -->
        <section class="content">
            <div class="row">
				<div class="col-lg-12 col-12">
					  <div class="box">
						<div class="box-header with-border">
						  <h4 class="box-title">Edit User</h4>
						</div>
						<!-- /.box-header -->
						<form class="form" method="post" action="{{ route('admin.customer.update')}}" enctype="multipart/form-data">
                            @csrf
							<div class="box-body">
								<hr class="my-15">
								<div class="row">
								  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Name</label>
                                      <input type="hidden" name="id" value="{{ $user->id }}">
									  <input type="text" class="form-control no-radius" placeholder="Name" name="name" required value="{{ $user->name}}">
									</div>
								  </div>

                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Email</label>
									  <input type="text" class="form-control no-radius" placeholder="Email"  disabled required value="{{ $user->email}}">
									</div>
								  </div>

                                  <div class="col-md-2">
									<div class="form-group">
									  <label class="form-label">Country Code</label>
                                      <select class="form-control no-radius" name="cc">
                                        <option value="+91">+91</option>
                                        <option value="+92">+92</option>
                                    </select>
									</div>
								  </div>

                                  <div class="col-md-10">
									<div class="form-group">
									  <label class="form-label">Phone</label>
                                      <input type="number" class="form-control no-radius" placeholder="Phone number without country code" name="phone" value="{{ $user->phone}}">
									</div>
								  </div>

                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Icon</label><br>
                                      <img src="{{$user->getFirstMediaUrl('profile_photo','thumb'),}}" alt="" class="w-40 h-40 me-10 rounded100">
									</div>
								  </div>

                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Icon</label>
									  <input type="file" class="form-control no-radius" name="photo" >
									</div>
								  </div>

                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Status</label>
                                      <select class="form-control no-radius" name="status">
                                        <option value="active" @if($user->status == 'active') selected @endif> Active</option>
                                        <option value="inactive" @if($user->status == 'inactive') selected @endif >In Active</option>
                                    </select>
									</div>
								  </div>
                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Email Status</label>
                                      <select class="form-control no-radius" name="email_status">
                                        <option value="verified" @if($user->email_verified_at != null) selected @endif> Verified</option>
                                        <option value="not_verified" @if($user->email_verified_at == null) selected @endif >Not Verified</option>
                                    </select>
									</div>
								  </div>

                                  <div class="col-md-12">
									<div class="form-group">
									  <label class="form-label">Password</label>
                                      <input type="password" class="form-control no-radius" placeholder="Enter new password" name="password" value="{{old('phone')}}">
									</div>
								  </div>





								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">

								<button type="submit" class="btn btn-primary btn-sm no-radius">
								  <i class="ti-save-alt"></i> Update
								</button>
							</div>
						</form>

					  </div>
					  <!-- /.box -->
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

@endsection
