<?php
namespace App\Jobs;
 
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail; //To send a email, use the to() method on the Mail facade.
//dung use Mail lỗi ngay  

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
 
     /**
//      * Create a new job instance.
//      *
//      * @return void
//      */
    protected $mail;
 
    public function __construct($mail)
    {
        $this->mail = $mail;
    }
  /**
//      * Execute the job.
//      *
//      * @return void
//      */

    public function handle()
    {

        Mail::to('9eace3a77d-e4ffb5@inbox.mailtrap.io')->send($this->mail);
       
    }
}











































// namespace App\Jobs;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldBeUnique;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Bus\Dispatchable;
// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Queue\SerializesModels;

// class SendEmail implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//     /**
//      * Create a new job instance.
//      *
//      * @return void
//      */
//     public function __construct()
//     {
//         //
//     }

//     /**
//      * Execute the job.
//      *
//      * @return void
//      */
//     public function handle()
//     {
//         //
//     }
// }
