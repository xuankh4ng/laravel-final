<x-admin>
    <header class="h-16 border-b border-ef-bg-4 bg-ef-bg-0 flex items-center justify-between px-8 sticky top-0 z-20">
        <div>
            <h1 class="text-xl text-ef-fg font-bold tracking-tight">QUẢN LÝ SẢN PHẨM</h1>
        </div>

        <a href="{{ route('admin.products.create') }}"
            class="cursor-pointer inline-flex items-center px-4 py-2 bg-ef-green text-ef-bg-0 rounded-md font-bold hover:opacity-90 transition-all shadow-sm text-sm">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            THÊM SẢN PHẨM
        </a>
    </header>

    <div class="p-6 space-y-6">
        <div
            class="flex flex-col md:flex-row gap-4 items-center justify-between bg-ef-bg-1 p-4 rounded-xl border border-ef-bg-4">
            <div class="w-full md:w-1/2 relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-ef-grey-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </span>
                <input type="text" placeholder="Tìm kiếm theo tên hoặc mã sản phẩm..."
                    class="w-full pl-10 pr-4 py-2 bg-ef-bg-0 border border-ef-bg-4 rounded-lg focus:outline-none focus:border-ef-blue focus:ring-1 focus:ring-ef-blue text-sm transition-all">
            </div>

            <div class="w-full md:w-auto flex gap-3">
                <select
                    class="bg-ef-bg-0 border border-ef-bg-4 rounded-lg p-2 text-sm focus:outline-none focus:border-ef-blue cursor-pointer">
                    <option>Tất cả danh mục</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button class="p-2 bg-ef-bg-0 border border-ef-bg-4 rounded-lg text-ef-fg hover:bg-ef-bg-2">
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
                    class="group bg-ef-bg-1 border border-ef-bg-4 rounded-xl overflow-hidden hover:border-ef-green/50 hover:shadow-xl hover:shadow-ef-green/5 transition-all duration-300">
                    <div class="relative h-52 bg-ef-bg-2 overflow-hidden">
                        <img src="{{ $product->image_url }} " alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                        <div class="absolute top-3 left-3">
                            <span
                                class="px-2 py-1 text-[10px] font-bold bg-ef-bg-0/90 text-ef-fg rounded shadow-sm border border-ef-bg-4">
                                SKU: EF-{{ $product->id }}
                            </span>
                        </div>
                        <div class="absolute top-3 right-3">
                            @if ($product->stock_status === 'AVAILABLE')
                                <span
                                    class="px-2 py-1 text-[10px] font-bold uppercase bg-ef-bg-green text-ef-green border border-ef-green/20 rounded-full">
                                    ● Còn hàng
                                </span>
                            @else
                                <span
                                    class="px-2 py-1 text-[10px] font-bold uppercase bg-ef-bg-red text-ef-red border border-ef-green/20 rounded-full">
                                    ● Hết hàng
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="p-5">
                        <p class="text-[10px] font-bold text-ef-blue uppercase tracking-widest mb-1">
                            {{ $product->category->name }}
                        </p>
                        <h3
                            class="font-bold text-ef-fg text-base line-clamp-1 group-hover:text-ef-green transition-colors">
                            {{ $product->name }}
                        </h3>

                        <div class="mt-4 pt-4 border-t border-ef-bg-3 flex items-end justify-between">
                            <div>
                                <p class="text-[10px] text-ef-grey-1 uppercase">Giá bán</p>
                                <p class="text-lg font-black text-ef-orange tracking-tight">
                                    {{ number_format($product->price, 0, ',', '.') }}đ
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="px-5 pb-5 flex gap-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}"
                            class="flex-3 flex items-center justify-center py-2 text-xs font-bold bg-ef-green text-ef-bg-0 rounded-lg hover:opacity-80 transition-colors">
                            CHỈNH SỬA
                        </a>
                        <button type="button" onclick="confirmDelete({{ $product->id }})"
                            class="cursor-pointer p-2 text-ef-red hover:bg-ef-red hover:text-ef-bg-0 rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>

                        <form id="delete-form-{{ $product->id }}"
                            action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <p class="text-ef-grey-1 italic">Không có sản phẩm nào được tìm thấy.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</x-admin>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Xác nhận xóa?',
            text: "Dữ liệu sản phẩm và hình ảnh sẽ bị xóa vĩnh viễn!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#7fbbb3', // ef-blue
            cancelButtonColor: '#e67e80', // ef-red
            confirmButtonText: 'Đồng ý xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
