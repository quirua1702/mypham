<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class BinhLuanBaiViet extends Model
{
    protected $fillable =['nguoidung_id','baiviet_id','comment'];

    protected $table = 'binhluanbaiviet';

    public function BaiViet(): BelongsTo
    {
        return $this->belongsTo(BaiViet::class, 'baiviet_id', 'id');
    }

    public function NguoiDung()//: BelongsTo
    {
        return $this->hasOne(NguoiDung::class,'id','nguoidung_id');
        //return $this->belongsTo(NguoiDung::class, 'nguoidung_id', 'id');
    }
    public function scopeSearch($query){
        if($key = request()->key){
            $query = $query->where('tieude','like','%'.$key.'%')
            ->orWhere('noidung',$key);
        }
        return $query;
    }
}
