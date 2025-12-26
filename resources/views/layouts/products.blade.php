<!doctype html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sản phẩm - Coffee Shop</title>
  
  {{-- Gọi file CSS/JS: Bao gồm app chung + navbar + file riêng của trang này --}}
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
          <h1 class="text-3xl font-bold text-amber-800 uppercase tracking-wide">Thực đơn</h1>
          </div>

      <div id="product-list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <div class="p-10 text-center border-2 border-dashed border-gray-300 rounded text-gray-500 col-span-full">
              Chưa có sản phẩm nào được hiển thị.
          </div>
      </div>

  </main>
  
</body>
</html>