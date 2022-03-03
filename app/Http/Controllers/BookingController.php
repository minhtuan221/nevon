<?php
// isEmpty() kiem tra 1 collection la rỗng ko.
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Customer;

class BookingController extends Controller
{
    public function findAllBookByHotelRoom(Request $request, $hotel_id, $room_id)
    {
        //todo them softdelete
        $hotel = Hotel::where('id', $hotel_id)->get(); // tim co hotel_id ko  
        if ($hotel->isEmpty()) {
            // isEmpty() kiem tra 1 collection la rỗng ko.
            return response()->json(['ko co hotel', 404]);
        }
        $room = Room::where('hotel_id', $hotel_id)->get(); // tim trong bang, room co hotel_id= $hotel_id
        if ($room->isEmpty()) {
            return response()->json(['ko co room', 404]);
        }
        $bookings = Booking::where('room_id', $room_id)->with('customer:id,name,email,phone')->get();
        // luon phai di kem id khi dung method dang tren
        // $bookings = Booking::where('room_id', $room_id)->get() ;
        return $bookings;
    }

    //todo  lam cac api con lai theo cac buoc tim hotel tim room 
    public function findOneBookByHotelRoom(Request $request, $hotel_id, $room_id, $booking_id)
    {
        $hotel = Hotel::where('id', $hotel_id)->get(); //tim co hotel_id ko,dung all() sẽ lỗi,vi all() ko cho dieu kien di kem vao dc
        if ($hotel->isEmpty()) {
            return response()->json(['ko co hotel', 404]);
        }
        $matchThese = ['hotel_id' => $hotel_id, 'id' => $room_id];

        $room = Room::where($matchThese)->get(); // tim trong bang, room co hotel_id= $hotel_id
        if ($room->isEmpty()) { 
            return response()->json(['ko co room', 404]); // method isEmpty() check 1 collection la null
        }

        $booking = Booking::where('id', $booking_id)->get();
        //$users = DB::table('users')->get();
        return $booking;
    }

    //CREATE 
    public function createBookByHotelRoom(Request $request, $hotel_id, $room_id)
    {
        $hotel = Hotel::where('id', $hotel_id)->get(); // tim co hotel_id ko, dung all() sẽ lỗi
        if ($hotel->isEmpty()) {
            return response()->json(['ko co hotel', 404]);
        }
        $room = Room::where('hotel_id', $hotel_id)->get(); // tim trong bang, room co hotel_id= $hotel_id
        if ($room->isEmpty()) {
            return response()->json(['ko co room'], 404);
        }

        date_default_timezone_set("Asia/Ho_Chi_Minh");

        $customer_id = $request->input('customer_id');
        $title = $request->input('title');
        $content = $request->input('content');
        $started_at = strtotime($request->input('started_at'));
        $ended_at = strtotime($request->input('ended_at')); // xu li time con co the dung thu vien cacbon trong laravel 

        if ($ended_at < $started_at) {
            return response()->json(['message' => 'starting time must be less than closing time'], 400);
        }
        if ($started_at % 1800 !== 0) {
            return response()->json(['message' => 'time start phai la boi so cua 30 phut ', 400]);
        }
        //strtotime()return (timestamp)là số giây kể từ ngày 1 tháng 1 năm 1970 00:00:00 GMT so với thời diểm chuối string 

        //date( $format,$timestamp);sẽ xuất ra một chuỗi thời gian dựa theo định dạng được truyền vào 
        // và số nguyên timestamp
        // Hàm time() sẽ lấy timestamp của thời điểm hiện tại,
        // timestamp của thời điểm hiện tại số giây tính từ thời điểm 00:00:00 1/1/1970 đến thời điểm hiện tại.
        if ($ended_at % 1800 !== 0) {
            return response()->json(['message' => 'time end la boi so cua 30 phut ', 400]);
        }
        $bookings = Booking::where('room_id', $room_id)->with('customer')->get();

        foreach ($bookings as $booking) {
            //Case 1: startime trc < cua startime booking cu 
            //Case 2: starttime cu <strartime cua booking moi < endtime booking cu
            //Case 3: endtime booking cu < startime booking moi
            //todo 3 testcases 
            $u = $booking->started_at;
            $v = $booking->ended_at;
            echo $booking->started_at . "\n";
            echo $booking->ended_at . "\n";

            if ($started_at <= strtotime($u)) {
                echo "$started_at < strtotime($u)\n";
                echo "thoi gian booking moi k dc nho hon starttime booking cu\n";
                if (strtotime($u) <= $ended_at) {
                    return response()->json(["message" => "lich phong kin"], 400);
                }
            }
            if (strtotime($u) < $started_at && $started_at < strtotime($v)) {
                //todo ko cho dat phong trong truong hop ko dat dc phong thi return loi 
                return response()->json(["message" => "khong dc dat phong"], 400);
            }
        }


        $started_at = date("Y-m-d H:i:s", $started_at); //H:Biểu thị giờ ở định dạng 24 giờ 
        $ended_at = date("Y-m-d H:i:s", $ended_at);
        $booking = Booking::create([
            "room_id" => $room_id,
            "customer_id" => $customer_id,
            "title" => $title,
            "content" => $content,
            "started_at" => $started_at,
            "ended_at" => $ended_at,
        ]);
        //hoac co the dung Model Mass Assignment nhu nay: $user = User::create(Input::all());
        return response()->json($booking, 201);
    }

    // UPDATE
    public function updateBookByHotelRoom(Request $request, $hotel_id, $room_id, $booking_id)
    { //todo cho update content, title, started_at,ended_at
        //todo valiadate startitme entitme
        $hotel = Hotel::where('id', $hotel_id)->get(); //tim co hotel_id ko, dung all() sẽ lỗi,
        if ($hotel->isEmpty()) {
            return response()->json(['ko co hotel', 404]);
        }
        $room = Room::where('hotel_id', $hotel_id)->get(); //tim trong bang, room co hotel_id= $hotel_id
        if ($room->isEmpty()) {
            return response()->json(['ko co room', 404]);
        }

        $update_arr = array();
        $title = $request->input('title');
        $update_arr['title'] = $title;
        $content = $request->input('content');
        $update_arr['content'] = $content;
        $started_at = strtotime($request->input('started_at'));
        $ended_at = strtotime($request->input('ended_at'));
        if ($ended_at < $started_at) {
            return response()->json(['message' => 'time bắt đầu phải nhỏ hơn time kết thúc'], 400);
        }
        if ($started_at % 1800 !== 0) {
            return response()->json(['message' => 'time start phai la boi so cua 30 phut ', 400]);
        }
        if ($ended_at % 1800 !== 0) {
            return response()->json(['message' => 'time end la boi so cua 30 phut ', 400]);
        }
        $ended_at = strtotime($request->input('ended_at'));
        $started_at = date("Y-m-d h:i:s", $started_at); // muon luu dc vao sql thi dinh dang ham date();
        $update_arr['started_at'] = $started_at;
        $ended_at = date("Y-m-d h:i:s", $ended_at);
        $update_arr['ended_at'] = $ended_at;

        if (count($update_arr) > 0) {
            $booking_id = Booking::find($booking_id)->update($update_arr);
            // To update a model, you should retrieve it and set any attributes you wish to update
            // $user->update(Input::all()); 

        }
        return response()->json(['message' => 'update succesfully'], 200);
    }


    public function deleteBookByHotelRoom(Request $request, $hotel_id, $room_id, $booking_id)
    {
        //todo  convert hard delete into soft delete
        $hotel = Hotel::where('id', $hotel_id)->get(); //tim co hotel_id ko, dung all() sẽ lỗi,
        if ($hotel->isEmpty()) {
            return response()->json(['ko co hotel', 404]);
        }
        $room = Room::where('hotel_id', $hotel_id)->get(); //tim trong bang, room co hotel_id= $hotel_id
        if ($room->isEmpty()) {
            return response()->json(['ko co room', 404]);
        }

        $booking_id = Booking::find($booking_id)->delete();
        return response()->json(["message" => 'xoa thanh cong', 204]);
    }
}
