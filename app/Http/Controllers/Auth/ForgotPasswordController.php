<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    // Hiển thị form nhập email
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    // Xử lý form nhập email, tạo token và chuyển hướng đến form đặt lại mật khẩu
    public function handleEmailRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại.']);
        }

        // Tạo token ngẫu nhiên
        $token = Str::random(60);

        // Lưu token vào bảng password_resets (bạn có thể dùng updateOrInsert)
        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => Carbon::now()
            ]
        );

        // Thay vì gửi email, ta chuyển hướng trực tiếp đến form reset với email và token (token gốc chưa hash)
        // Lưu ý: Đây là cách demo, trong thực tế token nên được gửi qua email
        return redirect()->route('password.reset', [
            'email' => $user->email,
            'token' => $token
        ])->with('success', 'Vui lòng đặt lại mật khẩu.');
    }
}
