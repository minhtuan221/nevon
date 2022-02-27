<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MailController;
use App\Jobs\SendEmailJob;
use App\Mail\SendEmailDemo;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
}); 
Route::get('/welcome', function () {
    return " chao mưng bạn tới framework laravel"; 
}); //url sẽ là: http://localhost:8000/welcome 



Route::group(['prefix' => 'web'], function () {
});
Route::prefix('admin')->group(function () {
    Route::get('users', function () {
        // Matches the 'admin/users/' url 
    });
});

// Lưu ý: với Laravel 6.x trở lên thì QUEUE_DRIVER trong file. env đổi thành QUEUE_CONNECTION.
Route::get('/test', [MailController::class, 'test']);

Route::get('hello', function () {
    return " xin chao ban den voi laravel";
});

Route::get('/request', function (Request $request) {
     return response()->json([1, 2, 3]);
});
Route::get('response',function(Request $request){
    // return  response('Hello World', 200);
    // return redirect('hello') ;// 
    $input = $request->input();// Tương đương với $input = $request->all(); 
    // lấy ro ra 1 input 
    $phone= $request->input('phone');
    $name = $request->input('name', 'nguyễn thị huyền 95'); // gán mặc định cho name= tham số thủ 2
    
    
    
    
    return $name;



}) ;