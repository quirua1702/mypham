@extends('layouts.app') 
 
@section('content') 
    <div class="card"> 
        <div class="card-header">Vận chuyển</div> 
        <div class="card-body table-responsive"> 
            
        <form>
        @csrf
        <div class="form-group">
            <label for="city">Chọn thành phố</label>
            <select name="city" id="city" class="form-control choose city">
                <option value="">--Chọn tỉnh thành phố--</option>
                @foreach ($city as $ct)
                <option value="{{$ct->matp}}">{{$ct->name_city}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="province">Chọn quận huyện</label>
            <select name="province" id="province" class="form-control province choose">
                <option value="">--Chọn quận huyện--</option>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="wards">Chọn xã phường</label>
            <select name="wards" id="wards" class="form-control wards">
                <option value="">--Chọn xã phường--</option>
            </select>
        </div>
        <br>
        <div class="form-group">
            <label for="exampleInputEmail">Phí vận chuyển</label>
            <input type="text" name="fee_ship" class="form-control fee_ship" id="exampleInputEmail">
        </div>
        <br>
        <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
    </form>
    </div>
    <div id="load_delivery">

    </div>
    
@endsection 
@section('javascript') 
<script type="text/javascript">
        $(document).ready(function(){
            $('.add_delivery').click(function(){
                var city = $('.city').val();
                var province = $('.province').val();
                var wards = $('.wards').val();
                var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val();
                // alert(city);
                // alert(province);
                // alert(wards);
                // alert(fee_ship);
                $.ajax({
                    url: "{{ route('admin.insert_delivery') }}", // Sử dụng route Laravel đúng cách
                    method: 'POST',
                    data:{city: city, province: province,_token:"{{ csrf_token() }}", wards: wards, fee_ship: fee_ship},
                    success:function(data){
                        alert('Thêm phí vận chuyển thành công');
                    }
            })
        })
            });
            $('.choose').on('change', function(){
                var action = $(this).attr('id');
                var ma_id = $(this).val(); // Lấy giá trị của phần tử chọn hiện tại
                var _token = $('input[name="_token"]').val();
                var result = '';

                if(action == 'city'){
                    result = 'province';
                } else if(action == 'province'){
                    result = 'wards';
                }

                console.log('Action:', action); // Ghi log dữ liệu
                console.log('ID:', ma_id); // Ghi log dữ liệu

                $.ajax({
                    url: "{{ route('admin.select_delivery') }}", // Sử dụng route Laravel đúng cách
                    method: 'POST',
                    data: {action: action, ma_id: ma_id, _token: _token},
                    success: function(data){
                        console.log('Response:', data); // Ghi log dữ liệu
                        $('#' + result).html(data);
                    }
                });
            });
    </script>
@endsection