<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function login()
    {
        // gọi view hiện thị form đăng nhập
        return view('customer.login');
    }

    public function post_login(Request $request)
    {
        //$login_data = $request->only('email','password');

        $login_data = [
            'email' => $request->email,
            'password' => $request->password
        ];
        // dd($login_data);
        $check_login = Auth::guard('cus')->attempt($login_data);
        if (! $check_login) {
            return redirect()->back()->with('error', 'Đăng nhập không thành công vui lòng thử lại');
        }
        $intendedUrl = session()->pull('url.intended', route('home.index'));
        return redirect()->intended($intendedUrl);
    }

    public function register()
    {
        // gọi view hiện thị form đăng ký
        return view('customer.register');
    }

    public function post_register(Request $request)
    {

        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|unique:customers|max:100',
            'phone' => 'required|max:50',
            'address' => 'required|max:200',
            'password' => 'required|min:6|max:12',
            'password_confirmation' => 'required|same:password',
        ];
        $message = [
            // 'name.required' => 'Vui lòng nhập họ tên'
        ];
        try {
            $validatedData = $request->validate($rules, $message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log lỗi validate
            Log::error('Validation Error: ', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        }
        // dd($request->all()); // Debug dữ liệu sau khi validate
        // Lưu thông tin vào bảng customer
        // echo '123';
        // die;
        try {
            $add = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'gender' => $request->gender,
                'password' => bcrypt($request->password)
            ]);

            // Kiểm tra thêm mới thành công hay không
            return redirect()->route('customer.login')->with('success', 'Đăng ký thành công. Bạn có thể đăng nhập ngay.');
        } catch (\Exception $e) {
            // Ghi lỗi vào log
            Log::error('Đăng ký không thành công: ' . $e->getMessage(), [
                'request' => $request->all(),  // Bạn có thể ghi thông tin request nếu muốn
            ]);
            return redirect()->back()->with('error', 'Đăng ký không thành công, vui lòng thử lại.');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('cus')->logout();

        // Xóa thông tin của người dùng khỏi session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect đến trang đăng nhập hoặc trang khác
        return redirect()->route('customer.login')->with('success', 'Bạn đã đăng xuất thành công.');
    }
}
