<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Models\Admin;
use DB;
class AdminLoginController extends Controller
{
    public function __construct(){
      $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm(){
      return view('auth.admin-login');
    }

    public function login(Request $request){
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);

      // Attempt to log the user in
      $response = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember);

      if ( $response ){
        $admin = Admin::where('email', $request->email)->first();
        return  response()->json([
                    'code'  => 0,
                    'msg'   => '',
                    'data'  => [
                      'user'  => $admin,
                      'token' => json_encode($admin)
                    ]
                ]);
      }else{
        return response()->json([
                    'code' => 10000,
                    'msg'  => 'Wrong Email Or Password'
                ]);
      }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
