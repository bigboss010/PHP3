<?php

namespace App\Http\Controllers;

use App\Mail\VerifyEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class AuthenController extends Controller
{
    public function login()
    {
        return view('login.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ], [
            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Email không đúng định dạng!',
            'password.required' => 'Vui lòng nhập password!'
        ]);
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $remember = $request->remember;
        if (Auth::attempt($data, $remember)) {
            if (Auth::user()->chuc_vu_id == 1) {
                return redirect()->route('admin.index');
            } else if (Auth::user()->chuc_vu_id == 2) {
                return redirect()->route('/.index');
            } else {
                return redirect()->route('/.index');
            }
        } else {
            return redirect()->back()->with('msgErrors', 'Email hoặc mật khẩu không chính xác!');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('/.index');
    }

    public function register()
    {
        return view('login.register');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|min:3',
            'email' => 'required|email|max:225|unique:users',
            'password' => 'required|confirmed|max:8|min:8|string'
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];

        $user = User::create($data);

        if ($user) {
            $token = Str::random(64);
            DB::table('password_reset_tokens')
                ->insert([
                    'email' => $request->email,
                    'token' => $token
                ]);

            $verificationUrl = URL::temporarySignedRoute(
                'verify.email',
                now()->addMinutes(60),
                ['token' => $token]
            );

            Mail::to($request->email)->send(new VerifyEmail($user, $verificationUrl));
            return redirect()->route('login')
                ->with('warning', 'Chúng tôi đã gửi xác nhận đến email của bạn. Vui lòng xác nhận để đăng nhập!');
        }

    }

    public function verifyAccount($token)
    {
        $record = DB::table('password_reset_tokens')->where('token', $token)->first();
    
        if ($record) {
            User::where('email', $record->email)->update(['email_verified_at' => Carbon::now()]);
            DB::table('password_reset_tokens')->where('token', $token)->delete();
            return redirect()->route('login')->with('success', 'Email của bạn đã được xác nhận!');
        }else{
            return redirect()->route('login')->with('msgErrors', 'Xác nhận không hợp lệ hoặc đã hết hạn!');
        }

    }
    
}
