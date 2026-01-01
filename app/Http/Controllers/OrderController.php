<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Orders;
use App\Models\OrderItems;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('auth', ['tab' => 'login']);
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $subTotal = 0;
        foreach ($cart as $item) {
            $subTotal += $item['price'] * $item['quantity'];
        }

        DB::beginTransaction();
        try {
            $order = Orders::create([
                'user_id' => Auth::id(),
                'status' => 'PENDING',
                'delivery_method' => 'PICKUP',
                'shipping_address' => null,
                'note' => null,
                'sub_total' => $subTotal,
                'shipping_fee' => 0,
                'total_price' => $subTotal,
            ]);

            foreach ($cart as $productId => $item) {
                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $item['name'],
                    'unit_price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'line_total' => $item['price'] * $item['quantity'],
                ]);
            }

            DB::commit();

            // Xóa giỏ hàng
            session()->forget('cart');

            return redirect()->route('history.index')->with('success', 'Đặt hàng thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Có lỗi khi tạo đơn hàng: ' . $e->getMessage());
        }
    }
}
