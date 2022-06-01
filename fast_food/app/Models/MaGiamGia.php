<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaGiamGia extends Model
{
    use HasFactory;
    protected $guarded = [];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'ten_ma',
        'loai_giam_gia_id',
        'trang_thai',
    ];

    public function loaiGiamGia()
    {
        return $this->belongsTo(LoaiGiamGia::class, 'loai_giam_gia_id', 'id');
    }
}
