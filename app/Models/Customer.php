<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
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
