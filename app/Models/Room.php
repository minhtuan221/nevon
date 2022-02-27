<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // add soft delete
class Room extends Model
{
    use HasFactory,SoftDeletes; // add Softdelete

    protected $fillable = [
        'hotel_id',
        'name',
        'description',
        'floor',
        'number',
        'bed',
        'status'
    ]; //$fillable khai bao tương ứng với các trường có trong database, trừ 2 trường creat_at và updated_at 
    // khai báo thiếu 1 trường sẽ báo lỗi trường đó has not default value khi query CREATE 

    protected $attributes = [
        'status' => 1,
    ];
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
