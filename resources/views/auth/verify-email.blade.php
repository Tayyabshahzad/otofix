

@extends('layouts.app')
@section('page_css')
@endsection
@section('title')
    Dashboard
@endsection
@section('content')
<div class="content-wrapper" style="width: 83%!important">
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xxxl-12 col-lg-12 col-12">
                    <div class="box">
                        <div class="box-body">
                            @if(Auth::user()->registered_type == 'email')
                                <div class="d-flex align-items-start">
                                    Thanks for signing up! Before getting started, could you verify your email address  by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.
                                </div>
                                <hr>
                                <form method="POST" action="{{ route('verification.send') }}">@csrf
                                <button class="btn btn-success no-radius"> Resend Verification Email </button>
                                </form>
                            @else
                            <div class="d-flex align-items-start">
                                Thanks for signing up! Before getting started, could you verify your email mobile number by clicking on the link we just sent OTP  to you? If you didn\'t receive the OTP, we will gladly send you another.
                            </div>
                            <hr>
                            <form method="POST" action="{{ route('otp.send') }}">@csrf
                            <button class="btn btn-success no-radius"> Resend OTP </button>
                            </form>
                            @endif

                        </div>
                    </div>
                </div>

                @if (session('status') == 'verification-link-sent')
                <div class="col-xxxl-12 col-lg-12 col-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="d-flex align-items-start">
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

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
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/maps.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/kelly.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
@endsection

