@extends('layouts.app')

@section('content')
        </div>
        <div class="card-body table-responsive">
            <p>
                </p>
            <table class="table table-bordered table-hover table-sm mb-0">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">Khách hàng</th>
                        <th width="45%">Thông tin giao hàng</th>
                        <th width="15%">Ngày đặt</th>
                        <th width="10%">Tình trạng</th>
                        <th width="5%">Sửa</th>
                        <th width="5%">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donhang as $value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->NguoiDung->name }}</td>
                            <td>
                                <span class="d-block">Điện thoại: <strong>{{ $value->dienthoaigiaohang }}</strong></span>
                                <span class="d-block">Sản phẩm:</span>
                                <table class="table table-bordered table-hover table-sm mb-0">
                                    <thead>
                                        <tr>
                                            <th  class="text-end" width="5%">#</th>
                                            <th  class="text-end" with="45%">Sản phẩm</th>
                                            <th  class="text-end" width="5%">SL</th>
                                            <th  class="text-end" width="15%">Đơn giá</th>
                                            <th  class="text-end" width="20%">Thành tiền</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $tongtien = 0; @endphp
                                        @foreach($value->DonHang_ChiTiet as $chitiet)
                                            <tr>
                                                <td class="text-end">{{ $loop->iteration }}</td>
                                                <td class="text-end">{{ $chitiet->SanPham->tensanpham}}</td>
                                                <td class="text-end">{{ $chitiet->soluongban }}</td>
                                                <td class="text-end">{{ number_format($chitiet->dongiaban) }}<sup><u>đ</u></sup></td>
                                                <td class="text-end">{{ number_format($chitiet->soluongban * $chitiet->dongiaban) }}<sup><u>đ</u></sup></td>
                                            </tr>
                                            @php $tongtien += $chitiet->soluongban * $chitiet->dongiaban; @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="4">Tổng tiền sản phẩm:</td>
                                            <td class="text-end"><strong>{{ number_format($tongtien) }}</strong><sup><u>đ</u></sup></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td>{{ $value->created_at->format('d/m/Y H:i:s') }}</td>
                            <td>{{ $value->TinhTrang->tinhtrang }}</td>
                            <td class="text-center"><a href="{{ route('admin.donhang.sua', ['id' => $value->id]) }}"><i class="bi bi-pencil-square"></i>sửa</a></td>
                            <td class="text-center"><a href="{{ route('admin.donhang.xoa', ['id' => $value->id]) }}"><i class="bi bi-trash text-danger"></i>xóa</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
      
        </div>
    </div>
@endsection