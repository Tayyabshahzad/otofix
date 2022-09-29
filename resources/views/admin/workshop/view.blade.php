@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
    WorkShops
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
								<li class="breadcrumb-item active" aria-current="page"> <a href="{{route('admin.workshop')}}"> Workshops </a> </li>
                                <li class="breadcrumb-item active" aria-current="page">View</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
        <section class="content">
			<div class="row">
				<div class="col-xxxl-3 col-12">
					<div class="box">
						<div class="box-body">
							<div class="d-flex align-items-center">

                                <img src="{{$workshop->getFirstMediaUrl('workshop_photo','thumb'),}}" alt="" class="me-10 rounded-circle avatar avatar-xl b-2 border-primary">
								<div>
									<h4 class="mb-0"> {{$workshop->name}}</h4>
									<span class="fs-14 text-info"> {{$workshop->user->name}} </span>
								</div>
							</div>
						</div>
						<div class="box-body border-bottom">
							<div class="d-flex align-items-center">
								<i class="fa fa-phone me-10 fs-24"></i>
								<h4 class="mb-0">+{{$workshop->user->phone}} </h4>
							</div>
						</div>
						<div class="box-body border-bottom">
							<div class="d-flex align-items-center">
								<i class="fa fa-map-marker me-10 fs-24"></i>
								<h4 class="mb-0 text-black"> {{$workshop->address}} </h4>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-xxxl-12 col-lg-6 col-12">
							<div class="box">
								<div class="box-header no-border">
									<h4 class="box-title"> Reviews </h4>
								</div>
								<div class="box-body text-center">
                                    <span class="text-center text-fade d-block">
                                        Total Reviews {{$workshop->reviews->count()}}
                                    </span>
                                    <ul class="list-inline mb-0">
                                        @for ($j = 1; $j <= round($avgRating); $j++)
                                        <li>
                                                <i class="text-warning fa fa-star"  title="Overall Rating {{ round($avgRating) }}"></i>
                                        </li>
                                        @endfor
                                    </ul>
                                        {{$avgRating}}
								</div>

							</div>
						</div>

					</div>
				</div>
				<div class="col-xxxl-9 col-12">

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                          <li><a href="#bookings" data-bs-toggle="tab" class="active">Bookings</a></li>
                          <li><a class="" href="#reviews" data-bs-toggle="tab">Reviews</a></li>
                          <li><a href="#services" data-bs-toggle="tab" >Services</a></li>
                          <li><a href="#setting" data-bs-toggle="tab" >Settings</a></li>
                        </ul>

                        <div class="tab-content">
                         <div class="tab-pane active" id="bookings">
                            <div class="table-responsive rounded card-table">
								<table class="table border-no" id="example1">
									<thead>
										<tr>
											<th>Booking ID</th>
											<th>Date</th>
											<th>Customer Name</th>
											<th>Amount</th>
                                            <th>Discount</th>
											<th>Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr class="hover-primary">
											<td>#245879</td>
											<td>14 April 2021, </td>
											<td>Aaliyah clark</td>
											<td>$124.6</td>
                                            <td>$0</td>
											<td>
												<span class="badge badge-pill badge-primary-light">Delivery</span>
											</td>
											<td>
												<div class="btn-group">
												  <a class="hover-primary dropdown-toggle no-caret" data-bs-toggle="dropdown"><i class="fa fa-ellipsis-h"></i></a>
												  <div class="dropdown-menu">
													<a class="dropdown-item" href="#">Accept Order</a>
													<a class="dropdown-item" href="#">Reject Order</a>
												  </div>
											    </div>
											</td>
										</tr>


									</tbody>
								</table>
							</div>
                          </div>
                          <div class="tab-pane" id="reviews">
                            <div class="box no-shadow">
                                <div class="table-responsive rounded card-table">
                                    <table class="table border-no" id="example1">
                                        <thead>
                                            <tr>
                                                <th>Booking ID</th>
                                                <th>Date</th>
                                                <th>Customer Name</th>
                                                <th>Rating</th>
                                                <th>Comments</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($reviews as $review )
                                            <tr class="hover-primary">
                                                    <td> {{ $review->booking_id}} </td>
                                                    <td>  {{ $review->created_at}} </td>
                                                    <td> {{ $review->user->name }}</td>
                                                    <td> {{ $review->rating }} </td>
                                                    <td> {{ $review->comments }} </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                          </div>
                          <div class="tab-pane" id="services">
                            <div class="box no-shadow">
                                <form class="form-horizontal form-element row" method="post" action="{{route('admin.workshop.assign.services')}}">@csrf
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
                          <div class="tab-pane" id="setting">
                            <div class="box no-shadow">
                                <form class="form-horizontal form-element row" method="post" action="{{route('admin.workshop.assign.services')}}">@csrf
                                        <input type="hidden" name="workshop" value="{{ $workshop->id }}">
                                        <div class="col-lg-6">
                                            <label for=""> First Name</label>
                                            <input type="text" name="user_name" id="" class="form-control required" value="{{ $workshop->user->name }}">
                                        </div>
                                        <div class="col-lg-6">
                                          <label for=""> Workshop Name</label>
                                          <input type="text" name="workshop_name" id="" class="form-control required" value="{{ $workshop->name }}">
                                        </div>

                                        <div class="col-lg-6">
                                          <label for=""> Phone</label>
                                          <input type="text" name="user_phone" id="" class="form-control" value="{{ $workshop->user->phone }}">
                                        </div>

                                        <div class="col-lg-6">
                                           <label class="form-label">Franchise Status</label>
                                              <select class="form-control no-radius" name="status">
                                                <option value="active" @if($workshop->status == 'active') selected @endif> Active</option>
                                                <option value="inactive" @if($workshop->status == 'inactive') selected @endif >In Active</option>
                                            </select>
                                          </div>

                                        <div class="col-lg-6">
                                          <label for=""> Address </label>
                                          <input type="text" name="address" id="" class="form-control required" value="{{ $workshop->address}}">
                                        </div>

                                        <div class="col-lg-6">
                                          <label for=""> Password </label>
                                          <input type="password" name="password" class="form-control">
                                        </div>

                                        <div class="col-lg-6">
                                            <br>
                                            <button class="btn btn-info no-radius">Update</button>
                                          </div>

                                </form>
                            </div>
                          </div>
                          <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                      </div>
				</div>
			</div>
		</section>
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
                $('#workshops').DataTable({
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
