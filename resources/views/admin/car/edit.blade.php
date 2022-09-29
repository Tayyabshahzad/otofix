@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
        Service Create
@endsection
@section('content')
<div class="content-wrapper" style="width: 83%!important">
    <div class="container-full">
        <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<h4 class="page-title">Cars</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item"><a href="{{ route('admin.car')}}"> Car </a> </li>
                                <li class="breadcrumb-item active " aria-current="page">Create</li>
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
						  <h4 class="box-title">Create Car</h4>
						</div>
						<!-- /.box-header -->
						<form class="form" method="post" action="{{ route('admin.car.update')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="car" value="{{ $car->id }}" required>
							<div class="box-body">
								<hr class="my-15">
								<div class="row">
								  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Make</label>
									  <input type="text" class="form-control no-radius" placeholder="Make" name="make" value="{{ $car->make }}" required>
									</div>
								  </div>

                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Model</label>
									  <input type="text" class="form-control no-radius" placeholder="Model" name="model" value="{{ $car->model }}" required>
									</div>
								  </div>



                                  <div class="col-md-4">
									<div class="form-group">
									  <label class="form-label">Year</label>
									  <input type="text" class="form-control no-radius" placeholder="Year" name="year" value="{{ $car->year }}" required>
									</div>
								  </div>


                                  <div class="col-md-4">
									<div class="form-group">
									  <label class="form-label">Icon</label>
									  <input type="file" class="form-control no-radius" name="photo">
									</div>
								  </div>

                                  <div class="col-md-4">
									<div class="form-group">
									  <label class="form-label">Number Plate</label>
									  <input type="text" class="form-control no-radius" name="number_plate" placeholder="Number Plate" value="{{ $car->number_plate }}" required>
									</div>
								  </div>
                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Status</label>
									  <select class="form-select no-radius" name="status">
										<option value="active" @if($car->status == 'active') selected @endif >Active</option>
										<option value="inactive" @if($car->status == 'inactive') selected @endif>Inactive</option>
									  </select>
									</div>
								  </div>
                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">User</label>
									  <select class="form-select no-radius" name="user" required>
										<option value="" disabled selected>Select User</option>
										        @foreach ($users as  $user)
                                                     <option value="{{ $user->id }}"  @if($car->user->id == $user->id) selected @endif  > {{$user->name}}</option>
                                                @endforeach
									  </select>
									</div>
								  </div>
								</div>
							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-primary btn-sm no-radius">
								  <i class="ti-save-alt"></i> Save
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
