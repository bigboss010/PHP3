<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenController extends Controller
{
    public function login() {
        return view('login');
    }

    public function postLogin(Request $request) {
        // $request->validate([
        //     'email' => 'required|email|exists:users, email',
        //     'password' => 'requiredmin:8'
        // ], [
        //     'email.required' => 'Vui lòng nhập email!',
        //     'email.email' => 'Email không đúng định dạng!',
        //     'email.exists' => 'Email chưa được đăng ký!',
        //     'password.required' => 'Vui lòng nhập password!',
        //     'password.min' => 'Password quá ngắn!'
        // ]);
        $dataUser = [  //attempt tự mã hóa password và so sánh với db
            'email' => $request->email,
            'password' => $request->password
           ];
        $remember = $request->has('remember');
        if(Auth::attempt($dataUser, $remember)) {
            // Logout all account from orther browser
            Session::where('user_id', Auth::id())->delete();
            // Create new session Login
            session()->put('user_id', Auth::id());
            // dd(Auth::user());
            if(Auth::user()->role == '1'){
                return redirect()->route('admin.products.listProducts') ->with('success', 'Đăng nhập thành công!');
            }
        }else{
            return redirect()->back()->with('msgErrors', 'Email hoặc mật khẩu không chính xác!');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')
        ->with('msg', 'Đăng xuất thành công!');


    }

    public function register() {
        return view('register');
    }

    public function postRegister(Request $request) {
        $check = User::where('email', $request->email)->exists();
        if($check){
            return redirect()->back()->with('msgErrors', 'Email đã tồn tại!');
        }else{
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ];
            $newUser = User::create($data);
            // Auth::login($newUser);
            return redirect()->route('login')
            ->with('susscess', 'Đăng ký thành công! Hãy đăng nhập nào!');
        }
    }
}
