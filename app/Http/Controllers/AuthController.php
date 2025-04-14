<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);
    
        // Tìm người dùng theo email
        $user = \App\Models\User::where('email', $credentials['email'])->first();
    
        // Nếu không tìm thấy user
        if (!$user) {
            return back()->withErrors([
                'email' => 'Tài khoản không tồn tại.'
            ])->withInput();
        }
    
        // Kiểm tra nếu tài khoản chưa được phê duyệt
        if (!$user->approved) {
            return back()->withErrors([
                'email' => 'Tài khoản của bạn chưa được phê duyệt. Vui lòng chờ admin phê duyệt.'
            ])->withInput();
        }
    
        // Kiểm tra nếu tài khoản bị khóa (nếu bạn có logic khóa tài khoản)
        if ($user->locked) {
            return back()->withErrors([
                'email' => 'Tài khoản của bạn đã bị khóa.'
            ])->withInput();
        }
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
    
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.'
        ])->withInput();
    }
    
    

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|max:255|unique:users,email',
            'password'              => 'required|min:6|confirmed',
        ]);

        // Tạo tài khoản mới với trạng thái approved = false
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'user',    // Hoặc role mặc định của người dùng
            'approved' => false,     // Tài khoản chưa được phê duyệt
        ]);

        // Sau khi đăng ký, không tự động đăng nhập
        return redirect()->route('login')
                         ->with('success', 'Đăng ký thành công. Tài khoản của bạn đang chờ admin phê duyệt.');
    }

}
