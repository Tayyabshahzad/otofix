@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
    Cars
@endsection
@section('content')
<div class="content-wrapper" style="width: 83%!important">
    <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<h4 class="page-title">Car</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Car</li>
							</ol>
						</nav>
					</div>

				</div>
                <a href="{{ route('admin.car.create')}}" class="btn btn-info btn-sm no-radius">Add Car</a>
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
											<th>Make</th>
											<th>Model</th>
											<th>Year</th>
                                            <th>Number Plate</th>
                                            <th>Photo</th>
											<th>User</th>
                                            <th>Status</th>
                                            <th>Action</th>
										</tr>
									</thead>
									 <tbody>

                                            @foreach ($cars as $car )
                                            <tr class="hover-primary">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $car->make }}</td>
                                                <td>{{ $car->model }}</td>
                                                <td>{{ $car->year }}</td>
                                                <td>{{ $car->number_plate }}</td>
                                                <td><img src="{{ $car->getFirstMediaUrl('car_photo', 'thumb') }}" alt="" class="w-40 h-40 me-10 rounded100"> </td>
                                                <td>{{ $car->user->name }}</td>
                                                <td>{{ $car->status }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                    <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('admin.car.edit',$car->id) }}">Edit</a>
                                                        <a class="dropdown-item " href="#"  onclick="deleteCat({{ $car->id }})">Delete</a>

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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function deleteCat(id) {

        swal({
            title: "Are you sure?",
            text: "You will not be able to revert",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function(){
            var url = '{{ route('admin.car.delete') }}';
                $.ajax({
                    url:url,
                    method:'POST',
                    data:{
                        id:id
                    },
                    success:function(response){
                        if(response.success == true){
                            $.notify(response.message, "success");
                            location.reload();
                        }else{
                            $.notify(response.message, "error");

                        }
                    }
                });

        });



    }



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
