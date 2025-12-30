<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Giỏ hàng - {{ env('APP_NAME') }}</title>
  
  {{-- Gọi các file tài nguyên (Bao gồm cả cart.css và cart.js) --}}
  @vite([
      'resources/css/app.css', 
      'resources/js/app.js',
      'resources/css/navbar.css',
      'resources/css/cart.css', // File CSS tùy chỉnh cho giỏ hàng
      'resources/js/cart.js'    // File JS xử lý Modal và số lượng
  ])
</head>

<body class="antialiased font-sans bg-gray-50 text-gray-800">

  {{-- 1. Include Navbar --}}
  @include('partials.navbar')

  {{-- 2. Nội dung chính --}}
  <main class="pt-24 pb-10 px-6 max-w-7xl mx-auto min-h-screen">
      
      <h1 class="text-2xl font-bold text-amber-800 uppercase tracking-wide mb-6 border-b border-gray-200 pb-2">
          Giỏ hàng của bạn
      </h1>

      @if(isset($cart) && count($cart) > 0)
        <div class="flex flex-col gap-6">
            
            {{-- BẢNG SẢN PHẨM --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-bold">
                        <tr>
                            <th class="py-4 px-6 w-2/5">Sản phẩm</th>
                            <th class="py-4 px-6 text-center">Đơn giá</th>
                            <th class="py-4 px-6 text-center">Số lượng</th>
                            <th class="py-4 px-6 text-center">Số tiền</th>
                            <th class="py-4 px-6 text-center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($cart as $id => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            {{-- Cột Sản phẩm --}}
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-4">
                                    <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded border border-gray-200">
                                        <img src="{{ asset($item['image'] ?? 'images/no-img.jpg') }}" class="h-full w-full object-cover">
                                    </div>
                                    <span class="font-semibold text-gray-800">{{ $item['name'] }}</span>
                                </div>
                            </td>

                            {{-- Cột Đơn giá --}}
                            <td class="py-4 px-6 text-center text-gray-600">
                                {{ number_format($item['price']) }}đ
                            </td>

                            {{-- Cột Số lượng --}}
                            <td class="py-4 px-6 text-center">
                                <div class="flex items-center justify-center border border-gray-200 rounded w-fit mx-auto">
                                    
                                    {{-- Nút GIẢM (-) --}}
                                    <form action="{{ route('cart.update', $id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="decrease">
                                        
                                        {{-- SỬA: type="button" và thêm onclick checkQuantity --}}
                                        <button type="button" 
                                                onclick="checkQuantity(this, {{ $item['quantity'] }})"
                                                class="px-3 py-1 bg-gray-50 text-gray-600 hover:bg-gray-200 transition-colors border-r border-gray-200">
                                            -
                                        </button>
                                    </form>

                                    {{-- Hiển thị số lượng --}}
                                    <span class="px-4 py-1 text-sm font-medium bg-white text-gray-800 min-w-[40px]">
                                        {{ $item['quantity'] }}
                                    </span>

                                    {{-- Nút TĂNG (+) --}}
                                    <form action="{{ route('cart.update', $id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="increase">
                                        <button type="submit" class="px-3 py-1 bg-gray-50 text-gray-600 hover:bg-gray-200 transition-colors border-l border-gray-200">
                                            +
                                        </button>
                                    </form>
                                    
                                </div>
                            </td>

                            {{-- Cột Số tiền --}}
                            <td class="py-4 px-6 text-center font-bold text-amber-800">
                                {{ number_format($item['price'] * $item['quantity']) }}đ
                            </td>

                            {{-- Cột Thao tác (Xóa) --}}
                            <td class="py-4 px-6 text-center">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors p-2" title="Xóa sản phẩm">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PHẦN TỔNG TIỀN & MUA HÀNG --}}
            <div class="flex flex-col items-end gap-4 mt-2">
                
                {{-- Tổng tiền --}}
                <div class="flex items-center gap-6 text-xl">
                    <span class="text-gray-500 font-medium">Tổng thanh toán:</span>
                    <span class="text-amber-800 font-bold text-2xl">{{ number_format($total) }}đ</span>
                </div>

                {{-- Nút Mua hàng --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('products') }}" class="px-6 py-3 text-gray-600 hover:text-amber-800 font-medium text-sm transition-colors">
                        Tiếp tục mua sắm
                    </a>
                    
                    <button class="bg-amber-800 hover:bg-amber-900 text-white px-10 py-3 rounded shadow-md font-bold text-base uppercase tracking-wide transition-all transform hover:-translate-y-0.5">
                        Mua hàng
                    </button>
                </div>

            </div>

        </div>
      @else
        {{-- EMPTY STATE --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 flex flex-col items-center justify-center text-center h-96">
            <div class="h-32 w-32 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">Giỏ hàng trống</h2>
            <p class="text-gray-500 mb-8">Bạn chưa thêm sản phẩm nào vào giỏ hàng.</p>
            <a href="{{ route('products') }}" class="px-8 py-3 bg-amber-800 hover:bg-amber-900 text-white font-bold rounded shadow transition uppercase">
                Mua sắm ngay
            </a>
        </div>
      @endif

  </main>

  {{-- 3. MODAL CẢNH BÁO XÓA (HTML) --}}
  <div id="confirm-delete-modal" class="fixed inset-0 z-50 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
          <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
              </div>
              <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Xác nhận xóa sản phẩm</h3>
                <div class="mt-2">
                  <p class="text-sm text-gray-500">Bạn đang giảm số lượng về 0. Hành động này sẽ xóa sản phẩm khỏi giỏ hàng. Bạn có chắc chắn không?</p>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <button type="button" id="confirm-btn" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">
                Đồng ý xóa
            </button>
            <button type="button" onclick="closeModal()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                Hủy bỏ
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>
  
</body>
</html>