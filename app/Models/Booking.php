<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // add soft delete

class Booking extends Model
{
    use HasFactory, SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // FILLABLE GOM CAC TRUONG GIONG TRONG BANGR DATABASE TRỪ CREATE_AT UPDATED_AT
    // KO CÓ ĐỦ CÁC TRƯỜNG SẼ BÁO LỖI KHI CREATE
    protected $fillable = [
        'room_id',
        'customer_id',
        'title',
        'content',
        'started_at',
        'ended_at'
       
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 1,
    ];

    /**
     * Get the room that owns the booking.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Get the customer that owns the booking.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
