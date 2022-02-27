<?php
// dung controller nao thi phai use controller do 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\JwtAuthController;
use App\http\Controllers\BookingController;
use App\Models\Booking;
use App\Models\Customer;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route:: prefix('auth')-> group(function () {
//     Route::post('/register', [JwtAuthController::class, 'register']);
//     Route::post('/login', [JwtAuthController::class, 'login']);
//     Route::post('/logout', [JwtAuthController::class, 'logout']);
// }
// );
// Route:: middleware('jwt.auth')->group (function(){
//     Route::get('customers', [CustomerController::class, 'index']);
//     Route::get('customers/{customer}', [CustomerController::class, 'show']);
// });
/*Nếu như một nhóm route có cùng chung middleware,namespace,prefix, name ta có thể gom vào 1 Route::group 
Route::group([
    'namespace' => 'Admin', 
    'prefix' => 'admin', 
    'name' => 'admin.'
], function() {
    //  Route::post('/register', [JwtAuthController::class, 'register']);
    Route::post('/login', [JwtAuthController::class, 'login']);
});
*/

//                 
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('/register',[JwtAuthController::class, 'register']);
    Route::post('/login',[JwtAuthController::class, 'login']);
    Route::post('/logout',[JwtAuthController::class, 'logout']);
});

Route::group([
    'prefix' => 'auth',
    'middleware' => ['jwt.auth'], // thêm middleware jwt.auth để kiểm tra xem token có hợp lệ hay không
], function () {
    Route::get('customers', [CustomerController::class, 'index']);
    Route::get('customers/{customer}', [CustomerController::class, 'show']);
    Route::post('customers', [CustomerController::class, 'store']);
    Route::put('customers/{customer}', [CustomerController::class, 'update']);
    Route::delete('customers/{customer}', [CustomerController::class, 'delete']);
});

// route khi ko dung middleware 
Route::get('customers', [CustomerController::class, 'index']);
Route::get('customers/{customer}', [CustomerController::class,'show']);
Route::post('customers', [CustomerController::class, 'store']);
Route::put('customers/{customer}', [CustomerController::class, 'update']);
Route::delete('customers/{customer}', [CustomerController::class, 'delete']);

// HotelController
Route::get('hotels', [HotelController::class, 'index']);
Route::get('hotels/{hotel}', [HotelController::class, 'show']);
Route::post('hotels', [HotelController::class, 'store']);
Route::put('hotels/{hotel}', [HotelController::class, 'update']);
Route::delete('hotels/{hotel}', [HotelController::class, 'delete']);

// RoomController 
Route::get('hotels/{hotel}/rooms', [RoomController::class, 'findAllRoomByHotel']);
Route::get('hotels/{hotel}/rooms/{room}', [RoomController::class, 'findOneRoomByHotel']);
Route::post('hotels/{hotel}/rooms', [RoomController::class, 'createRoomByHotel']);
Route::put('hotels/{hotel}/rooms/{room}', [RoomController::class, 'updateRoomByHotel']);
Route::delete('hotels/{hotel}/rooms/{id}', [RoomController::class, 'deleteRoomByHotel']);


// BookingController 
Route::get('hotels/{hotel_id}/rooms/{room_id}/bookings',[BookingController::class,'findAllBookByHotelRoom']);
Route::get('hotels/{hotel_id}/rooms/{room_id}/bookings/{booking_id}', [BookingController::class, 'findOneBookByHotelRoom']);
Route::post('hotels/{hotel_id}/rooms/{room_id}/bookings/', [BookingController::class,'createBookByHotelRoom']);
Route::put('hotels/{hotel}/rooms/{room}/bookings/{booking_id}', [BookingController::class, 'updateBookByHotelRoom']);
Route::delete('hotels/{hotel}/rooms/{room}/bookings/{booking_id}',[BookingController::class, 'deleteBookByHotelRoom']); 
   

//todo viet api cho customer , register xong thi gui email confirm ; forgetpassword thi gui email reset password cho khachhang
 

 Route::get('/verifyemail/{token}',  [JwtAuthController::class,'verify']);
 //todo khi khach hang dang ki tao ra 1 cai token , token day gion gnhu JWT token dc sinh ra khi ma khach hang login vao 
 // todo  guir link chua "Route::get('/verifyemail/{token}'"de khach hang an vao thi se veryfy dc luon 
 //todo tao 1 bang role, 1 user co nhieu role, 1 role co nhieu permission
 // todo tu 1 user get all role 
 // todo lay ra tat cả permision thuoc ve role day
 //todo lay ra tât cả role va tât ca persion





















  