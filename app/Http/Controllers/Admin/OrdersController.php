<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Danh sách đơn hàng
     */
    public function index()
    {
        $orders = Orders::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Xem chi tiết đơn hàng & Sản phẩm bên trong
     */
    public function show(Orders $order)
    {
        // Khớp với quan hệ item() và orderItems -> product trong model của bạn
        $order->load(['user', 'item.product']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Trang chỉnh sửa thông tin đơn hàng
     */
    public function edit(Orders $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Cập nhật trạng thái, địa chỉ, phí ship
     */
    public function update(Request $request, Orders $order)
    {
        $request->validate([
            'status' => 'required|in:PENDING,COMPLETED,CANCELED',
            'delivery_method' => 'required|in:PICKUP,DELIVERY',
            'shipping_address' => 'nullable|string|max:500',
            'shipping_fee' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:500',
        ]);

        $data = $request->all();

        // Ép phí ship về 0 nếu khách chọn tự đến lấy
        if ($request->delivery_method === 'PICKUP') {
            $data['shipping_fee'] = 0;
            $data['shipping_address'] = 'Nhận tại cửa hàng';
        }

        // Tính lại tổng tiền dựa trên sub_total (có sẵn) và phí ship mới
        $data['total_price'] = $order->sub_total + $data['shipping_fee'];

        $order->update($data);

        return redirect()->route('admin.orders.index')
                         ->with('success', 'Đã cập nhật đơn hàng #' . $order->id . ' thành công!');
    }

    /**
     * Xóa đơn hàng (Chỉ cho phép xóa khi đơn đã hủy)
     */
    public function destroy(Orders $order)
    {
        if ($order->status !== 'CANCELED') {
            return back()->with('error', 'Chỉ có thể xóa các đơn hàng đã bị hủy!');
        }

        $order->delete();
        return redirect()->route('admin.orders.index')
                         ->with('success', 'Đã xóa đơn hàng thành công!');
    }
}
