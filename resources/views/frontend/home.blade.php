@extends('layouts.frontend')
@section('title', 'Trang chủ')
@section('content')
    <section class="container mt-4 mb-grid-gutter">
        <div class="bg-faded-info rounded-3 py-4">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <div class="px-4 pe-sm-0 ps-sm-5">
                        <span class="badge bg-danger" class="badge badge-blue-large">{{__('lang.sale')}}</span>
                        <h3 class="mt-4 mb-1 text-body fw-light">{{__('lang.thuanchay')}}</h3>
                        <h2 class="mb-1">{{__('lang.doitra')}}</h2>
                        <p class="h5 text-body fw-light">{{__('lang.slsp')}}</p>
                        <a href="{{ route('frontend.sanpham') }}" class="btn btn-accent" >{{__('lang.xemthem')}}</a>
                    </div>
                </div>
                <div class="col-md-6"><img src="https://afamilycdn.com/150157425591193600/2020/10/25/unnamed-1603594038733518662446-1603597809763-16035978102911281582020.jpg" /></div>
            </div>
        </div>
    </section>
    <section class="container">
        <div class="tns-carousel border-end">
            <div class="tns-carousel-inner" data-carousel-options="{ &quot;nav&quot;: false, &quot;controls&quot;: false, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000, &quot;loop&quot;: true, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:1},&quot;360&quot;:{&quot;items&quot;:2},&quot;600&quot;:{&quot;items&quot;:3},&quot;991&quot;:{&quot;items&quot;:4},&quot;1200&quot;:{&quot;items&quot;:4}} }">
                
            </div>
        </div>
    </section>
    @foreach($loaisanpham as $lsp)
    <section class="container pt-3 pb-2">
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
            <h2 class="h3 mb-0 pt-3 me-2">{{ $lsp->tenloai }}</h2>
                <div class="pt-3">
                    <a class="btn btn-outline-accent btn-sm" href="{{ route('frontend.sanpham', ['tenloai_slug' => $lsp->tenloai_slug]) }}">
                    {{__('lang.xemthem')}}<i class="ci-arrow-right ms-1 me-n1"></i>
                    </a>
                </div>
        </div>
        <div class="row pt-2 mx-n2">
            @foreach($lsp->SanPham->take(8) as $sp)
                <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card product-card">
                        <a class="card-img-top d-block overflow-hidden" href="{{route('frontend.sanpham.chitiet', ['tenloai_slug' => $lsp->tenloai_slug, 'tensanpham_slug' => $sp->tensanpham_slug]) }}">
                            <img src="{{ env('APP_URL') . '/storage/app/' . $sp->hinhanh }}" />
                        </a>
                    <div class="card-body py-2">
                        <a class="product-meta d-block fs-xs pb-1" href="{{route('frontend.sanpham.chitiet', ['tenloai_slug' => $lsp->tenloai_slug, 'tensanpham_slug' => $sp->tensanpham_slug]) }}">{{ $sp->tensanpham }}</a>
                            <h3 class="product-title fs-sm">
                                <a href="{{ route('frontend.sanpham.chitiet', ['tenloai_slug' => $lsp->tenloai_slug, 'tensanpham_slug' => $sp->tensanpham_slug]) }}"></a>
                            </h3>
        
                   
                            <div class="product-price">
                                <span class="text-accent">{{ number_format($sp->dongia, 0, ',', '.') }}<small>đ</small></span>
                            </div>
                    </div>
                <div class="card-body card-body-hidden">
                    <a class="btn btn-primary btn-sm d-block w-100 mb-2" href="{{ route('frontend.giohang.them', ['tensanpham_slug' => $sp->tensanpham_slug]) }}">
                        <i class="ci-cart fs-sm me-1"></i>{{__('lang.themvaogiohang')}}
                    </a>
                </div>
        </div>
        <hr class="d-sm-none">
        </div>
        @endforeach
        </div>
    </section>
@endforeach
@endsection
