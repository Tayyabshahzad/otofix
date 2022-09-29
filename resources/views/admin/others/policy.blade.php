
@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
        Policy
@endsection
@section('content')
<div class="content-wrapper" style="width: 83%!important">
    <div class="container-full">
        <div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<h4 class="page-title">Policy</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
                                <li class="breadcrumb-item active " aria-current="page">Policy Content</li>
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
						  <h4 class="box-title">Policy</h4>
						</div>
						<!-- /.box-header -->
						<form class="form" method="post" action="{{ route('admin.policy.update')}}" enctype="multipart/form-data">
                            @csrf
							<div class="box-body">
								<hr class="my-15">
								<div class="row">
								  <div class="col-md-12">
									<div class="form-group">
									  <label class="form-label">Content</label>
                                      <input type="hidden" name="policy_id" value="{{ $policy->id }}">
									  <textarea  class="form-control no-radius" placeholder="About Content" name="content" id="editor1"required>{{ $policy->content }}</textarea>
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
