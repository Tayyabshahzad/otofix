@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
    Worlshop Edit
@endsection
@section('content')
<div class="content-wrapper" style="width: 83%!important">
    <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<h4 class="page-title">Workshop</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item"><a href="{{ route('admin.workshop') }}">Workshops</a></li>
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
						  <h4 class="box-title">Edit Workshop</h4>
						</div>
						<!-- /.box-header -->
						<form class="form" method="post" action="{{ route('admin.workshop.update')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="workshop_id" value="{{ $workshop->id }}">
                            <input type="hidden" name="user_id" value="{{ $workshop->user->id }}">
							<div class="box-body">
								<hr class="my-15">
								<div class="row">
								  <div class="col-md-3">
									<div class="form-group">
									  <label class="form-label">First Name</label>
									  <input type="text" class="form-control no-radius" placeholder="First Name" name="first_name" value="{{ $workshop->user->name}}" >
									</div>
								  </div>

                                  <div class="col-md-3">
									<div class="form-group">
									  <label class="form-label">Workshop Name</label>
									  <input type="text" class="form-control no-radius" placeholder="Workshop Name" name="workshop_name" value="{{ $workshop->name }}" >
									</div>
								  </div>

                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Email</label>
									  <input type="email" class="form-control no-radius" disabled value="{{ $workshop->user->email }}" >
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
                                      <input type="number" class="form-control no-radius" placeholder="Phone number without country code" name="phone"  value="{{ $workshop->user->phone }}">
									</div>
								  </div>

                                  <div class="col-md-2">
									<div class="form-group">
									  <label class="form-label">Icon  </label> <br>
									  <img src="{{$workshop->getFirstMediaUrl('workshop_photo','thumb'),}}" alt="" class="w-40 h-40 me-10 rounded100">
									</div>
								  </div>

                                  <div class="col-md-4">
									<div class="form-group">
									  <label class="form-label">Icon <span class="text-danger">*</span></label>
									  <input type="file" class="form-control no-radius" name="photo" >
									</div>
								  </div>

                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Franchise Status</label>
                                      <select class="form-control no-radius" name="status">
                                        <option value="active"selected > Active</option>
                                        <option value="inactive"  >In Active</option>
                                    </select>
									</div>
								  </div>


                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Address</label>
                                      <input type="text" class="form-control no-radius" placeholder="Google Address" name="address" value="{{ $workshop->address }}" required>
									</div>
								  </div>

                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Password</label>
                                      <input type="password" class="form-control no-radius" placeholder="Enter new password" name="password" >
									</div>
								  </div>

                                  <input type="hidden" name="lat" required value="{{ $workshop->lat }}">
                                  <input type="hidden" name="lng" required value="{{ $workshop->lng }}">
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
