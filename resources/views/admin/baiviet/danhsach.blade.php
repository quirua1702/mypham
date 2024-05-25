@extends('layouts.app') 
 
@section('content') 
    <div class="card"> 
        <div class="card-header">Bài viết</div> 
        <div class="card-body table-responsive"> 
            <p><a href="{{ route('admin.baiviet.them') }}" class="btn btn-info"><i class="fa-light fa-plus"></i> Thêm mới</a></p> 
            <table class="table table-bordered table-hover table-sm mb-0"> 
                <thead> 
                    <tr> 
                        <th  class="text-center" width="5%">#</th> 
                        <th  class="text-center" width="15%">Chủ đề</th> 
                        <th  class="text-center" width="45%">Thông tin bài viết</th> 
                        <th class="text-center" width="25%">Hình ảnh</th>
                        <th class="text-center" width="5%">Sửa</th>
                        <th class="text-center" width="5%">Xóa</th>
                    </tr> 
                </thead> 
                <tbody> 
                    @foreach($baiviet as $bv) 
                        <tr> 
                            <td>{{ $loop->iteration }}</td> 
                            <td>{{ $bv->ChuDe->tenchude }}</td> 
                            <td> 
                                <span class="d-block fw-bold text-primary"><a href="{{ route('admin.baiviet.sua', ['id' => $bv->id]) }}">{{ $bv->tieude }}</a></span> 
                                <span class="d-block small"> 
                                    Ngày đăng: <strong>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $bv->created_at)->format('d/m/Y H:i:s') }}</strong> 
                                </span> 
                            </td> 
                            <td class="text-center"><img src="{{ env('APP_URL') . '/public/uploads/' . $bv->hinh }}" width="80" class="img-thumbnail" /></td>
                            <td class="text-center"><a href="{{ route('admin.baiviet.sua', ['id' => $bv->id]) }}"><i class="bi bi-pencil-square"></i>sửa</a></td>
                            <td class="text-center"><a href="{{ route('admin.baiviet.xoa', ['id' => $bv->id]) }}"><i class="bi bi-trash text-danger"></i>xóa</a></td>
                        </tr> 
                    @endforeach 
                </tbody> 
            </table> 
        </div> 
    </div> 
@endsection