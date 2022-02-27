<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->age <= 18) {
            return response('Bạn chưa đủ 18 tuổi');//Trả về kết quả
            // Khi thực hiện một số công việc nào đó trong middleware thì sau khi kết thúc 
            // bạn phải return một object chứa thuộc tính headers.
        }    
        return $next($request);// Cho phép HTTP request tiếp tục
    }
    
}
