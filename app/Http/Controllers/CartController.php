<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        // Xử lý thêm sản phẩm vào giỏ hàng
        // Lấy thông tin từ request
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        // Giả sử bạn đang lưu trữ sản phẩm trong session, bạn có thể sử dụng như sau
        $cart = Session::get('cart', []);
        $cart[$productId] = $quantity;
        Session::put('cart', $cart);

        // Redirect về trang sản phẩm hoặc giỏ hàng với thông báo
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng.');
    }
}
