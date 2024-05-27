<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>{{ config('app.name', 'Laravel') }}</title>
<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
<link rel="stylesheet" href="{{ asset('public/vendor/font-awesome/css/all.min.css') }}" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/img/logo2.jpg') }}" />
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/img/logo2.jpg') }}" />
@yield('css')
<!-- <link rel="stylesheet" href="{{ asset('public/css/site.css') }}" /> -->
</head>
<body>
    <div class="container">
        <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <form action="{{route('frontend.search')}}" class="form-inline">
                        <div class="form-group d-none d-lg-flex mx-4">
                            <input class="form-control rounded-end pe-5" type="text" name="key" placeholder="Tìm kiếm" />
                            <i class="ci-search position-absolute top-50 end-0 translate-middle-y text-muted fs-base me-3"></i>
                        </div>
                </form>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Quản lý sản phẩm
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.loaisanpham')}}"><i class="fa-light fa-fw fa-diagram-project"></i>Loại sản phẩm</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.hangsanxuat')}}"><i class="fa-light fa-fw fa-copyright"></i>Hãng sản xuất</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.tinhtrang')}}"><i class="fa-light fa-fw fa-list-check"></i>Tình trạng</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('admin.sanpham')}}"><i class="fa-light fa-fw fa-box"></i> Sản phẩm</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.donhang')}}"><i class="fa-light fa-fw fa-file-invoice"></i> Đơn hàng</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.vanchuyen')}}"><i class="fa-light fa-fw fa-file-invoice"></i> Vận chuyển</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown"> 
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> 
                                <i class="fa-light fa-fw fa-newspaper"></i> Quản lý bài viết 
                            </a> 
                            <ul class="dropdown-menu"> 
                                <li> 
                                    <a class="dropdown-item" href="{{ route('admin.chude') }}"> 
                                        <i class="fa-light fa-fw fa-list-tree"></i> Chủ đề 
                                    </a> 
                                </li> 
                                <li><hr class="dropdown-divider"></li> 
                                <li> 
                                    <a class="dropdown-item" href="{{ route('admin.baiviet') }}"> 
                                        <i class="fa-light fa-fw fa-newspaper"></i> Bài viết 
                                    </a> 
                                </li> 
                                <li> 
                                    <a class="dropdown-item" href="{{ route('admin.binhluanbaiviet') }}"> 
                                        <i class="fa-light fa-fw fa-comments"></i> Bình luận bài viết 
                                    </a> 
                                </li> 
                            </ul> 
                        </li> 
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.nguoidung') }}"><i class="bi bi-people"></i> Tài khoản</a>
                        </li>      
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Đăng nhập</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="bi bi-person-plus"></i> Đăng ký</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#nguoidung" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right"></i> Đăng xuất
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="pt-3 pb-2">
            @yield('content')
        </main>

        <hr class="shadow-sm" />

    </div>
    <div class="container">
  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0 text-body-secondary">&copy; 2024 Company, Hayori</p>

    <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
    </a>

    
  </footer>
</div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    @yield('javascript')
</body>
</html>