<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sản phẩm - {{ env('APP_NAME') }}</title>
  
  @vite([
      'resources/css/app.css', 
      'resources/js/app.js',
      'resources/css/navbar.css',
      'resources/css/product.css', 
      'resources/js/product.js'
  ])
</head>

<body class="antialiased font-sans bg-gray-50">

  @include('partials.navbar')

  <main class="pt-24 pb-10 px-6 max-w-7xl mx-auto min-h-screen">
      
      <div class="flex items-center justify-between mb-8">
          <h1 class="text-3xl font-bold text-amber-800 uppercase tracking-wide">
              Thực đơn
              @if(isset($products))
                  <span class="text-sm font-normal text-gray-500 ml-2">({{ $products->total() }} món)</span>
              @endif
          </h1>
      </div>

      @if(isset($products) && $products->count() > 0)
        <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            
            @foreach($products as $product)
                <div class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 group border border-gray-100 overflow-hidden flex flex-col">
                    
                    <div class="relative h-48 w-full bg-gray-100 overflow-hidden">
                        {{-- Hiển thị ảnh --}}
                        <img src="{{ $product->image_url }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                onerror="this.src='https://placehold.co/600x400?text=No+Image'">
                        
                        {{-- Badge Trạng thái (Giữ nguyên class ef-red/ef-green gốc của bạn) --}}
                        @if($product->stock_status == 'OUT_OF_STOCK')
                            <span class="absolute top-2 right-2 px-2 py-1 text-[9px] font-black uppercase bg-ef-red/10 text-ef-red border border-ef-red/20 rounded-md backdrop-blur-sm whitespace-nowrap shadow-sm">
                                ● Hết hàng
                            </span>
                        @else
                            <span class="absolute top-2 right-2 px-2 py-1 text-[9px] font-black uppercase bg-ef-green/10 text-ef-green border border-ef-green/20 rounded-md backdrop-blur-sm whitespace-nowrap shadow-sm">
                                ● Còn hàng
                            </span>
                        @endif
                    </div>

                    <div class="p-4 flex flex-col flex-1">
                        <h3 class="text-lg font-bold text-gray-800 mb-1 leading-tight group-hover:text-amber-700">
                            {{ $product->name }}
                        </h3>
                        
                        <p class="text-gray-500 text-sm line-clamp-2 mb-4 flex-1">
                            {{ $product->description }}
                        </p>

                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-lg font-extrabold text-amber-800">
                                {{ number_format($product->price, 0, ',', '.') }}đ
                            </span>

                            @if($product->stock_status == 'AVAILABLE')
                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-8 h-8 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center hover:bg-amber-800 hover:text-white transition-colors" title="Thêm vào giỏ hàng">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <button disabled class="px-3 py-1 bg-gray-100 text-gray-400 text-xs rounded cursor-not-allowed">
                                    Hết
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>

      @else
        <div class="p-10 text-center border-2 border-dashed border-gray-300 rounded text-gray-500">
            Chưa có sản phẩm nào trong Database.
        </div>
      @endif

  </main>

</body>
</html>