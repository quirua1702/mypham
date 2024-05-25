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
            <select name="province" id="province" class="form-control choose province">
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
            <label for="fee_ship">Phí vận chuyển</label>
            <input type="text" name="fee_ship" class="form-control fee_ship">
        </div>
        <hr>
        <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
    </form>
    
@endsection 