<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use Illuminate\Support\Facades\Log;
use App\Models\Feeship;
class DeliveryController extends Controller
{
    public function vanchuyen(Request $request){
        $city = City::orderBy('matp','ASC')->get();
        return view('admin.delivery.add_delivery')->with(compact('city'));
    }

    public function insert_delivery(Request $request){
        try {
            $data = $request->all();
            $fee_ship = new Feeship();
            $fee_ship->fee_matp = $data['city'];
            $fee_ship->fee_maqh = $data['province'];
            $fee_ship->fee_xaid = $data['wards'];
            $fee_ship->fee_feeship = $data['fee_ship'];
            $fee_ship->save();
            Log::info('Inserted feeship record successfully.');
            return response()->json(['success' => 'Phí vận chuyển đã được thêm thành công'], 200);
        } catch (\Exception $e) {
            Log::error('Error in insert_delivery: ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra khi thêm phí vận chuyển'], 500);
        }
    }
    public function select_delivery(Request $request) {
        $data = $request->all();
        $output = '';

        if(isset($data['action'])) {
            if($data['action'] == "city") {
                $select_province = Province::where('matp', $data['ma_id'])->orderBy('maqh', 'ASC')->get();

                // Log dữ liệu đầu vào và kết quả truy vấn
                Log::info('City ID: ' . $data['ma_id']);
                Log::info('Provinces: ', $select_province->toArray());

                $output .= '<option value="">--Chọn quận huyện--</option>';
                foreach($select_province as $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } elseif ($data['action'] == "province") {
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderBy('xaid', 'ASC')->get();

                // Log dữ liệu đầu vào và kết quả truy vấn
                Log::info('Province ID: ' . $data['ma_id']);
                Log::info('Wards: ', $select_wards->toArray());

                $output .= '<option value="">--Chọn xã phường--</option>';
                foreach($select_wards as $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
        }

        return response()->json($output);
    }

}
    
    
    

