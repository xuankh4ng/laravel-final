<x-admin>
    <header
        class="h-16 border-b border-ef-bg-4 bg-ef-bg-0 flex items-center justify-between px-8 sticky top-0 z-20 shadow-sm">
        <div class="flex items-center gap-4">
            <h1 class="text-xl text-ef-fg font-black tracking-tight uppercase">QUẢN LÝ SẢN PHẨM</h1>
            <span class="bg-ef-bg-4 text-ef-grey-1 text-[10px] px-2 py-0.5 rounded-full font-bold">
                TỔNG: {{ $products->total() }}
            </span>
        </div>

        <a href="{{ route('admin.products.create') }}"
            class="inline-flex items-center px-4 py-2 bg-ef-green text-ef-bg-0 rounded-lg font-black text-xs tracking-widest hover:brightness-110 transition-all shadow-lg shadow-ef-green/20">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            THÊM SẢN PHẨM
        </a>
    </header>

    <div class="p-8 max-w-7xl mx-auto space-y-8">
        <div
            class="flex flex-col md:flex-row gap-4 items-center justify-between bg-ef-bg-1 p-5 rounded-2xl border border-ef-bg-4 shadow-sm">
            <div class="w-full md:w-1/2 relative group">
                <span
                    class="absolute inset-y-0 left-0 pl-4 flex items-center text-ef-grey-1 group-focus-within:text-ef-blue transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
                <input type="text" placeholder="Tìm kiếm sản phẩm..."
                    class="w-full pl-12 pr-4 py-3 bg-ef-bg-0 border border-ef-bg-4 rounded-xl focus:outline-none focus:border-ef-blue focus:ring-1 focus:ring-ef-blue text-sm text-ef-fg transition-all">
            </div>

            <div class="w-full md:w-auto flex gap-3">
                <select
                    class="bg-ef-bg-0 border border-ef-bg-4 rounded-xl px-4 py-3 text-sm text-ef-fg focus:outline-none focus:border-ef-blue cursor-pointer transition-all">
                    <option>Tất cả danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button
                    class="px-4 py-3 bg-ef-bg-0 border border-ef-bg-4 rounded-xl text-ef-grey-1 hover:text-ef-fg hover:bg-ef-bg-2 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div
                    class="group bg-ef-bg-1 border border-ef-bg-4 rounded-2xl overflow-hidden hover:border-ef-green/30 transition-all duration-300 flex flex-col shadow-sm hover:shadow-xl hover:shadow-ef-green/5">
                    <div class="relative h-56 bg-ef-bg-2 overflow-hidden">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        <div class="absolute top-3 left-3">
                            <span
                                class="px-2 py-1 text-[9px] font-black bg-ef-bg-0/80 text-ef-fg rounded-md backdrop-blur-sm border border-ef-bg-4 uppercase tracking-tighter whitespace-nowrap shadow-sm">
                                ID: #{{ $product->id }}
                            </span>
                        </div>

                        <div class="absolute top-3 right-3">
                            @if ($product->stock_status === 'AVAILABLE')
                                <span
                                    class="px-2 py-1 text-[9px] font-black uppercase bg-ef-green/10 text-ef-green border border-ef-green/20 rounded-md backdrop-blur-sm whitespace-nowrap shadow-sm">
                                    ● Còn hàng
                                </span>
                            @else
                                <span
                                    class="px-2 py-1 text-[9px] font-black uppercase bg-ef-red/10 text-ef-red border border-ef-red/20 rounded-md backdrop-blur-sm whitespace-nowrap shadow-sm">
                                    ● Hết hàng
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-5 flex-1 flex flex-col">
                        <p class="text-[10px] font-black text-ef-blue uppercase tracking-[0.2em] mb-1 opacity-80">
                            {{ $product->category->name }}
                        </p>
                        <h3 class="font-bold text-ef-fg text-base line-clamp-2 min-h-[3rem]">
                            {{ $product->name }}
                        </h3>

                        <div class="mt-4 pt-4 border-t border-ef-bg-4 flex items-center justify-between">
                            <div>
                                <p class="text-[9px] text-ef-grey-1 uppercase font-bold tracking-widest">Giá bán</p>
                                <p class="text-lg font-black text-ef-orange italic">
                                    {{ number_format($product->price, 0, ',', '.') }}đ
                                </p>
                            </div>

                            <div class="flex gap-1">
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                    class="p-2 text-ef-grey-1 hover:text-ef-blue hover:bg-ef-bg-2 rounded-lg transition-all"
                                    title="Chỉnh sửa">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <button type="button" onclick="confirmDelete({{ $product->id }})"
                                    class="cursor-pointer p-2 text-ef-grey-1 hover:text-ef-red hover:bg-ef-bg-2 rounded-lg transition-all"
                                    title="Xóa">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                                <form id="delete-form-{{ $product->id }}"
                                    action="{{ route('admin.products.destroy', $product->id) }}" method="POST"
                                    class="hidden">
                                    @csrf @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-24 text-center bg-ef-bg-1 rounded-3xl border border-ef-bg-4 border-dashed">
                    <div class="text-ef-bg-4 mb-4 flex justify-center">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <p class="text-ef-grey-1 font-bold italic uppercase tracking-widest text-xs">Kho hàng đang trống...
                    </p>
                </div>
            @endforelse
        </div>

        <div class="mt-12 py-6 border-t border-ef-bg-4">
            {{ $products->links() }}
        </div>
    </div>
</x-admin>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Xác nhận xóa?',
            text: "Sản phẩm sẽ bị xóa vĩnh viễn khỏi hệ thống!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444', // Màu đỏ của ef-red
            cancelButtonColor: '#64748b', // Màu xám
            confirmButtonText: 'ĐỒNG Ý XÓA',
            cancelButtonText: 'HỦY',
            borderRadius: '15px',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
