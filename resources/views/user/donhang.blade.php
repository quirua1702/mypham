@extends('layouts.frontend')
@section('title', 'Đơn hàng')
@section('content')
							
								<li class="d-lg-none border-top mb-0">
									<a class="nav-link-style d-flex align-items-center px-4 py-3" href="#">
										<i class="ci-sign-out opacity-60 me-2"></i>Đăng xuất
									</a>
								</li>
							</ul>
						</div>
					</div>
				</aside>
				<section class="col-lg-8">
					<div class="d-flex justify-content-between align-items-center pt-lg-2 pb-4 pb-lg-5 mb-lg-3">
						<div class="d-flex align-items-center">	
					</div>
					</div>
					@foreach($donhang as $item)
					<div class="text-center">
						<table class="table table-hover mb-0">
							<thead>
								<tr>
									<th>Tên người đặt</th>
									<th>Tình trạng </th>
									<th>Điện thoại đặt hàng</th>
									<th>Ngày đặt</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="py-3"><a class="nav-link-style fw-medium fs-sm" href="#">{{ $item->NguoiDung->name }}</a></td>
									<td class="py-3"><span class="badge bg-info m-0">{{ $item->TinhTrang->tinhtrang }}</span></td>
									<td class="py-3"><span class="badge bg-info m-0">{{ $item->dienthoaigiaohang }}</span></td>
									<td class="py-3">{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at)->format('d/m/Y H:i:s') }}</td>
								</tr>
								
							</tbody>
						</table>
					</div>
					@endforeach

				</section>
			</div>
		</div>
@endsection