@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
    Service Edit
@endsection
@section('content')
<div class="content-wrapper" style="width: 83%!important">
    <div class="container-full">
        <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<h4 class="page-title">Services</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item"><a href="{{ route('admin.services')}}"> Services </a> </li>
                                <li class="breadcrumb-item active " aria-current="page">Edit</li>
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
						  <h4 class="box-title">Update Service</h4>
						</div>
						<!-- /.box-header -->
						<form class="form" method="post" action="{{ route('admin.category.update')}}">
                            @csrf
							<div class="box-body">
								<hr class="my-15">
								<div class="row">
								  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Title</label>
                                      <input type="hidden" name="id" value="{{ $category->id }}">
									  <input type="text" class="form-control no-radius" placeholder="Title" name="title" required value="{{ $category->title}}">
									</div>
								  </div>

                                  <div class="col-md-6">
									<div class="form-group">
									  <label class="form-label">Status</label>
									  <select class="form-select no-radius" name="status">
										<option value="active" @if($category->status == 'active') selected  @endif >Active</option>
										<option value="inactive" @if($category->status == 'inactive') selected  @endif>Inactive</option>
									  </select>
									</div>
								  </div>

                                  <div class="col-md-12">
									<div class="form-group">
									  <label class="form-label">Icon</label>
									  <input type="text" class="form-control no-radius" name="icon" value="{{ $category->icon_name}}" >
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
