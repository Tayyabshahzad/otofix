<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('storage/images/favicon.ico')}}">

    <title>Riday - Restaurant Bootstrap Admin Template Webapp</title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{asset('assets/css/vendors_css.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/skin_color.css')}}">

</head>

<body class="hold-transition theme-primary bg-img" style="background-image: url(../images/auth-bg/bg-2.jpg)">

	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">

            <div class="col-12">
				<div class="row justify-content-center g-0">
					<div class="col-lg-5 col-md-5 col-12">
						<div class="bg-white rounded10 shadow-lg">
							<div class="content-top-agile p-20 pb-0">
								<h2 class="text-primary">Confirm Your OTP</h2>
								<p class="mb-0">Please Enter Your OTP</p>
                                @if ($errors->any())
                                <div >
                                    <br>
                                    <div class="font-medium text-red-600 text-danger">
                                         Whoops! Something went wrong
                                    </div>
                                    @foreach ($errors->all() as $error)
                                            <p class="mb-0 text-danger"> {{ $error }}</p>
                                    @endforeach
                                </div>
                                @endif
							</div>
							<div class="p-40">
								<form method="POST" action="{{ route('otp.varify') }}">
                                    @csrf
									<div class="form-group row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent"><i class="ti-mobile"></i></span>
                                                <input type="number" class="form-control ps-15 bg-transparent" placeholder="Enter your OTP" name="otp" value="{{old('otp')}}" required>
                                                <input type="hidden" name="user" value="{{$user->id}}" required>

                                            </div>
                                        </div>
									</div>

                                    <div class="row">
										<div class="col-6">
										  <div class="checkbox">
											<a href="{{ route('login')}}" class="hover-warning"><i class="ti-lock"></i> Login </a><br>
										  </div>
										</div>
                                        <div class="col-6 text-right">
                                            <div class="checkbox">
                                              <a href="{{ route('otp.resend',$user->id)}}" class="hover-warning"><i class="ti-lock"></i> Resend OTP </a><br>
                                            </div>
                                          </div>
										<!-- /.col -->

									  </div>

									  <div class="row">
										<div class="col-12 text-center">
										  <button type="submit" class="btn btn-danger mt-10 no-radius">Verify</button>
										</div>
										<!-- /.col -->
									  </div>


								</form>

							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Vendor JS -->
	<script src="{{asset('assets/js/vendors.min.js')}}"></script>
	<script src="{{asset('assets/js/pages/chat-popup.js')}}"></script>
	<script src="{{asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/icons/feather-icons/feather.min.js')}}"></script>
</body>
</html>
