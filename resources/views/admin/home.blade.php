@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-aqua">
      <div class="inner">
          <h3>{{$sanpham_count}}</h3>
          <p>Tổng sản phẩm</p>
      </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ route('admin.sanpham') }}" class="small-box-footer">Xem <i class="fa fa-arrow-circle-right"></i></a>
    </div>
  </div>

    <div class="col-lg-3 col-xs-6">

      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$donhang_count}}</h3>
          <p>Tổng số đơn hàng</p>
        </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
        <a href="{{ route('admin.donhang') }}" class="small-box-footer">Xem<i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">

      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$nguoidung_count}}</h3>
          <p>Tổng số người dùng</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
          <a href="{{ route('admin.nguoidung') }}" class="small-box-footer">Xem<i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">

      <div class="small-box bg-red">
        
      </div>
  </div>

</div>


<hr>
<table class="table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Tên khách hàng</th>
      <th scope="col">Ngày đặt</th>
      <th scope="col">Tình trạng</th>
    </tr>
  </thead>
  <tbody>
    @foreach($donhang as $dh)
    <tr>
      <th scope="row">{{ $loop->iteration }}</th>
      <td>{{$dh->nguoidung->name}}</td>
      <td>{{$dh->created_at}}</td>
      <td>{{$dh->TinhTrang->tinhtrang}}</td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection