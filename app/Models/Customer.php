<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model
{
    use HasFactory,SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     * mass assignable là tính năng cho phép lập trình một cách tự động gán các tham số của một HTTP request
     *  vào các biến hoặc đối tượng trong lập trình
     * $fillable để tránh lỗ hổng bảo mật .
     *Khi đó nếu kẻ xấu gửi thêm user_type là trường không có trong $fillable thi lập tức 
     *các câu lệnh trên sẽ phát sinh một exception ngay.
     * @var array
     */ 
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ]; // nhung thong tin nao ko tra ra 

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 1,
    ]; // liet ke 1 array  moi phan tu cua array chinh la cac gia tri mac dinhcua 1 truong  trong database 

    /**
     * Get the booking from room.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
