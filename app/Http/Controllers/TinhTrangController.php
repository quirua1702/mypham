<?php 
 
namespace App\Http\Controllers; 
 
use App\Models\TinhTrang; 
use Illuminate\Http\Request; 
use Illuminate\Support\Str; 
 
class TinhTrangController extends Controller 
{ 
    public function getDanhSach() 
    { 
        $tinhtrang = TinhTrang::all(); 
        return view('admin.tinhtrang.danhsach', compact('tinhtrang')); 
    } 
     
    public function getThem() 
    { 
        return view('admin.tinhtrang.them'); 
    } 
     
    public function postThem(Request $request) 
    { 
         // Kiểm tra 
        $request->validate([ 
            'tinhtrang' => ['required', 'string', 'max:191', 'unique:tinhtrang'], 
        ]); 
        
        $orm = new TinhTrang(); 
        $orm->tinhtrang = $request->tinhtrang; 
        //$orm->tenloai_slug = Str::slug($request->tenloai, '-'); 
        $orm->save(); 
        
        // Sau khi thêm thành công thì tự động chuyển về trang danh sách 
        return redirect()->route('admin.tinhtrang'); 
    } 
     
    public function getSua($id) 
    { 
        $tinhtrang = TinhTrang::find($id); 
        return view('admin.tinhtrang.sua', compact('tinhtrang')); 
    } 
     
    public function postSua(Request $request, $id) 
    { 
        // Kiểm tra 
        $request->validate([ 
            'tinhtrang' => ['required', 'string', 'max:191', 'unique:tinhtrang,tinhtrang,' . $id], 
        ]); 
        
        $orm = TinhTrang::find($id); 
        $orm->tinhtrang = $request->tinhtrang; 
        //$orm->tenloai_slug = Str::slug($request->tenloai, '-'); 
        $orm->save(); 
        
        // Sau khi sửa thành công thì tự động chuyển về trang danh sách 
        return redirect()->route('admin.tinhtrang');
    } 
     
    public function getXoa($id) 
    { 
        $orm = TinhTrang::find($id); 
        $orm->delete(); 
         
        return redirect()->route('admin.tinhtrang'); 
    } 
} 