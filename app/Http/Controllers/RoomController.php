<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    //

    public function findAllRoomByHotel(Request $request,$v)
    {
        // $hotel=$request->hotel;
        // $room=$request->room ;
        // $name = trim($request->name);
        // if (!$name) {
        //     $room = Room::paginate(10);
        //     return $room;
        // } else {
        //     $room = Room::where('name', 'LIKE', '%' . $name . '%')->paginate(10);
        //     return $room;
        // }
        
        $room = Room::where('hotel_id',$v )->get();
        return $room;
    }
    // show id
    public function findOneRoomByHotel(Hotel $hotel, Room $room)
    {
        return $room;
    }
    // create 
    public static function isValidName(String $name): Bool
    {
        if (strlen($name) < 6 || strlen($name) > 128) {
            return False;
        }
        return True;
    }
    // create 
    public function createRoomByHotel(Request $request, $hotel)
    { //Phương thức thứ nhất, isJson() kiểm tra /json và +json trong Content-Type header. 
        //Phương thức này sử dụng khi muốn kiểm tra xem dữ liệu client gửi lên có phải là JSON hay không.
        if (!$request->expectsJson()) {
            return response()->json(['error' => 'wrong json format', 400]);
        }
        $name = trim($request->input('name'));
        error_log($request->expectsJson());
        // if (!$name || !$this::isValidName($name)) {
        //     return response()->json(['error' => 'name is missing or too short (<6 char) or too long (>128 char)', 400]);
        // }
        $description = trim($request->input('description'));

        $floor = trim($request->input('floor'));
        // if(!$floor|| !is_int($floor)){
        //     return response()->json(['error' => 'wrong format number', 400]);

        // }
        $number = trim($request->input('number'));
        // if(!$number|| !is_int($number)){
        //     return response()->json(['error' => 'wrong format number', 400]);

        // }
        $bed = trim($request->input('bed'));
        // if(!$bed|| !is_int($bed)){
        //     return response()->json(['error' => 'wrong format number', 400]);

        // }

        $room = Room::create([
            "hotel_id" => $hotel,
            "name" => $name,
            "description" => $description,
            "floor" => $floor,
            "number" => $number,
            "bed" => $bed
        ]);
        return $room;
    }
    // updateRoom by hotel 
    public function updateRoomByHotel(Request $request,Hotel $hotel,Room $room)
    {
        $update_arr = array();
        $name = $request->input('name');
        if ($name) {
            if (!$this::isValidName($name)) {
                return response()->json(['error' => 'name is missing or too short (<6 char) or too long (>128 char)', 400]);
            }
            $update_arr['name'] = $name;// chen phan tu vao trong mang còn có thể dùng hàm aray_push
        }
        $description = $request->input('description');
        $update_arr['description'] = $description;
        $floor = $request->input('floor');
        $update_arr['floor'] = $floor;
        $number = $request->input('number');
        $update_arr['number'] = $number;
        $bed = $request->input('bed');
        $update_arr['bed'] = $bed;
        return " xin chao ban ";

        
    }

    public function deleteRoomByHotel(Request $request,$u,$v)
    {
        //todo  convert hard delete into soft delete
        $room = Room::where('id', $v)->delete();
        return response()->json(null, 204);
    }
}
