<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Đặt hàng thành công - {{ config('app.name', 'Laravel') }}</title>
    <style>
        table {
        border-collapse: collapse;
        width: 100%;
        }
        p {
        margin-top: 3px;
        margin-bottom: 3px;
        }
    </style>
</head>
    <body>
        <p>Xin chào {{ Auth::user()->name }}!</p>
        <p>Xin cảm ơn bạn đã đặt hàng tại {{ config('app.name', 'Mobifone') }}.</p>
        <p>Mã đơn hàng: {{rand(10000,999)}}</p>
        <p>- Điện thoại: <strong>{{ $donhang->dienthoaigiaohang }}</strong></p>
        @if(Session::has('fee'))
        <p>Phí vận chuyển: {{ number_format(Session::get('fee'), 0, ',', '.') }}<small>đ</small></p>
        @endif
        <p>Thông tin đơn hàng bao gồm:</p>
        <table border="1">
    <thead>
        <tr>
            <th>STT</th>
            <th>Sản phẩm</th>
            <th>Mô tả</th>
            <th>SL</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>
        @php $tongtien = 0; @endphp
        @foreach($donhang->DonHang_ChiTiet as $chitiet)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $chitiet->SanPham->tensanpham }}</td>
                <td>{{ $chitiet->SanPham->motasanpham }}</td>
                <td>{{ $chitiet->soluongban }}</td>
                <td style="text-align:right">
                {{ number_format($chitiet->dongiaban) }}<sup><u>đồng</u></sup>
                </td>

                <td style="text-align:right">

                {{ number_format($chitiet->soluongban * $chitiet->dongiaban ) }}<sup><u>đ</u></sup>
                </td>
            </tr>
            @php $tongtien += $chitiet->soluongban * $chitiet->dongiaban; @endphp
            @endforeach
            <!-- Tính tổng tiền bao gồm cả phí vận chuyển -->
            @if(Session::has('fee'))
            @php $tongtien += Session::get('fee'); @endphp
            <tr>
                <td colspan="5">Phí vận chuyển:</td>
                <td style="text-align:right">
                    {{ number_format(Session::get('fee')) }}<sup><u>đ</u></sup>
                </td>
            </tr>
            @endif
            <!-- Kết thúc tính tổng tiền -->
            <tr>
                <td colspan="4">Tổng tiền sản phẩm:</td>
                <td style="text-align:right">
                <strong>{{ number_format($tongtien) }}</strong><sup><u>đ</u></sup>
                </td>
            </tr>
    </tbody>
    </table>
    <p>Trân trọng,</p>
    <p>{{ config('app.name', 'Laravel') }}</p>
    </body>
</html>