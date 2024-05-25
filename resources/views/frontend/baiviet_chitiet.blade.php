@extends('layouts.frontend')
@section('title', 'Bài viết chi tiết')
@section('content')
    <div class="bg-secondary py-4"> 
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3"> 
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2"> 
                <nav aria-label="breadcrumb"> 
                    <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start"> 
                        <li class="breadcrumb-item"> 
                            <a class="text-nowrap" href="{{ route('frontend.home') }}"><i class="ci-home"></i>Trang chủ</a> 
                        </li> 
                        <li class="breadcrumb-item text-nowrap"> 
                            <a href="{{ route('frontend.baiviet') }}">Tin tức</a> 
                        </li> 
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">Chi tiết</li> 
                    </ol> 
                </nav> 
            </div> 
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start"> 
                <h1 class="h3 mb-0">{{ $baiviet->tieude }}</h1> 
            </div> 
        </div> 
    </div> 
     
    <div class="container pb-5"> 
        <div class="row justify-content-center pt-3 mt-md-3"> 
            <div class="col-12"> 
                <div class="d-flex flex-wrap justify-content-between align-items-center pb-4 mt-n1"> 
                    <div class="d-flex align-items-center fs-sm mb-2"> 

                        <span class="blog-entry-meta-divider"></span> 
                        <a class="blog-entry-meta-link" href="#date">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $baiviet->created_at)->format('d/m/Y') }}</a> 
                    </div>  
                </div> 
                 
                <p style="text-align:justify" class="fw-bold">{{ $baiviet->tomtat }}</p> 
                <img src="{{ env('APP_URL') . '/public/uploads/' . $baiviet->hinh }}"/>
                <p style="text-align:justify">{!! $baiviet->noidung !!}</p> 
                 
                <div class="d-flex flex-wrap justify-content-between pt-2 pb-4 mb-1"> 
                    <div class="mt-3"> 
                        <span class="d-inline-block align-middle text-muted fs-sm me-3 mt-1 mb-2">Chia sẻ:</span> 
                        <a class="btn-social bs-facebook me-2 mb-2" href="#facebook"><i class="ci-facebook"></i></a> 
                        <a class="btn-social bs-twitter me-2 mb-2" href="#twitter"><i class="ci-twitter"></i></a> 
                        <a class="btn-social bs-pinterest me-2 mb-2" href="#pinterest"><i class="ci-pinterest"></i></a> 
                    </div> 



						<!-- Comments-->
						<div class="pt-2 mt-5" id="comments">
							<h2 class="h4">Bình luận<span class="badge bg-secondary fs-sm text-body align-middle ms-2">{{ $baiviet->BinhLuanBaiViet->count() }}</span></h2>
							<!-- comment-->
                            @foreach($binhluanbaiviet as $comm)
							<div class="d-flex align-items-start py-4">
								<img class="rounded-circle" src="{{ asset('public/img/avatar.jpg') }}" width="50" />
								<div class="ps-3">
									<div class="d-flex justify-content-between align-items-center mb-2">
										<h6 class="fs-md mb-0">{{$comm->NguoiDung->name}}</h6>
									</div>
									<p class="fs-md mb-1" style="text-align:justify">{{$comm->comment}}</p>
                                    <span class="fs-ms text-muted"><i class="ci-time align-middle me-2"></i>{{$comm->created_at}}</span>
								</div>
							</div>
                            @endforeach
							<!-- Post comment form-->
                            <h3>Bình luận của bạn</h3>
                    @if(auth()->check())
                    <form class="w-80 needs-validation ms-3"action="{{route('frontend.baiviet.comment', $baiviet->id)}}" method="post" role="form" >
                        @csrf
                        <div class="form-group">
                            <textarea name="comment" class="form-control" rows="3" placeholder="Nội dung bình luận"></textarea>

                        </div>
                        <button class="btn btn-primary btn-sm mt-2 mb-4" type="submit" class="btn-btn-primary">Đăng bình luận</button>
                    </form>
                    @else
                    <div class="alert alert-danger" role="alert">
                        <strong>Hãy đăng nhập để bình luận bài viết </strong><a href="{{ route('user.dangnhap') }}">Click vào đây để đăng nhập</a>
                    </div>
                    @endif
						</div>
					</div>
				</div>
			</div>
		</div>
        
@endsection 