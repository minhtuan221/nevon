<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Jobs\SendEmail;
use App\Mail\TestMail;
 
class MailController extends Controller
{
    public function test()
    {
        $startTime = microtime(true);
 
        // for ($i = 0; $i < 20; $i++) {
           
        //     
        //      
        // }
        $testMail = new TestMail();
        $sendEmailJob = new SendEmail($testMail);// khởi tạo job
        dispatch($sendEmailJob); // đưa job vào queue
        if(!dispatch($sendEmailJob)) {
            return response()->json(['Sorry! Please try again later']);
       }else{
            return response()->json('Great! Successfully send in your mail');
          }

        $endTime = microtime(true);
        $timeExecute = $endTime - $startTime;
 
        return "Done. Time execute: $timeExecute";

    }
}



// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class MailController extends Controller
// {
//     //
// }
