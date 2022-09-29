@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
    Workshop Dashboard
@endsection
@section('content')
<div class="content-wrapper" style="width: 83%!important">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xxxl-3 col-lg-6 col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="d-flex align-items-start">
                                <div>
                                    <img src="../images/food/online-order-1.png" class="w-80 me-20"
                                        alt="" />
                                </div>
                                <div>
                                    <h2 class="my-0 fw-700">89</h2>
                                    <p class="text-fade mb-0">Total Order</p>
                                    <p class="fs-12 mb-0 text-success"><span
                                            class="badge badge-pill badge-success-light me-5"><i
                                                class="fa fa-arrow-up"></i></span>3% (15 Days)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxxl-3 col-lg-6 col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="d-flex align-items-start">
                                <div>
                                    <img src="../images/food/online-order-2.png" class="w-80 me-20"
                                        alt="" />
                                </div>
                                <div>
                                    <h2 class="my-0 fw-700">899</h2>
                                    <p class="text-fade mb-0">Total Delivered</p>
                                    <p class="fs-12 mb-0 text-success"><span
                                            class="badge badge-pill badge-success-light me-5"><i
                                                class="fa fa-arrow-up"></i></span>8% (15 Days)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxxl-3 col-lg-6 col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="d-flex align-items-start">
                                <div>
                                    <img src="../images/food/online-order-3.png" class="w-80 me-20"
                                        alt="" />
                                </div>
                                <div>
                                    <h2 class="my-0 fw-700">59</h2>
                                    <p class="text-fade mb-0">Total Canceled</p>
                                    <p class="fs-12 mb-0 text-primary"><span
                                            class="badge badge-pill badge-primary-light me-5"><i
                                                class="fa fa-arrow-down"></i></span>2% (15 Days)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxxl-3 col-lg-6 col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="d-flex align-items-start">
                                <div>
                                    <img src="../images/food/online-order-3.png" class="w-80 me-20"
                                        alt="" />
                                </div>
                                <div>
                                    <h2 class="my-0 fw-700">59</h2>
                                    <p class="text-fade mb-0">Order Today</p>
                                    <p class="fs-12 mb-0 text-primary"><span
                                            class="badge badge-pill badge-primary-light me-5"><i
                                                class="fa fa-arrow-down"></i></span>2% (15 Days)</p>
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
    <script src="{{ asset('assets/vendor_components/OwlCarousel2/dist/owl.carousel.js') }}"></script>
    {{-- <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/kelly.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script> --}}
@endsection
