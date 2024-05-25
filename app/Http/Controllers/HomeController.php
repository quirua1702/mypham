<?php 
 
namespace App\Http\Controllers; 
 
use App\Models\ChuDe; 
use App\Models\BaiViet;
use App\Models\BinhLuanBaiViet;
use App\Models\NguoiDung; 
use App\Models\LoaiSanPham;
use App\Models\SanPham; 
use Gloudemans\Shoppingcart\Facades\Cart; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Str; 
use Exception;
 
class HomeController extends Controller 
{
    public function recover_pass(Request $request){
        $data =$request->all();
        $title_mail = "MOBIFONE WEBSITE(lấy lại mật khẩu)";
        $nguoidung = NguoiDung::where('email','=',$data['email_account'])->get();

        foreach($nguoidung as $key =>$value){
            $nguoidung_id = $value->id;
        }

        if($nguoidung){
            $count_nguoidung =$nguoidung->count();
            if($count_nguoidung==0){
                return redirect()->back()->with('error','Email chưa được đăng kí để khôi phục mật khẩu');
            }else{
                $token_random = Str::random();
                $nguoidung = NguoiDung::find($nguoidung_id);
                $nguoidung-> remember_token = $token_random;
                $nguoidung->save();

                //gui mail
                $to_email = $data['email_account'];
                $link_reset_pass = url('/update-new-pass?email='.$to_email.'&token='.$token_random);
                $data = array("name"=>$title_mail,"body"=>$link_reset_pass,"email"=>$data['email_account']);//body of mail.blade.php
                
                Mail::send('user.forget_pass_notify',['data'=>$data] ,function($message) use ($title_mail,$data)
                {
                    $message->to($data['email'])->subject($title_mail);//send this mail with subject
                    $message->from($data['email'],$title_mail);//send from this mail
                });
                return redirect()->back()->with('massage','Gửi mail thành công vui lòng vào email để reset pass!');
            
                }
            }
        }
        public function reset_new_pass(Request $request)
        {
            $data = $request->all();
            $token_random = Str::random();
            $nguoidung = NguoiDung::where('email', $data['email'])->where('remember_token', $data['token'])->first();
        
            if($nguoidung){
                $nguoidung->password = bcrypt($data['password_pw']); // Sử dụng bcrypt() cho tính bảo mật tốt hơn
                $nguoidung->remember_token = $token_random;
                $nguoidung->save();
        
                return redirect('khach-hang/dang-nhap')->with('message', 'Mật khẩu đã được cập nhật!');
            } else {
                return redirect('quen-mat-khau')->with('error', 'Vui lòng nhập lại email vì link đã quá hạn');
            }
            return view('frontend.home');
        }
        
    
    public function update_new_pass(){
        return view('user.new_pass');
    }
        
    public function quen_mat_khau(Request $request){
        return view('user.quenmatkhau');
    }
    public function getGoogleLogin() 
    { 
        return Socialite::driver('google')->redirect(); 
    } 
    public function getSearch(Request $request)
    {
        $sanpham = SanPham::orderBY('Created_at','DESC')->search()->paginate(10);
        return view('frontend.search', compact('sanpham'));
    }
     
    public function getGoogleCallback() 
    { 
        try 
        { 
            $user = Socialite::driver('google') 
                ->setHttpClient(new \GuzzleHttp\Client(['verify' => false])) 
                ->stateless() 
                ->user(); 
        } 
        catch(Exception $e) 
        { 
            return redirect()->route('user.dangnhap')->with('warning', 'Lỗi xác thực. Xin vui lòng thử lại!'); 
        } 
         
        $existingUser = NguoiDung::where('email', $user->email)->first(); 
        if($existingUser) 
        { 
            // Nếu người dùng đã tồn tại thì đăng nhập 
            Auth::login($existingUser, true); 
            return redirect()->route('user.home'); 
        } 
        else 
        { 
            // Nếu chưa tồn tại người dùng thì thêm mới 
            $newUser = NguoiDung::create([ 
                'name' => $user->name, 
                'email' => $user->email, 
                'username' => Str::before($user->email, '@'), 
                'password' => Hash::make('larashop@2023'), // Gán mật khẩu tự do 
            ]); 
             
            // Sau đó đăng nhập 
            Auth::login($newUser, true); 
            return redirect()->route('user.home'); 
        } 
    } 

    public function getHome() 
    { 
        $loaisanpham = LoaiSanPham::all(); 
        return view('frontend.home', compact('loaisanpham')); 
    } 
     
    public function getSanPham($tensanpham_slug = '') 
    { 
        $loaisanpham = LoaiSanPham::all();
        $sanpham = SanPham::paginate(10);
        return view('frontend.sanpham', compact('sanpham','loaisanpham')); 
    } 
     
    public function getSanPham_ChiTiet($tenloai_slug = '', $tensanpham_slug = '')
    {
        // Bổ sung code tại đây
        
        $sanpham = SanPham::where('tensanpham_slug',$tensanpham_slug)->first();
        return view('frontend.sanpham_chitiet',compact('sanpham'));
    }
    public function detail($tensanpham_slug)
    {
        $sanpham = SanPham::where('tensanpham_slug',$tensanpham_slug)->first();
        return view('frontend.sanpham_chitiet',compact('sanpham'));
    }
    
     
    public function getBaiViet($tenchude_slug = '') 
    { 
        $chude = ChuDe::all();
        $baiviet = BaiViet::paginate(10);
        return view('frontend.baiviet', compact('baiviet','chude')); 
    } 
    public function postComment($baiviet_id)
    {
        // Bổ sung code tại đây
        $data = request()->all('comment');
        $data['baiviet_id'] = $baiviet_id;
        $data['nguoidung_id'] = auth()->id();
        if(BinhLuanBaiViet::create($data)){
            return redirect()->back();
        }
        return redirect()->back();
        //return view('frontend.baiviet_chitiet',compact('baiviet'));
    }
     
    public function getBaiViet_ChiTiet($tenchude_slug = '', $tieude_slug = '') 
    { 
        $binhluanbaiviet = BinhLuanBaiViet::paginate(10);
        // Bổ sung code tại đây
        $baiviet = BaiViet::where('tieude_slug',$tieude_slug)->first();
        return view('frontend.baiviet_chitiet',compact('baiviet','binhluanbaiviet')); 
    } 
 
    public function getGioHang() 
    { 
        if(Cart::count() > 0) 
            return view('frontend.giohang'); 
        else 
            return view('frontend.giohangrong'); 
    } 
     
    public function getGioHang_Them($tensanpham_slug = '') 
    { 
        $sanpham = SanPham::where('tensanpham_slug', $tensanpham_slug)->first(); 
         
        Cart::add([ 
            'id' => $sanpham->id, 
            'name' => $sanpham->tensanpham, 
            'price' => $sanpham->dongia, 
            'qty' => 1, 
            'weight' => 0, 
            'options' => [ 
                'image' => $sanpham->hinhanh 
            ] 
        ]); 
         
        return redirect()->route('frontend.home'); 
    } 
     
    public function getGioHang_Xoa($row_id) 
    { 
        Cart::remove($row_id); 
         
        return redirect()->route('frontend.giohang'); 
    } 
     
    public function getGioHang_Giam($row_id) 
    { 
        $row = Cart::get($row_id); 
         
        // Nếu số lượng là 1 thì không giảm được nữa 
        if($row->qty > 1) 
        { 
            Cart::update($row_id, $row->qty - 1); 
        } 
         
        return redirect()->route('frontend.giohang'); 
    } 
     
    public function getGioHang_Tang($row_id) 
    { 
        $row = Cart::get($row_id); 
         
        // Không được tăng vượt quá 10 sản phẩm 
        if($row->qty < 10) 
        { 
            Cart::update($row_id, $row->qty + 1); 
        } 
         
        return redirect()->route('frontend.giohang'); 
    } 
     
    public function postGioHang_CapNhat(Request $request) 
    { 
        foreach($request->qty as $row_id => $quantity) 
        { 
            if($quantity <= 0) 
                Cart::update($row_id, 1); 
            else if($quantity > 10) 
                Cart::update($row_id, 10); 
            else 
                Cart::update($row_id, $quantity); 
        } 
         
        return redirect()->route('frontend.giohang'); 
    } 
     
    public function getTuyenDung() 
    { 
        return view('frontend.tuyendung'); 
    } 
     
    public function getLienHe() 
    { 
        return view('frontend.lienhe'); 
    } 
     
    // Trang đăng ký dành cho khách hàng 
    public function getDangKy() 
    { 
        return view('user.dangky'); 
    } 
     
    // Trang đăng nhập dành cho khách hàng 
    public function getDangNhap() 
    { 
        return view('user.dangnhap'); 
    } 
    // Phương thức xử lý đăng nhập
    // public function getDangNhap(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         // Authentication passed...

    //         $nguoidung = Auth::user();
            
    //         if ($nguoidung->role == 'admin') {
    //             return redirect()->route('admin.home');
    //         } elseif ($nguoidung->role == '') {
    //             return redirect()->route('customer.dashboard');
    //         } else {
    //             Auth::logout();
    //             return redirect('/login')->withErrors(['role' => 'Invalid role']);
    //         }
    //     }

    //     return back()->withErrors([
    //         'email' => 'The provided credentials do not match our records.',
    //     ]);
    // }
} 