<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    //

    public function index(Request $request)
    {
        $name= trim($request->name) ;
        // if(!$name){
        //     $hotel = Hotel::paginate(5);
        //     return $hotel;
        //     } else{
                
        //         $hotel= Hotel:: where('name','LIKE','%'.$name.'%')->paginate(5);
        //         return $hotel ;
        //     }
            $hotel= Hotel::all() ;
            return $hotel;
            //todo list ra các hotel kem theo cac room moi hotel 
    }

    // show 1 hotel 
    public function show(Hotel $hotel)
    {
        return $hotel;
    }

    public static function isValidName(String $name): Bool
    {
        if (strlen($name) < 6 || strlen($name) > 128) {
            return False;
        }
        return True;
    }
// Create hotel
    public function store(Request $request)
    {
        $name = strval(trim($request->input('name')));
        if (!$name || !$this::isValidName($name)) {
            return response()->json(['error' => 'name is missing or too short (<6 char) or too long (>128 char)', 400]);
        }
        $address  = strval(trim($request->input('address')));

        if (!$address || !$this::isValidName($address)) {
            return response()->json(['error' => 'name is missing or too short (<6 char) or too long (>128 char)', 400]);
        }
        $phone = $request->input('phone');

        if (!$phone) {
            return response()->json(['error' => 'phone is missing'], 400);
        }
        //todo check dung dinh dang so dien thoai do dai >= 8 ki tu so
        if (!preg_match("/^[0-9]{8,}+$/", $phone)) {
            return response()->json(['error' => 'wrong phone format'], 400);
        }

        $hotel = Hotel::create([
            "name" => $name,
            "address" => $address,
            "phone" => $phone
        ]);
        return response()->json($hotel, 201);
    }

    // updated 
    public function update(Request $request, Hotel $hotel)
    {
      
        return " xin chao ban";
    }


    // delete
    public function delete(Hotel $hotel)
    {
        //todo  convert hard delete into soft delete

        $hotel->delete();
        return response()->json(['message'=>'delete successfully'], 204);
    }
}
