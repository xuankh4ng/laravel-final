<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Giỏ hàng - {{ env('APP_NAME') }}</title>
  
  @vite([
      'resources/css/app.css', 
      'resources/js/app.js',
      'resources/css/navbar.css',
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

      @if(session('success'))
          <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg text-sm">
              {{ session('success') }}
          </div>
      @endif

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
                                <span class="inline-block px-3 py-1 bg-gray-100 rounded text-sm font-medium">
                                    {{ $item['quantity'] }}
                                </span>
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

            {{-- PHẦN TỔNG TIỀN & MUA HÀNG (Góc dưới phải) --}}
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
                    
                    {{-- Nút Checkout --}}
                    <button class="bg-amber-800 hover:bg-amber-900 text-white px-10 py-3 rounded shadow-md font-bold text-base uppercase tracking-wide transition-all transform hover:-translate-y-0.5">
                        Mua hàng
                    </button>
                </div>

            </div>

        </div>
      @else
        {{-- EMPTY STATE (Trang trống) --}}
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

</body>
</html>