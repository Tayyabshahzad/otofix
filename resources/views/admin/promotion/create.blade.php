@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
        Promotion Create
@endsection
@section('content')
<div class="content-wrapper" style="width: 83%!important">
    <div class="container-full">
        <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<h4 class="page-title">Promotion</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item"><a href="{{ route('admin.promotions.index')}}"> Promotion </a> </li>
                                <li class="breadcrumb-item active " aria-current="page">Promotion Create</li>
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
						  <h4 class="box-title">Create Promotion</h4>
						</div>
						<!-- /.box-header -->
						<form class="form" method="post" action="{{ route('admin.promotions.store')}}" enctype="multipart/form-data">
                            @csrf
							<div class="box-body">
								<hr class="my-15">
								<div class="row">
								  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Title</label>
									  <input type="text" class="form-control no-radius" placeholder="Title" name="title" required>
									</div>
								  </div>

                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Workshop</label>
									  <select class="form-select no-radius" name="workshop">
										    <option value="" selected disabled>Select Workshop</option>
										    @foreach ($workshops as $workshop )
                                                    <option value="{{ $workshop->id }}"> {{ $workshop->name }} </option>
                                            @endforeach
									  </select>
									</div>
								  </div>
                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Status</label>
									  <select class="form-select no-radius" name="status">
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
									  </select>
									</div>
								  </div>

                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Icon</label>
									  <input type="file" class="form-control no-radius" name="icon" required>
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
