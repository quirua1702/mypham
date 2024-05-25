@extends('layouts.frontend')
@section('title', 'Mật khẩu mới')
@section('content')
	<div class="container py-4 my-4">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card border-0 shadow">
					<div class="card-body">
						
                    @php
                        $token = request()->get('token');
                        $email = request()->get('email');
                    @endphp

                        <hr>
                        <form method="post" action="{{ route('reset-new-pass') }}" class="needs-validation" novalidate>
                        @if(session()->has('message'))
							<div class="alert alert-danger fs-base" role="alert">
							<i class="ci-close-circle me-2"></i>{{ session()->get('message') }}
							</div>
						@elseif(session()->has('error'))
							<div class="alert alert-danger fs-base" role="alert">
							<i class="ci-close-circle me-2"></i>{{ session()->get('error') }}
							</div>
						@endif
						@csrf
						<h2 class="text-center pt-4 pb-2" >Điền mật khẩu mới</h2>
							<div class="input-group mb-3">
                                <input type="hidden" class="form-control rounded-start"  name="email"  value="{{$email}}" required />
                                <input type="hidden" class="form-control rounded-start"  name="token"  value="{{$token}}" required />
								<input type="password" class="form-control rounded-start"  name="password_pw"  placeholder="Nhập mật khẩu mới...." required />
							</div>
							<div class="input-group mb-3">


						
							<hr class="mt-4">
						<div class="text-end pt-4 ">
							<button class="btn btn-primary " type="submit"><i class="ci-sign-in me-2 ms-n21"></i>Gửi </button>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection