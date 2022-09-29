@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
    Franchise Bookings
@endsection
@section('content')
    <div class="content-wrapper" style="width: 83%!important">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">

                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('workshop.dashboard') }}"><i class="mdi mdi-home-outline"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('workshop.bookings') }}"> Bookings </a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">View</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="row">
                        <!-- col -->

                        <div class="col-12">
                            <div class="box">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6">
                                            <div class="box box-body b-1 text-center no-shadow">
                                                @if ($booking->acceptedquote->quote->car->getFirstMediaUrl('car_photo', 'thumb'))
                                                    <img src="{{ $booking->acceptedquote->quote->car->getFirstMediaUrl('car_photo', 'thumb') }}"
                                                        id="product-image" class="img-fluid" alt="">
                                                @else
                                                    <img src="{{ asset('assets/icons/no-car.jpg') }}"
                                                        id="product-image" class="img-fluid" alt="">
                                                @endif

                                            </div>

                                            <div class="clear"></div>
                                        </div>
                                        <div class="col-md-8 col-sm-6">
                                            <h2 class="box-title mt-0">
                                                {{ $booking->acceptedquote->quote->car->number_plate }}</h2>
                                            <h1 class="pro-price mb-0 mt-20">${{ $booking->total }}</h1>
                                            <hr>
                                            <p>
                                                @if ($booking->acceptedquote->quote->comments != null)
                                                    {{ $booking->acceptedquote->quote->comments }}
                                                @else
                                                    <p class="text-danger"> No Comments ... </p>
                                                @endif
                                            </p>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="gap-items">
                                                        <button
                                                            class="btn no-radius
                                                                @if ($booking->status == 'completed') btn-success
                                                                @elseif($booking->status == 'ongoing')   btn-warning
                                                                @elseif($booking->status == 'pending')   btn-danger
                                                                @elseif($booking->status == 'cancelled') btn-danger @endif">
                                                            {{ ucfirst($booking->status) }}
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">

                                                            <form action="{{ route('workshop.booking.status') }}"
                                                                method="post">@csrf
                                                                <div class="col-lg-6">
                                                                    <div class="gap-items">
                                                                        <label for="" style="padding-left:8px;font-bold"> <b> Change Status </b> </label>
                                                                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                                                        <select name="status" required class="form-control no-radius">
                                                                            <option value="" disabled selected>Change Status</option>
                                                                            <option value="ongoing">Ongoing</option>
                                                                            <option value="completed">Completed</option>
                                                                            <option value="cancelled">Cancelled</option>
                                                                        </select>
                                                                        <hr>
                                                                        @if($booking->status == 'completed' or $booking->status == 'cancelled')
                                                                                <i class="text-danger">Booking marked as closed</i>
                                                                        @else
                                                                                <button class="btn btn-info no-radius btn-sm" type="submit">
                                                                                    Update
                                                                                </button>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                            </form>

                                                    </div>
                                                </div>

                                            </div>

                                            <h4 class="box-title mt-20">Services Include</h4>
                                            <ul class="list-icons list-unstyled">
                                                @foreach ($booking->acceptedquote->quote->services as $service)
                                                    <li><i class="fa fa-check text-danger me-3"></i>
                                                        {{ $service->service->title }}</li>
                                                @endforeach


                                            </ul>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <h4 class="box-title mt-40">General Info</h4>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Booking # </td>
                                                            <td> #{{ $booking->booking_number }} </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="390">Car Number</td>
                                                            <td> {{ $booking->acceptedquote->quote->car->number_plate }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Customer Name </td>
                                                            <td> {{ $booking->acceptedquote->quote->car->number_plate }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Service Date</td>
                                                            <td> {{ $booking->created_at }} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Discount</td>
                                                            <td> {{ $booking->discount }} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tax</td>
                                                            <td> {{ $booking->tax }} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Total Amount</td>
                                                            <td> {{ $booking->total }} </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Payment Clear</td>
                                                            <td> Yes </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Booking Rating </td>
                                                            <td>
                                                                @if ($booking->review)

                                                                    <div class="list-inline">
                                                                         @for($i=1;$i<=$booking->review->rating;$i++)
                                                                                <a class="text-warning"><i class="mdi mdi-star"></i></a>
                                                                         @endfor
                                                                    </div>
                                                                    <hr>
                                                                    <p class="text-danger"> {{ $booking->review->comments }} </p>
                                                                @else
                                                                    <p class="text-danger"> Not yet reviewed </p>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Status </td>
                                                            <td> {{ ucfirst($booking->status) }} </td>
                                                        </tr>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
        $(function() {
            'use strict';
            $('#booking_table').DataTable({
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
            });
        });
    </script>
@endsection
