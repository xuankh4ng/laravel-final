<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link href='https://cdn.boxicons.com/3.0.6/fonts/basic/boxicons.min.css' rel='stylesheet'>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="flex min-h-screen bg-ef-bg-0">

    <aside class="w-70 fixed inset-y-0 left-0 bg-ef-bg-1 border-r border-ef-bg-4 flex flex-col">
        <div class="h-16 flex items-center px-6 border-b border-ef-bg-4 bg-ef-bg-2">
            <span class="text-lg font-bold tracking-tight text-ef-fg">Xin chào, {{ auth()->user()->full_name }}</span>
        </div>

        <nav class="flex-1 px-4 py-6 overflow-y-auto space-y-1">
            <p class="px-4 text-[10px] font-bold text-ef-grey-1 uppercase tracking-widest mb-2">Quản lý</p>

            <x-nav-link route="admin.products.index" activeRoute="admin.products.*">
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </x-slot>
                Sản phẩm
            </x-nav-link>

            <x-nav-link route="admin.categories.index" activeRoute="admin.categories.*">
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                </x-slot>
                Danh mục
            </x-nav-link>

            <x-nav-link route="admin.orders.index" activeRoute="admin.orders.*">
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </x-slot>
                Đơn hàng
            </x-nav-link>

            <x-nav-link route="admin.users.index" activeRoute="admin.users.*">
                <x-slot name="icon">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </x-slot>
                Người dùng
            </x-nav-link>
        </nav>

        <div class="p-4 border-t border-ef-bg-4">
            <div class="flex items-center justify-between p-2 rounded-lg bg-ef-bg-3">
                <div class="flex items-center overflow-hidden mr-2">
                    <div
                        class="shrink-0 w-8 h-8 rounded-full bg-ef-aqua flex items-center justify-center text-ef-bg-0 text-xs font-bold">
                        {{ substr(auth()->user()->full_name, 0, 2) }}
                    </div>
                    <div class="ml-3 overflow-hidden">
                        <p class="text-xs font-bold text-ef-fg truncate">{{ auth()->user()->full_name }}</p>
                        <p class="text-[10px] text-ef-grey-1 truncate">{{ auth()->user()->email }}</p>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="shrink-0">
                    @csrf
                    <button type="submit" title="Đăng xuất"
                        class="p-1.5 text-ef-grey-1 hover:text-ef-red hover:bg-ef-bg-4 rounded-md transition-colors cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <main class="ml-70 flex-1">
        {{ $slot }}
    </main>

</body>

</html>
