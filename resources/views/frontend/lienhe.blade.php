@extends('layouts.frontend')
@section('title', 'Liên hệ')
@section('content')
		
		<div class="bg-secondary py-4">
			<div class="container d-lg-flex justify-content-between py-2 py-lg-3">
				<div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start">
							<li class="breadcrumb-item">
								<a class="text-nowrap" href="{{route('frontend.home')}}"><i class="ci-home"></i>Trang chủ</a>
							</li>
							<li class="breadcrumb-item text-nowrap active" aria-current="page">Liên hệ</li>
						</ol>
					</nav>
				</div>
				<div class="order-lg-1 pe-lg-4 text-center text-lg-start">
					<h1 class="h3 mb-0">Liên hệ</h1>
				</div>
			</div>
		</div>
		
		<section class="container-fluid pt-grid-gutter">
			<div class="row">
				<div class="col-xl-3 col-sm-6 mb-grid-gutter">
					<a class="card h-100" href="#map" data-scroll>
						<div class="card-body text-center">
							<i class="ci-location h3 mt-2 mb-4 text-primary"></i>
							<h3 class="h6 mb-2">Địa chỉ cửa hàng</h3>
							<p class="fs-sm text-muted">Số 278/8A, Mỹ Hòa, Thành Phố Long Xuyên Tinh An Giang.</p>
							<div class="fs-sm text-primary">Xem bản đồ<i class="ci-arrow-right align-middle ms-1"></i></div>
						</div>
					</a>
				</div>
				<div class="col-xl-3 col-sm-6 mb-grid-gutter">
					<div class="card h-100">
						<div class="card-body text-center">
							<i class="ci-time h3 mt-2 mb-4 text-primary"></i>
							<h3 class="h6 mb-3">Giờ làm việc</h3>
							<ul class="list-unstyled fs-sm text-muted mb-0">
								<li>Thứ 2 - Thứ 6: 08:00 AM - 05:00 PM</li>
								<li class="mb-0">Thứ 7 - Chủ Nhật: 10:00 AM - 21:00 PM</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 mb-grid-gutter">
					<div class="card h-100">
						<div class="card-body text-center">
							<i class="ci-phone h3 mt-2 mb-4 text-primary"></i>
							<h3 class="h6 mb-3">Điện thoại</h3>
							<ul class="list-unstyled fs-sm mb-0">
								<li>
									<span class="text-muted me-1">Bán hàng:</span>
									<a class="nav-link-style" href="tel:+84123456888">+84 0123 456 888</a>
								</li>
								<li class="mb-0">
									<span class="text-muted me-1">Hỗ trợ kỹ thuật:</span>
									<a class="nav-link-style" href="tel:+84123456999">+84 0123 456 999</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-sm-6 mb-grid-gutter">
					<div class="card h-100">
						<div class="card-body text-center">
							<i class="ci-mail h3 mt-2 mb-4 text-primary"></i>
							<h3 class="h6 mb-3">Địa chỉ email</h3>
							<ul class="list-unstyled fs-sm mb-0">
								<li>
									<span class="text-muted me-1">Bán hàng:</span>
									<a class="nav-link-style" href="mobifone@larashop.vn">hayori@larashop.vn</a>
								</li>
								<li class="mb-0">
									<span class="text-muted me-1">Hỗ trợ kỹ thuật:</span>
									<a class="nav-link-style" href="mobifone@larashop.vn">hayori@larashop.vn</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<div class="container-fluid px-0" id="map">
			<div class="row g-0">
				<div class="col-lg-15 iframe-full-height-wrap">
					<iframe class="iframe-full-height" width="600" height="250" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3924.75213735956!2d105.41114757389903!3d10.361692889763008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310a73000421fccf%3A0x3991ad35fc27677b!2zU2hvcCBt4bu5IHBo4bqpbSBIYXlvcmk!5e0!3m2!1svi!2s!4v1715565782010!5m2!1svi!2s"></iframe>
				</div>
			</div>
		</div>
	</main>
   
	@endsection	
	