<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class BaiViet extends Model
{
    protected $table = 'baiviet';
    protected $fillable = [
        'chude_id',
        'tieude',
        'tieude_slug',
        'tomtat',
        'noidung',
        'hinh',
        ];

    public function ChuDe(): BelongsTo
    {
    return $this->belongsTo(ChuDe::class, 'chude_id', 'id');
    }
    public function BinhLuanBaiViet(): HasMany
    {
    return $this->hasMany(BinhLuanBaiViet::class, 'baiviet_id', 'id');
    }
    
}