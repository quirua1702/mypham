<?php

namespace App\Http\Controllers;

use App\Models\ChuDe;
use App\Models\BinhLuanBaiViet;
use App\Models\BaiViet;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BaiVietController extends Controller
{
    public function getDanhSach()
    {
        $baiviet = BaiViet::orderBy('created_at','DESC')->get(); 
        return view('admin.baiviet.danhsach', compact('baiviet')); 
    }

    public function getThem()
    {
        $chude = ChuDe::all(); 
        return view('admin.baiviet.them', compact('chude')); 
    }


    public function postThem(Request $request)
    {

        $data = $request->all();
        $orm = new BaiViet();
        $orm->chude_id = $data['chude_id'];
        $orm->tieude = $data['tieude'];
        $orm->tieude_slug = Str::slug($request->tieude, '-');
        $orm->tomtat = $data['tomtat'];
        $orm->noidung = $data['noidung'];


       $get_image = $request->file('hinh');
       if($get_image){
        $get_name_image =$get_image->getClientOriginalName();
        $name_image = current(explode('.',$get_name_image));
        $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
        $get_image->move('public/uploads',$new_image);
        $orm->hinh = $new_image;
        $orm->save();
        return redirect()->route('admin.baiviet');

       }
        // Kiểm tra
       /* $request->validate([
            'chude_id' => ['required', 'integer'],
            'tieude' => ['required', 'string', 'max:300', 'unique:baiviet'],
            'tomtat' => ['required', 'string', 'max:300', 'unique:baiviet'],
            'noidung' => ['required', 'string', 'min:20'],
            'hinh' => ['nullable', 'image', 'max:2048'],
        ]);
                // Upload hình ảnh 
                $path = ''; 
                if($request->hasFile('hinh')) 
                { 
                    // Tạo thư mục nếu chưa có 
                    $cd = ChuDe::find($request->chude_id); 
                    File::isDirectory($cd->tenchude_slug) or Storage::makeDirectory($cd->tenchude_slug, 0775);
        
                    // Xác định tên tập tin 
                    $extension = $request->file('hinh')->extension(); 
                    $filename = Str::slug($request->tieude, '-') . '.' . $extension; 
                    
                    // Upload vào thư mục và trả về đường dẫn 
                    $path = Storage::putFileAs($cd->tenchude_slug, $request->file('hinh'), $filename); 
                }
        $orm = new BaiViet();
        $orm->chude_id = $request->chude_id;
        //$orm->nguoidung_id = Auth::nguoidung()->id;
        $orm->tieude = $request->tieude;
        $orm->tieude_slug = Str::slug($request->tieude, '-');
        $orm->tomtat = $request->tomtat;
        $orm->noidung = $request->noidung;
        if(!empty($path)) $orm->hinh = $path;
        $orm->save();

        // Sau khi thêm thành công thì tự động chuyển về trang danh sách
        return redirect()->route('admin.baiviet')->with('success','Thêm mới sản phẩm thành công');*/
 
    }

    public function getSua($id)
    {
        $chude = ChuDe::all();
        $baiviet = BaiViet::find($id);
        return view('admin.baiviet.sua', compact('chude', 'baiviet'));
    }

    public function postSua(Request $request, $id)
    {
        // Kiểm tra
        $request->validate([
            'chude_id' => ['required', 'integer'],
            'tieude' => ['required', 'string', 'max:300', 'unique:baiviet,tieude,' . $id],
            'noidung' => ['required', 'string', 'min:20'],
        ]);
        $orm = BaiViet::find($id);
        $orm->chude_id = $request->chude_id;
        $orm->tieude = $request->tieude;
        $orm->tieude_slug = Str::slug($request->tieude, '-');
        $orm->tomtat = $request->tomtat;
        $orm->noidung = $request->noidung;
        $orm->save();

        // Sau khi sửa thành công thì tự động chuyển về trang danh sách
        return redirect()->route('admin.baiviet');
    }

    public function getXoa($id)
    {
        $orm = BaiViet::find($id);
        $orm->delete();

        // Sau khi xóa thành công thì tự động chuyển về trang danh sách
        return redirect()->route('admin.baiviet');
    }

    
}
