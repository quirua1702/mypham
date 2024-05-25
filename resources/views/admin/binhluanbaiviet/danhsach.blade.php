@extends('layouts.app') 
 
@section('content') 
    <div class="card"> 
        <div class="card-header">Bình luận bài viết</div> 
        <div class="card-body table-responsive"> 
            <p><a href="{{ route('admin.binhluanbaiviet.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a></p> 
            <table class="table table-bordered table-hover table-sm mb-0"> 
                <thead> 
                    <tr> 
                        <th width="5%">#</th> 
                        <th width="20%">Người đăng</th> 
                        <th width="55%">Thông tin bình luận</th> 
                        <th class="text-center" width="5%">Sửa</th>
                        <th class="text-center" width="5%">Xóa</th>
                    </tr> 
                </thead> 
                <tbody> 
                    @foreach($binhluanbaiviet as $value) 
                        <tr> 
                            <td>{{ $loop->iteration }}</td> 
                            <td>{{ $value->NguoiDung->name }}</td> 
                            <td style="text-align:justify"> 
                                <span class="d-block fw-bold text-primary"><a href="{{ route('admin.binhluanbaiviet.sua', ['id' => $value->id]) }}">{{ $value->BaiViet->tieude }}</a></span> 
                                <span class="d-block small"> 
                                    Ngày đăng: <strong>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d/m/Y H:i:s') }}</strong> 
                                    <br />Nội dung bình luận: <strong>{{ $value->comment }}</strong> 
                                </span> 
                            </td> 
       
                           
                            <td class="text-center"><a href="{{ route('admin.binhluanbaiviet.sua', ['id' => $value->id]) }}"><i class="bi bi-pencil-square"></i>sửa</a></td>
                            <td class="text-center"><a href="{{ route('admin.binhluanbaiviet.xoa', ['id' => $value->id]) }}"><i class="bi bi-trash text-danger"></i>xóa</a></td>
                        </tr> 
                    @endforeach 
                </tbody> 
            </table> 
        </div> 
    </div> 
@endsection 