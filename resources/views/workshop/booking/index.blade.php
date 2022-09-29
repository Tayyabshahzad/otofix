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
                        <h4 class="page-title">Bookings</h4>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('workshop.dashboard') }}"><i
                                                class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Bookings</li>
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
                                        <div class="table-responsive">
                                            <table id="booking_table" class="table table-hover no-wrap product-order"
                                                data-page-size="10">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Booking ID</th>
                                                        <th>Customer</th>
                                                        <th>Car</th>
                                                        <th>Discount</th>
                                                        <th>Total</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($bookings as $booking)
                                                <tbody>
                                                    <tr>
                                                        <td> {{$loop->iteration}} </td>
                                                        <td> #{{$booking->booking_number}} </td>
                                                        <td> {{$booking->user->name}} </td>
                                                        <td> {{$booking->acceptedquote->quote->car->number_plate}} </td>
                                                        <td> {{$booking->discount }} </td>
                                                        <td> {{$booking->total }} </td>
                                                        <td> {{$booking->created_at }}  </td>
                                                        <td>

                                                            <span class="@if($booking->status == 'pending')       no-radius badge badge-pill badge-warning-light
                                                                         @elseif($booking->status == 'ongoing')   no-radius badge badge-pill badge-primary-light
                                                                         @elseif($booking->status == 'completed') no-radius badge badge-pill badge-success-light
                                                                         @elseif($booking->status == 'cancelled') no-radius badge badge-pill badge-danger-light
                                                             @endif"> {{ ucfirst($booking->status) }}</span></td>

                                                             <td> <a href="{{ route('workshop.booking.view',$booking->id) }}" class="text-info me-10"
                                                                data-bs-toggle="tooltip" data-bs-original-title="View Detail">
                                                                <i class="ti-eye"></i>
                                                            </a>
                                                            {{-- <a href="javascript:void(0)" class="text-danger"
                                                                data-bs-original-title="Delete" data-bs-toggle="tooltip">
                                                                <i class="ti-trash"></i>
                                                            </a> --}}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                @endforeach
                                            </table>
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
