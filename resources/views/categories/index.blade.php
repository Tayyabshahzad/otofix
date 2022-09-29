@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
    Categories
@endsection
@section('content')
<div class="content-wrapper" style="width: 83%!important">
    <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<h4 class="page-title">Categories</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Categories</li>
							</ol>
						</nav>
					</div>

				</div>
                <a href="category/create" class="btn btn-info btn-sm no-radius">Add Category</a>
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
											<th>Icon</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									 <tbody>
                                        <tr class="hover-primary">
											<td>1</td>
											<td>Breakdown</td>
											<td><img src="https://www.pomenapp.com/wp-content/uploads/2018/12/icoBreakdown.png" alt="" class="w-40 h-40 me-10 rounded100"> </td>
											<td>Active</td>

											<td>
												<div class="btn-group">
												  <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
												  <div class="dropdown-menu">
													<a class="dropdown-item" href="#">Edit</a>
													<a class="dropdown-item" href="#">Delete</a>

												  </div>
											    </div>
											</td>
										</tr>
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
