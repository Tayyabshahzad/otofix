<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('storage/images/favicon.ico')}}">
    <title>Auto Fix Register</title>
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{asset('assets/css/vendors_css.css')}}">
	<!-- Style-->
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
								<h2 class="text-primary">Get started with Us</h2>
								<p class="mb-0">Register New Workshop</p>
                                @if ($errors->any())
                                <div class="font-medium text-red-600">
                                    {{ __('Whoops! Something went wrong.') }}
                                </div>
                                <ul class="mt-3 list-disc list-inside text-sm text-red-600 text-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                @endif
							</div>
							<div class="p-40">
								<form method="POST" action="{{ route('register') }}">
                                    @csrf
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
											<input type="text" class="form-control ps-15 bg-transparent" placeholder="Full Name" name="name" value="{{old('name')}}">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
											<input type="email" class="form-control ps-15 bg-transparent" placeholder="Email" name="email" value="{{old('email')}}">
										</div>
									</div>

                                    <div class="form-group row">
                                        <div class="col-lg-3">
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent"><i class="ti-mobile"></i></span>
                                                <select type="number" class="form-control ps-15 bg-transparent" name="cc">
                                                    <option value="+91">+91</option>
                                                    <option value="+92">+92</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="input-group">
                                                <input type="number" class="form-control ps-15 bg-transparent" placeholder="Phone number without country code" name="phone" value="{{old('phone')}}">
                                            </div>
                                        </div>

									</div>


                                    <div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
											<input type="password" class="form-control ps-15 bg-transparent" placeholder="Password" name="password" >
										</div>
									</div>
									<div class="form-group">
										<div class="input-group mb-3">
											<span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
											<input type="password" class="form-control ps-15 bg-transparent" placeholder="Retype Password" name="password_confirmation" >
										</div>
									</div>
									  <div class="row">
										<div class="col-12">
                                            <p class="mt-15 mb-0"><a href="{{ route('phone.register') }}" class="text-danger ms-5">SignUp using phone</a></p> <br>
										</div>
										<!-- /.col -->
										<div class="col-12 text-center">
										  <button type="submit" class="btn btn-info margin-top-10">SIGN IN</button>
										</div>
										<!-- /.col -->
									  </div>
								</form>
								<div class="text-center">
									<p class="mt-15 mb-0">Already have an account?<a href="{{ route('login') }}" class="text-danger ms-5"> Sign In</a></p>
								</div>
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
