<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // add soft delete
class Hotel extends Model
{
    use HasFactory,SoftDeletes; // add Softdelete

    protected $fillable = [
        'name',
        'address',
        'phone',
        'status'
    ];
    protected $attributes = [
        'status' => 1,
    ];
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
