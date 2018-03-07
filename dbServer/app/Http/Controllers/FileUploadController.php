<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests;
class FileUploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
			$file = $request->file('file');
      $result = $file->isValid();
      // 文件是否上传成功
      if ( $result ) {

          // 获取文件相关信息
          $originalName = $file->getClientOriginalName(); // 文件原名
          $ext = $file->getClientOriginalExtension();     // 扩展名
          $realPath = $file->getRealPath();   //临时文件的绝对路径
          $type = $file->getClientMimeType();     // image/jpeg

          // 上传文件
          $filename = date('YmdHis') . uniqid() . '.' . $ext;
          // 使用我们新建的uploads本地存储空间（目录）
          $bool = Storage::disk('public')->put($filename, file_get_contents($realPath));
          return response()->json([
                  'code'  => 0,
                  'msg'   => 'success',
                  'data'  => [
                    'src'   => 'storage/'.$filename,
                    'filename' => $filename
                  ]
              ]);
      }else{
        return response()->json([
                'code'  => 10000,
                'msg'   => '文件过大，请确认'
            ]);
      }
    }

    public function destory(Request $request){
      $response = Storage::disk('public')->delete($request->src);
    }
}
