<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    // Hiển thị form đặt lại mật khẩu
    public function showResetForm(Request $request)
    {
        $email = $request->email;
        $token = $request->token;

        if (!$email || !$token) {
            return redirect()->route('password.request')->withErrors(['error' => 'Liên kết không hợp lệ.']);
        }

        return view('auth.passwords.reset', compact('email', 'token'));
    }

    // Xử lý đặt lại mật khẩu
    public function reset(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email',
            'token'                 => 'required',
            'password'              => 'required|min:6|confirmed'
        ]);

        // Lấy bản ghi trong bảng password_resets
        $record = DB::table('password_resets')->where('email', $request->email)->first();
        if (!$record) {
            return back()->withErrors(['email' => 'Không tìm thấy yêu cầu đặt lại mật khẩu cho email này.']);
        }

        // Kiểm tra token: vì token được lưu dưới dạng hash nên dùng Hash::check
        if (!Hash::check($request->token, $record->token)) {
            return back()->withErrors(['token' => 'Mã xác minh không hợp lệ.']);
        }

        // Kiểm tra thời gian hiệu lực (ví dụ: 60 phút)
        if (Carbon::parse($record->created_at)->addMinutes(60)->isPast()) {
            return back()->withErrors(['token' => 'Mã xác minh đã hết hạn.']);
        }

        // Tìm user và cập nhật mật khẩu mới
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Xoá bản ghi password_resets
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Mật khẩu đã được đặt lại thành công.');
    }
}
