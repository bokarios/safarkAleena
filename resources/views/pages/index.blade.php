@extends('layouts.main')
@section('content')
	<div class="container pt-5">
		<div class="row pt-5">
			<div class="col-xl-7 col-lg-9 col-md-11 col-sm-12 mx-auto">
				<div class="row" style="background: linear-gradient(109deg, #ffffff 55%, #1fabc4 30%);box-shadow:0px 10px 18px -6px #00000066;border-radius:5px">
					<div class="col-md-7 col-sm-7 text-center bg-white pt-5" style="border-radius: 4px 0 0 4px;background:linear-gradient(143deg, #11cbed 44%, #d6d4d4 35%)">
						<div class="row text-center">
							<div class="col-12">
								<h1 class="text-white">
									<i class="fa fa-bus"></i> سفرك علينا
								<h1>
								<form class="mt-5" method="POST" action="/auth/login">
									<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
									<div class="form-group mx-md-5 mx-sm-3">
										<label class="sr-only" for="username">username</label>
										<div class="input-group mb-2 mr-sm-2">
											<div class="input-group-prepend">
												<div class="input-group-text {{$errors->has('email')?'border-danger':''}}" style="height: 46px;width:50px">
													<i class="fas fa-user text-gradient-primary-dark"></i>
												</div>
											</div>
											<input type="email" class="form-control bg-secondary text-right {{$errors->has('email')?'border-danger':''}}" id="username" name="email" placeholder="البريد الاكتروني" value="{{ old('email') }}">
										</div>
										<h5 class="form-text text-muted text-right mr-3 simple-transition animated slideInLeft" id="username-error">
											@if($errors->has('email'))
												{!! $errors->first('email', '<span class="text-danger">:message</span>') !!}
											@else
												تأكد من كتابة بريد الاكتروني صحيح
											@endif
										</h5>
									</div>
									<div class="form-group mx-md-5 mx-sm-3">
										<label class="sr-only" for="password">
											password
										</label>
										<div class="input-group mb-2 mr-sm-2">
											<div class="input-group-prepend" style="cursor: pointer">
												<div class="input-group-text {{$errors->has('password')?'border-danger':''}}" style="height: 46px;width:50px">
													<i class="fas fa-lock text-gradient-primary-dark"></i>
												</div>
											</div>
											<input type="password" class="form-control text-right {{$errors->has('password')?'border-danger':''}}" id="password" name="password" placeholder="كلمة المرور">
										</div>
										<h5 class="form-text text-right text-muted mr-3 simple-transition animated slideInLeft" id="password-error">
												@if($errors->has('password'))
												{!! $errors->first('password', '<span class="text-danger">:message</span>') !!}
											@else
											  تأكد من حالة الحروف
											@endif
											
										</h5>
									</div>
									<div class="form-group text-center mt-4 mb-4">
										<button type="submit" class="btn btn-gradient-primary mb-1">
											تسجيل الدخول
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<div class="col-sm-5 col-md-5 d-none d-sm-block text-center text-light pt-5" style="border-radius: 0 4px 4px 0;background:linear-gradient(143deg, #1fabc4 48%, #11cbed 20%)">
						<div class="row">
							<div class="col-12">
								<h1 class="text-center text-white">
									تسجيل الدخول
								</h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection