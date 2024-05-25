@extends('layouts.frontend') 
@section('title', $baiviet) 
@section('content') 
    <div class="bg-secondary py-4"> 
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3"> 
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2"> 
                <nav aria-label="breadcrumb"> 
                    <ol class="breadcrumb flex-lg-nowrap justify-content-center justify-content-lg-start"> 
                        <li class="breadcrumb-item"> 
                            <a class="text-nowrap" href="{{ route('frontend.home') }}"><i class="ci-home"></i>Trang chủ</a> 
                        </li> 
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">{{ $baiviet }}</li> 
                    </ol> 
                </nav> 
            </div> 
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start"> 
                <h1 class="h3 mb-0">{{ $baiviet }}</h1> 
            </div> 
        </div> 
    </div> 
     
    <div class="container pb-5 mb-2 mb-md-4"> 
        <div class="pt-3 mt-md-3"> 
            <div class="masonry-grid" data-columns="3"> 

                @foreach($baiviet as $value) 
                    <article class="masonry-grid-item"> 
                        <div class="card">
                            <a class="blog-entry-thumb" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => $value->ChuDe->tenchude_slug, 'tieude_slug' => $value->tieude_slug]) }}">
                            <img src="{{ env('APP_URL') . '/public/uploads/' . $value->hinh }}"/>
                            </a> 
                            <div class="card-body"> 
                                <h2 class="h6 blog-entry-title">
                                    <a href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => $value->ChuDe->tenchude_slug, 'tieude_slug' => $value->tieude_slug]) }}"> 
                                        {{ $value->tieude }} 
                                    </a> 
                                </h2> 
                                <p class="fs-sm" style="text-align:justify">{{ $value->tomtat }}</p> 
                                <a class="btn-tag me-2 mb-2" href="{{ route('frontend.baiviet.chitiet', ['tenchude_slug' => $value->ChuDe->tenchude_slug, 'tieude_slug' => $value->tieude_slug]) }}">{{ $value->ChuDe->tenchude }}</a> 
                            </div> 
                            <div class="card-footer d-flex align-items-center fs-xs"> 
                                <div class="ms-auto text-nowrap"> 
                                    <a class="blog-entry-meta-link text-nowrap" href="#date">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y') }}</a> 
                                    <span class="blog-entry-meta-divider mx-2"></span>  
                                </div> 
                            </div> 
                            
                        </div> 
                    </article> 
                    
                @endforeach 
        </div> 
    </div> 
@endsection 