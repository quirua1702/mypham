<?php 
 
namespace App\Http\Controllers; 
 
use App\Models\NguoiDung; 
use App\Models\DonHang; 
use App\Models\DonHang_ChiTiet; 
use App\Mail\DatHangEmail;
use Illuminate\Http\Request; 
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\Auth; 
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Exception;
class KhachHangController extends Controller 
{ 
    public function getHome() 
    { 
        if(Auth::check()) 
        { 
            $nguoidung = NguoiDung::find(Auth::user()->id); 
            return view('user.home', compact('nguoidung')); 
        } 
        else 
            return redirect()->route('user.dangnhap');
    } 
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function momo_payment(Request $request){
        
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = "10000";
        $orderId = time() ."";
        $redirectUrl = "http://localhost:81/laravel/mypham/khach-hang/dat-hang";
        $ipnUrl = "http://localhost:81/laravel/mypham/khach-hang/dat-hang";
        $extraData = "";


       

            $requestId = time() . "";
            $requestType = "payWithATM";
            // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            // dd($signature);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);

            $result = $this-> execPostRequest($endpoint, json_encode($data));
            // dd($result);
            $jsonResult = json_decode($result, true);  // decode json

            //Just a example, please check more in there
            return redirect()->to($jsonResult['payUrl']);
            // header('Location: ' . $jsonResult['payUrl']);        
        }
    


    public function one_payment(Request $request){

        /* -----------------------------------------------------------------------------
        
         Version 2.0
        
         @author OnePAY
        
        ------------------------------------------------------------------------------*/
        
        // *********************
        // START OF MAIN PROGRAM
        // *********************
        
        // Define Constants
        // ----------------
        // This is secret for encoding the MD5 hash
        // This secret will vary from merchant to merchant
        // To not create a secure hash, let SECURE_SECRET be an empty string - ""
        // $SECURE_SECRET = "secure-hash-secret";
        // Khóa bí mật - được cấp bởi OnePAY
        $SECURE_SECRET = "A3EFDFABA8653DF2342E8DAC29B51AF0";
        
        // add the start of the vpcURL querystring parameters
        // *****************************Lấy giá trị url cổng thanh toán*****************************
        $vpcURL = 'https://mtf.onepay.vn/onecomm-pay/vpc.op' . "?";//dấu ? mang đằng sau những giá trị
        
        // Remove the Virtual Payment Client URL from the parameter hash as we 
        // do not want to send these fields to the Virtual Payment Client.
        // bỏ giá trị url và nút submit ra khỏi mảng dữ liệu
        // unset($_POST["virtualPaymentClientURL"]); 
        // unset($_POST["SubButL"]);
        
        //$stringHashData = $SECURE_SECRET; *****************************Khởi tạo chuỗi dữ liệu mã hóa trống*****************************
        $stringHashData = "";
        // sắp xếp dữ liệu theo thứ tự a-z trước khi nối lại
        // arrange array data a-z before make a hash
        $vpc_Merchant ='ONEPAY';
        $vpc_AccessCode ='D67342C2';
        $vpc_MerchTxnRef =time();
        $vpc_OrderInfo ='JSECURETEST01';
        $vpc_Amount = $_POST['total_onepay'];
        $vpc_ReturnURL ='http://localhost/domestic_php_v2/source_code/dr.php';
        $vpc_Version ='2';
        $vpc_Command ='pay';
        $vpc_Locale ='vn';
        $vpc_Currency ='VND';

        $data = array(
            'vpc_Merchant' => $vpc_Merchant,
            'vpc_AccessCode' => $vpc_AccessCode,
            'vpc_MerchTxnRef' => $vpc_MerchTxnRef,
            'vpc_OrderInfo' => $vpc_OrderInfo,
            'vpc_Amount' => $vpc_Amount,
            'vpc_ReturnURL' => $vpc_ReturnURL,
            'vpc_Version' => $vpc_Version,
            'vpc_Command' => $vpc_Command,
            'vpc_Locale' => $vpc_Locale,
            'vpc_Currency' => $vpc_Currency,

            


        );
        ksort ($data);
        
        // set a parameter to show the first pair in the URL
        // đặt tham số đếm = 0
        $appendAmp = 0;
        
        foreach($data as $key => $value) {
        
            // create the md5 input and URL leaving out any fields that have no value
            // tạo chuỗi đầu dữ liệu những tham số có dữ liệu
            if (strlen($value) > 0) {
                // this ensures the first paramter of the URL is preceded by the '?' char
                if ($appendAmp == 0) {
                    $vpcURL .= urlencode($key) . '=' . urlencode($value);
                    $appendAmp = 1;
                } else {
                    $vpcURL .= '&' . urlencode($key) . "=" . urlencode($value);
                }
                //$stringHashData .= $value; *****************************sử dụng cả tên và giá trị tham số để mã hóa*****************************
                if ((strlen($value) > 0) && ((substr($key, 0,4)=="vpc_") || (substr($key,0,5) =="user_"))) {
                    $stringHashData .= $key . "=" . $value . "&";
                }
            }
        }
        //*****************************xóa ký tự & ở thừa ở cuối chuỗi dữ liệu mã hóa*****************************
        $stringHashData = rtrim($stringHashData, "&");
        // Create the secure hash and append it to the Virtual Payment Client Data if
        // the merchant secret has been provided.
        // thêm giá trị chuỗi mã hóa dữ liệu được tạo ra ở trên vào cuối url
        if (strlen($SECURE_SECRET) > 0) {
            //$vpcURL .= "&vpc_SecureHash=" . strtoupper(md5($stringHashData));
            // *****************************Thay hàm mã hóa dữ liệu*****************************
            $vpcURL .= "&vpc_SecureHash=" . strtoupper(hash_hmac('SHA256', $stringHashData, pack('H*',$SECURE_SECRET)));
        }
        
        // FINISH TRANSACTION - Redirect the customers using the Digital Order
        // ===================================================================
        // chuyển trình duyệt sang cổng thanh toán theo URL được tạo ra
        // header("Location: ".$vpcURL);
        return redirect()->to($vpcURL);
        
        // *******************
        // END OF MAIN PROGRAM
        // *******************        
        
        }
     
    public function getDatHang() 
    { 
        if(Auth::check()) 
            return view('user.dathang'); 
        else 
            return redirect()->route('user.dangnhap'); 
    } 
     
    public function postDatHang(Request $request) 
    { 
        // Kiểm tra 
        $this->validate($request, [ 
            'diachigiaohang' => ['required', 'string', 'max:255'], 
            'dienthoaigiaohang' => ['required', 'string', 'max:255'], 
        ]); 
         
        // Lưu vào đơn hàng 
        $dh = new DonHang(); 
        $dh->nguoidung_id = Auth::user()->id; 
        $dh->tinhtrang_id = 1; // Đơn hàng mới 
        $dh->diachigiaohang = $request->diachigiaohang; 
        $dh->dienthoaigiaohang = $request->dienthoaigiaohang; 
        $dh->save();
         
        // Lưu vào đơn hàng chi tiết 
        foreach(Cart::content() as $value) 
        { 
            $ct = new DonHang_ChiTiet(); 
            $ct->donhang_id = $dh->id; 
            $ct->sanpham_id = $value->id; 
            $ct->soluongban = $value->qty; 
            $ct->dongiaban = $value->price; 
            $ct->save(); 
        }
        //gởi mail
        try{
            Mail::to(Auth::user()->email)->send(new DatHangEmail($dh));

        }
        catch(Exception $e)
        {
            return $e ->getMessage();
        }
        return redirect()->route('user.dathangthanhcong');
         
        
    } 
     
    public function getDatHangThanhCong() 
    { 
        // Xóa giỏ hàng khi hoàn tất đặt hàng? 
        Cart::destroy(); 
         
        return view('user.dathangthanhcong'); 
    } 
     
    public function getDonHang($id = '') 
    { 
        // Lấy ID của người dùng hiện tại
    $nguoidung_id = Auth::id();

    // Lấy lịch sử đơn hàng của người dùng đó
    $donhang = DonHang::where('nguoidung_id', $nguoidung_id)
                            ->orderBy('created_at', 'desc')
                            ->get();
        //dd($donhang);
        // Trả về view hiển thị lịch sử đơn hàng
        return view('user.donhang')->with(compact('donhang'));
    } 
     
    public function postDonHang(Request $request, $id) 
    { 
        // Bổ sung code tại đây 
    } 
     
    public function getHoSoCaNhan() 
    { 
        return redirect()->route('user.home'); 
    } 
     
    public function postHoSoCaNhan(Request $request) 
    { 
        $id = Auth::user()->id; 
         
        $request->validate([ 
            'name' => ['required', 'string', 'max:100'], 
            'email' => ['required', 'string', 'email', 'max:255', 'unique:nguoidung,email,' . $id], 
            'password' => ['confirmed'], 
        ]); 
         
        $orm = NguoiDung::find($id); 
        $orm->name = $request->name; 
        $orm->username = Str::before($request->email, '@'); 
        $orm->email = $request->email; 
        if(!empty($request->password)) $orm->password = Hash::make($request->password); 
        $orm->save(); 
         
        return redirect()->route('user.home')->with('success', 'Đã cập nhật thông tin thành công.');
    } 
     
    public function postDangXuat(Request $request) 
    { 
        // Bổ sung code tại đây 
        return redirect()->route('frontend.home'); 
    } 
} 