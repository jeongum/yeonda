@extends('layouts._master_auth')
@section('content')
<div class="container-fluid pb-5">
	<div class="row justify-content-md-center">
		<div class="card-wrapper col-12 col-md-4 mt-5">
			<div class="brand text-center mb-3">
				<a href="/" class = "display-3"><img src="{{ asset('img/logo/L_TB_512.png') }}">연다</a>
			</div>
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Login</h4>
					@if (session('status'))
                        <div class="alert border border-danger text-danger alert-dismissible d-flex align-items-center p-md-4 mb-2 fade show" role="alert">
                            <i class="gd-alert icon-text text-danger mr-2"></i>
                            <p class="mb-0">
                          		이메일 혹은 비밀번호가 올바르지 않습니다.
                            </p>
                            <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                          		<i class="gd-close icon-text icon-text-xs" aria-hidden="true"></i>
                            </button>
                      	</div>
                    @endif
                    @if (session('role'))
                        <div class="alert border border-danger text-danger alert-dismissible d-flex align-items-center p-md-4 mb-2 fade show" role="alert">
                            <i class="gd-alert icon-text text-danger mr-2"></i>
                            <p class="mb-0">
                          		관리자만 로그인 가능합니다.
                            </p>
                            <button type="button" class="close" aria-label="Close" data-dismiss="alert">
                          		<i class="gd-close icon-text icon-text-xs" aria-hidden="true"></i>
                            </button>
                      	</div>
                    @endif
					<form method="POST" action="{{ route('login') }}">
						@csrf
						<div class="form-group">
							<label for="email">E-Mail Address</label>
							<input id="email" type="email" class="form-control" name="email" required autofocus> 
							@if($errors->has('email')) 
    							<span class="invalid-feedback"role="alert"> 
    								<strong>{{ $errors->first('email') }}</strong>
    							</span> 
							@endif
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input id="password" type="password" class="form-control" name="password" required>
							@if ($errors->has('password'))
    							<span class="invalid-feedback" role="alert">
    								<strong>{{ $errors->first('password') }}</strong>
    							</span>
							@endif
							@if (Route::has('password.request'))
							<div class="text-right">
								<a href="/" class="small">Forgot Your Password? </a>
							</div>
							@endif
						</div>
						<div class="form-group">
							<div class="form-check position-relative mb-2">
								<input type="checkbox" class="form-check-input d-none" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} >
								<label class="checkbox checkbox-xxs form-check-label ml-1" for="remember" data-icon="&#xe936">Remember Me</label>
							</div>
						</div>
						<div class="form-group no-margin">
							<button type="submit" class="btn btn-primary btn-block">Sign In</button>
						</div>
						@if (Route::has('register'))
						<div class="text-center mt-3 small">
							Don't have an account?
							<a href="/">Sign Up</a>
						</div>
						@endif
					</form>
				</div>
			</div>
			<footer class="footer mt-3">
				<div class="container-fluid">
					<div class="footer-content text-center small">
						<span class="text-muted">&copy; {{ date('Y') }} Yeonda - F10. All
							Rights Reserved.</span>
					</div>
				</div>
			</footer>
		</div>
	</div>

</div>
@endsection
