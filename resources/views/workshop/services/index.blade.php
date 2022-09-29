@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
     Franchise Services
@endsection
@section('content')
<div class="content-wrapper" style="width: 83%!important">
    <div class="container-full">
		<!-- Content Header (Page header) -->
		<div class="content-header">
			<div class="d-flex align-items-center">
				<div class="me-auto">
					<h4 class="page-title">Service</h4>
					<div class="d-inline-block align-items-center">
						<nav>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('workshop.dashboard')}}"><i class="mdi mdi-home-outline"></i></a></li>
								<li class="breadcrumb-item active" aria-current="page">Service</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-12">
					<div class="box">
						<div class="box-body">
							<div class="table-responsive rounded card-table">
                                <div class="box no-shadow">
                                    <form class="form-horizontal form-element row" method="post" action="{{route('workshop.assign.services')}}">@csrf
                                            <input type="hidden" name="workshop" value="{{ $workshop->id }}">
                                            @foreach ($services as $service )
                                                    <div class="col-lg-2">
                                                        <div class="demo-checkbox">
                                                            <input type="checkbox"
                                                                   name="services[]"
                                                                   id="md_checkbox_{{$service->id}}"
                                                                   @if (in_array($service->id, $assign_services)) checked="checked" @endif
                                                                   value="{{$service->id}}" class="filled-in chk-col-info">

                                                                   <label for="md_checkbox_{{$service->id}}">{{$service->title}}</label>
                                                        </div>
                                                    </div>
                                            @endforeach
                                            <hr>
                                            <button class="btn btn-info no-radius">Update</button>
                                    </form>
                                </div>
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
            var url = '{{ route('admin.category.delete') }}';
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
