<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class FileUploadController extends Controller
{
  //
  public function createForm()
  {
    return view('file-upload');
  }

  public function fileUpload(Request $req)
  {
    // validate du lieu 
    $req->validate([
      'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'   // max la  toi da dung luong 2048 megabyte
      //mime :  phan đuôi file la cac kieu txt,xlx,xls 
    ]);

    $fileModel = new File; // khi dung method save() thi luon phai khoi tao model de luu giu lieu 

    if ($req->file()) {

      // lay ten file upload 
      $fileName = time() . '_' . $req->file('file')->getClientOriginalName();

      // save vao thu muc uploads ben trong thu muc public : storage/app/public/uploads 
      $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
     
      // save vao thu muc storage/app/uploadsecond 
      // $filePath = $req->file('file')->storeAs('uploadsecond', $fileName, 'local');

      // save vao thu muc uploads ben trong thu muc public 
      $filePath = $req->file('file')->move('uploads', $fileName);

      $fileModel->name = time() . '_' . $req->file('file')->getClientOriginalName();
      $fileModel->file_path =  '/storage/app/public/' . $filePath;
      $fileModel->save(); // luu vao database 

    }
    //Lưu hình ảnh vào thư mục public/upload/hinhthe
    $hinhthe = $req->file('hinhthe');
    $gethinhthe = time() . '_' . $hinhthe->getClientOriginalName();
    $destinationPath = public_path('upload/hinhthe');
    $hinhthe->move($destinationPath, $gethinhthe);
    return back()
      ->with('success', 'File has been uploaded.')
      ->with('file', $fileName);
  }


  // if($request->hasFile('file')) {

  //     $file= $request->file('file');

  //        // lấy tên file lưu trữ theo tên file được upload lên
  //     $fileName = $file->getClientOriginalName(); 

  //     // layđường dẫn file: 
  //     $filePath = $file->storeAs('uploads', $fileName, 'public'); 
  //      //  $filePath = $file->move('uploads', $fileName, 'local '); 
  //    //Display File Size
  //    $file->getSize();
  //    $file->getRealPath();
  //     $fileModel->name = time().'_'.$request->file->getClientOriginalName(); // 

  //     $fileModel->file_path = '/storage/' . $filePath; // nho phai storage

  //     $fileModel->save();
  //     return back()
  //     ->with('success','File has been uploaded.') // hien thi session thoong bao
  //     ->with('file', $fileName);

  //    //  VD:  Lưu trữ ảnh vào trong thư mục storage/app/images: 
  //              $path = $request->file('photo')->store('images');
  //    //đặt tên file theo cách của bạn thì sử dụng method storeAs() như sau:
  //    // $request->file('photo')->storeAs($path, $fileName, $diskType); 
  //    // trong do $fileName la ten muon luu tru. vi du nhu sau:  
  //     $request->file('image')->storeAs('images', 'avatar.jpg', 'local');

  //     // sử dụng phương thức move để lưu trữ file với method này thì root folder sẽ được tính từ public/
  //     // VD Lưu trữ image vào thư mục public/images cau lênh là: 
  //     $request->file('image')->move('images', 'avatar.jpg', 'local');

  // }
}
