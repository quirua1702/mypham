@extends('layouts.frontend')
@section('title', 'Sản phẩm chi tiết')
@section('content')
		
		<!-- Page Title-->
		<div class="page-title-overlap bg-dark pt-4">
			<div class="container d-lg-flex justify-content-between py-2 py-lg-3">
				<div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
							<li class="breadcrumb-item">
								<a class="text-nowrap" href="{{ route('frontend.home') }}"><i class="ci-home"></i>Trang chủ</a>
							</li>
							<li class="breadcrumb-item text-nowrap">
								<a href="{{ route('frontend.sanpham') }}">Gói cước</a>
							</li>
							<li class="breadcrumb-item text-nowrap active" aria-current="page">Chi tiết</li>
						</ol>
					</nav>
				</div>
				
				<div class="order-lg-1 pe-lg-4 text-center text-lg-start">
					<h1 class="h3 text-light mb-0">SẢN PHẨM {{ $sanpham->tensanpham}}</h1>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="bg-light shadow-lg rounded-3 px-4 py-3 mb-5">
				<div class="px-lg-3">
					<div class="row">

						<div class="col-lg-7 pe-lg-0 pt-lg-4">
							<div class="product-gallery">
								<div class="product-gallery-preview order-sm-2">
									<div class="product-gallery-preview-item active" id="first">
										<img class="image-zoom" src="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" data-zoom="{{ env('APP_URL') . '/storage/app/' . $sanpham->hinhanh }}" width="0" />
										<div class="image-zoom-pane"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-5 pt-4 pt-lg-0">
							<div class="product-details ms-auto pb-3">
								<div class="d-flex justify-content-between align-items-center mb-2">
								</div>
								<div class="mb-3 text-center ">
									<span class="h3 fw-normal text-accent me-1">{{ number_format($sanpham->dongia, 0, ',', '.') }}<small> đồng </small></span>
								</div>
								<div class="card-body card-body-hidden">
                    <a class="btn btn-primary btn-sm d-block w-100 mb-2" href="{{ route('frontend.giohang.them', ['tensanpham_slug' => $sanpham->tensanpham_slug]) }}">
                        <i class="ci-cart fs-sm me-1"></i>Thêm vào giỏ hàng
                    </a>
                </div>
										<div class="pt-6 mt-5 text-center">
										<h3 class="accordion">
											<a class="pack_info_top " href="#" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="productInfo">
												<i class="title"></i>THÔNG TIN CƠ BẢN
											</a>
										</h3>
										<hr>
										</div>
										
										<div class="accordion-collapse collapse show" id="productInfo" data-bs-parent="#productPanels">
											<div class="accordion-body">
												<p>{!!$sanpham->motasanpham!!}</p>
											</div>
										</div>
									</div>
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection

