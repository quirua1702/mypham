@extends('layouts.frontend')
@section('title', 'Quên mật khẩu')
@section('content')
	<div class="container py-4 my-4">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card border-0 shadow">
					<div class="card-body">
						<hr>
						<form method="post" action="{{ route('recover-pass') }}" class="needs-validation" novalidate>
						@csrf
						@if(session()->has('message'))
							<div class="alert alert-danger fs-base" role="alert">
							<i class="ci-close-circle me-2"></i>{{ session()->get('message') }}
							</div>
						@elseif(session()->has('error'))
							<div class="alert alert-danger fs-base" role="alert">
							<i class="ci-close-circle me-2"></i>{{ session()->get('error') }}
							</div>
						@endif
						<h2 class="text-center pt-4 pb-2" >Điền Email để lấy lại mật khẩu</h2>
                            
							<div class="input-group mb-3">
								<i class="ci-mail position-absolute top-50 translate-middle-y text-muted fs-base ms-3"></i>
								<input type="text" class="form-control rounded-start   "  name="email_account"  placeholder="Nhập email...." required />
							</div>
							<div class="input-group mb-3">


						<div class="d-flex flex-wrap justify-content-between">
							<a class="nav-link-inline fs-sm" href="{{ route('user.dangky') }}">Chưa có tài khoản?</a>
						</div>
							<hr class="mt-4">
						<div class="text-end pt-4 ">
							<button class="btn btn-primary " type="submit"><i class="ci-sign-in me-2 ms-n21"></i>Gửi mail</button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection