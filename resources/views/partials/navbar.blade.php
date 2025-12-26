@vite('resources/css/navbar.css')

<header class="fixed inset-x-0 top-0 z-50 bg-white border-b border-gray-100 shadow-sm font-sans">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
      
      <div class="flex-1 flex items-center">
          <a href="{{ route('home') }}" class="flex items-center gap-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain">
            <span class="font-bold text-xl text-amber-800 tracking-tight uppercase">coffee shop</span>
          </a>
      </div>

      <nav class="hidden md:flex items-center justify-center gap-8">
        <a href="{{ route('home') }}" class="text-gray-600 hover:text-amber-600 font-medium text-base uppercase tracking-wide transition-colors">Trang chủ</a>
        <a href="#" class="text-gray-600 hover:text-amber-600 font-medium text-base uppercase tracking-wide transition-colors">Sản phẩm</a>
        <a href="#" class="text-gray-600 hover:text-amber-600 font-medium text-base uppercase tracking-wide transition-colors">Cửa hàng</a>
        <a href="#" class="text-gray-600 hover:text-amber-600 font-medium text-base uppercase tracking-wide transition-colors">Liên hệ</a>
      </nav>

      <div class="flex-1 flex items-center justify-end gap-5">
        
        <a href="#" class="relative text-gray-600 hover:text-amber-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="9" cy="21" r="1"></circle>
                <circle cx="20" cy="21" r="1"></circle>
                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
            </svg>
            <span class="absolute -top-2 -right-2 bg-amber-600 text-white text-[10px] font-bold h-4 w-4 rounded-full flex items-center justify-center">0</span>
        </a>

        <div class="flex items-center gap-4">
            @auth
                <div class="relative h-full flex items-center cursor-pointer py-2 user-dropdown-group">
                    
                    <button class="flex items-center gap-1 text-gray-800 font-semibold text-sm focus:outline-none">
                        <span>Hi, {{ auth()->user()->full_name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div class="user-dropdown-menu absolute right-0 top-full w-48 bg-white shadow-xl rounded-lg border border-gray-100 z-50">
                        
                        <div class="absolute -top-2 right-4 w-4 h-4 bg-white border-t border-l border-gray-100 transform rotate-45"></div>

                        <div class="relative bg-white rounded-lg overflow-hidden">
                            <form action="{{ route('logout') }}" method="POST" class="block w-full m-0">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-3 text-sm text-gray-600 hover:bg-red-50 hover:text-red-600 transition-colors">
                                    Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
                    
                </div>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 font-medium text-sm hover:text-amber-600 transition">
                    Đăng nhập
                </a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-amber-800 hover:bg-amber-900 text-white text-sm font-bold rounded-full shadow-md transition">
                    Đăng ký
                </a>
            @endauth
        </div>

      </div>
    </div>
</header>