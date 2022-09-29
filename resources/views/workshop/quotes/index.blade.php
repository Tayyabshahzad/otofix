@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
    Franchise Quotes
@endsection
@section('content')
    <div class="content-wrapper" style="width: 83%!important">
        <div class="container-full">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <h4 class="page-title">Quotes</h4>
                        <div class="d-inline-block align-items-center">
                            <nav>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('workshop.dashboard') }}"><i
                                                class="mdi mdi-home-outline"></i></a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Quotes</li>
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
                        @foreach ($quotes as $quote)
                            <div class="col-lg-3 col-md-6">
                                <div class="box bg-default box-inverse no-radius">
                                    <div class="box-body">
                                        <h5 class="mt-0 mb-3">
                                            <img src="{{ $quote->quote->user->getFirstMediaUrl('profile_photo', 'thumb') }}"
                                                class="user-image rounded-circle avatar bg-white mx-10" alt="">
                                            {{ $quote->quote->user->name }}
                                        </h5>
                                        <hr>
                                        @foreach ($quote->quote->services as $service)
                                            <button type="button" class="btn btn-danger btn-sm mb-3 no-radius">
                                                {{ $service->service->title }} </button>
                                        @endforeach
                                        <hr>
                                        @if($quote->status =='pending')
                                            <span class="font-500 pull-right btn btn-info btn-sm no-radius accept_quote"
                                                data-bs-toggle="modal"
                                                data-quote_id ="{{$quote->id}}"
                                                data-user_id ="{{$quote->quote->user->id}}"
                                                data-bs-target="#modal-quote"> Accept </span>
                                            <span class="pull-left">Date: {{ $quote->quote_date }} </span>
                                        @elseif($quote->status =='approved')
                                            <span class="font-500 pull-right btn btn-info btn-sm no-radius" > Submited </span>
                                            <span class="pull-left">Date: {{ $quote->quote_date }} </span>
                                        @else
                                        <span class="font-500 pull-right btn btn-info btn-sm no-radius" > Rejected </span>
                                        <span class="pull-left">Date: {{ $quote->quote_date }} </span>
                                        @endif
                                        <br><hr>
                                        <i class="fa fa-car"></i> {{ $quote->quote->car->make }} &nvrArr; {{ $quote->quote->car->model }} &nvrArr; {{ $quote->quote->car->year }} &nvrArr; {{ $quote->quote->car->number_plate }}

                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
            <!-- /.content -->

        </div>
        <!-- Modal -->
        <div class="modal center-modal fade" id="modal-quote" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Send Quotation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('workshop.quote.submit') }}" method="post">
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="workshop_id" value="{{ $workshop_id }}">
                            <input type="hidden" name="quote_workshop_id" id="quoteId">
                            <input type="hidden" name="user_id" id="user_id"> <!-- This is the user who submited the quote-->
                            <div class="form-group">
                                <label for="">Date <span class="text-danger">*</span></label>
                                <input type="date" name="date" id="" class="form-control no-radius" required>
                            </div>
                            <div class="form-group">
                                <label for="">Total Charges <span class="text-danger">*</span></label>
                                <input type="number" name="totalcharges" id="totalcharges" class="form-control no-radius"
                                    required placeholder="Enter Your Charges">
                            </div>
                            <div class="form-group">
                                <label for="">Discount <span class="text-danger">*</span></label>
                                <input type="number" name="discount" id="discount" class="form-control no-radius" required
                                    value="0" min="0">
                            </div>

                            <div class="form-group">
                                <label for="">Tax <span class="text-danger">*</span></label>
                                <input type="number" name="tax" class="form-control no-radius"
                                    required  >
                            </div>

                            <div class="form-group">
                                <label for="">Grand Total <span class="text-danger">*</span></label>
                                <input type="text" name="grandTotal" id="grandTotal" class="form-control no-radius"
                                    required readonly>
                            </div>

                        </div>
                        <div class="modal-footer modal-footer-uniform">
                            <button type="button" type="button" class="btn btn-danger btn-sm no-radius"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary float-end btn-sm no-radius">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal -->
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
            $('#categories').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });
        });

        $('#discount').on('blur', function() {
            var totalcharges = $('#totalcharges').val();
            var discount = $('#discount').val();
            var result = (totalcharges - discount);
            $('#grandTotal').val(result);
        });

        $('#totalcharges').on('blur', function() {
            var totalcharges = $('#totalcharges').val();
            var discount = $('#discount').val();
            $('#grandTotal').val(totalcharges);
        });

        $(document).on("click", ".accept_quote", function() {
            var id = $(this).data('quote_id');
            var user_id = $(this).data('user_id');
            $('#quoteId').val(id);
            $('#user_id').val(user_id);
        });
    </script>
@endsection
