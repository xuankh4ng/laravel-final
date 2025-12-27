<x-admin>
    <div class="p-8 max-w-4xl mx-auto">
        <div class="mb-6 flex justify-between items-end">
            <div>
                <h1 class="text-2xl font-bold text-ef-fg">Chỉnh sửa sản phẩm</h1>
                <p class="text-ef-grey-1 text-sm">Đang chỉnh sửa: <span
                        class="text-ef-blue font-semibold">{{ $product->name }}</span></p>
            </div>
            <span
                class="text-[10px] font-mono bg-ef-bg-4 px-2 py-1 rounded text-ef-grey-1 shadow-sm border border-ef-bg-5">ID:
                #{{ $product->id }}</span>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-ef-red rounded-r-lg flex items-start">
                <div class="shrink-0 text-ef-red">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-bold text-ef-red">Có lỗi xảy ra!</h3>
                    <p class="text-xs text-red-700 mt-1">Vui lòng kiểm tra lại các thông tin bên dưới.</p>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @csrf
            @method('PUT')

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-ef-bg-1 p-6 rounded-xl border border-ef-bg-4 shadow-sm">
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-bold text-ef-fg mb-1.5">Tên sản phẩm <span
                                    class="text-ef-red">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" required
                                class="w-full px-4 py-2 bg-ef-bg-0 border {{ $errors->has('name') ? 'border-ef-red ring-1 ring-ef-red/20' : 'border-ef-bg-4 focus:border-ef-blue' }} rounded-lg outline-none transition-all text-ef-fg">
                            @error('name')
                                <p class="text-ef-red text-[11px] mt-1.5 font-medium">× {{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-ef-fg mb-1.5">Mô tả chi tiết</label>
                            <textarea name="description" rows="5"
                                class="w-full px-4 py-2 bg-ef-bg-0 border {{ $errors->has('description') ? 'border-ef-red' : 'border-ef-bg-4 focus:border-ef-blue' }} rounded-lg outline-none transition-all text-ef-fg text-sm leading-relaxed">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <p class="text-ef-red text-[11px] mt-1.5 font-medium">× {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-ef-bg-1 p-6 rounded-xl border border-ef-bg-4 shadow-sm">
                    <h3 class="font-bold text-ef-fg mb-4 text-xs uppercase tracking-widest flex items-center">
                        <span class="w-1.5 h-1.5 bg-ef-orange rounded-full mr-2"></span>
                        Giá bán & Kho hàng
                    </h3>
                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-ef-fg mb-1.5">Giá bán (VNĐ)</label>
                            <div class="relative">
                                <input type="number" name="price" value="{{ old('price', $product->price) }}"
                                    class="w-full pl-4 pr-12 py-2 bg-ef-bg-0 border {{ $errors->has('price') ? 'border-ef-red' : 'border-ef-bg-4 focus:border-ef-blue' }} rounded-lg outline-none text-ef-orange font-bold">
                                <span class="absolute right-4 top-2 text-[10px] text-ef-grey-1 font-bold">VNĐ</span>
                            </div>
                            @error('price')
                                <p class="text-ef-red text-[11px] mt-1.5 font-medium">× {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-ef-fg mb-1.5">Trạng thái kho</label>
                            <select name="stock_status"
                                class="w-full px-4 py-2 bg-ef-bg-0 border border-ef-bg-4 rounded-lg outline-none cursor-pointer focus:border-ef-blue">
                                <option value="AVAILABLE"
                                    {{ old('stock_status', $product->stock_status) == 'AVAILABLE' ? 'selected' : '' }}>
                                    CÒN HÀNG</option>
                                <option value="OUT_OF_STOCK"
                                    {{ old('stock_status', $product->stock_status) == 'OUT_OF_STOCK' ? 'selected' : '' }}>
                                    HẾT HÀNG</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-ef-bg-1 p-6 rounded-xl border border-ef-bg-4 shadow-sm">
                    <label class="block text-sm font-bold text-ef-fg mb-3 uppercase tracking-wider text-[11px]">Danh
                        mục</label>
                    <select name="category_id" required
                        class="w-full px-4 py-2 bg-ef-bg-0 border {{ $errors->has('category_id') ? 'border-ef-red' : 'border-ef-bg-4 focus:border-ef-blue' }} rounded-lg outline-none text-sm">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-ef-red text-[11px] mt-1.5 font-medium">× {{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-ef-bg-1 p-6 rounded-xl border border-ef-bg-4 shadow-sm transition-all" id="image-card">
                    <label class="block text-sm font-bold text-ef-fg mb-3 uppercase tracking-wider text-[11px]">Hình ảnh
                        sản phẩm</label>

                    <div class="mb-4 group relative">
                        <div
                            class="relative w-full h-48 bg-ef-bg-2 rounded-lg border-2 border-dashed border-ef-bg-4 overflow-hidden flex items-center justify-center transition-colors group-hover:border-ef-blue/50">
                            @if ($product->image_url)
                                <img id="preview-img" src="{{ $product->image_url }}"
                                    class="w-full h-full object-cover">
                            @else
                                <img id="preview-img" src="#" class="hidden w-full h-full object-cover">
                                <div id="placeholder-container" class="text-center">
                                    <svg class="w-10 h-10 mx-auto text-ef-bg-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <span id="placeholder-text"
                                        class="text-ef-grey-1 text-[10px] mt-2 block font-bold uppercase tracking-tight">Chưa
                                        có ảnh</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="relative">
                        <label
                            class="block w-full text-center py-2.5 px-4 bg-ef-bg-3 text-ef-fg text-[11px] font-black rounded-lg cursor-pointer hover:bg-ef-bg-4 hover:text-ef-blue transition-all border border-ef-bg-4 shadow-sm">
                            THAY ĐỔI ẢNH
                            <input type="file" name="image" id="image-input" class="hidden" accept="image/*">
                        </label>
                    </div>
                    @error('image')
                        <div class="mt-3 p-2 bg-red-50 rounded border border-ef-red/20">
                            <p class="text-ef-red text-[10px] font-bold uppercase leading-tight">Lỗi tải ảnh:</p>
                            <p class="text-ef-red text-[11px] mt-0.5">{{ $message }}</p>
                        </div>
                    @enderror
                </div>

                <div class="flex flex-col gap-3 pt-2">
                    <button type="submit"
                        class="w-full py-3.5 bg-ef-blue text-ef-bg-0 rounded-xl font-black text-xs tracking-widest hover:brightness-110 shadow-lg shadow-ef-blue/25 transition-all active:scale-[0.98]">
                        LƯU THAY ĐỔI
                    </button>
                    <a href="{{ route('admin.products.index') }}"
                        class="w-full py-3.5 bg-ef-bg-2 text-ef-grey-1 text-center rounded-xl font-bold text-xs tracking-widest hover:bg-ef-bg-3 transition-all border border-ef-bg-4">
                        HỦY BỎ
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-admin>

<script>
    document.getElementById('image-input').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview-img');
        const placeholder = document.getElementById('placeholder-container');
        const card = document.getElementById('image-card');

        // Reset trạng thái lỗi UI nếu có
        card.classList.remove('border-ef-red');

        if (file) {
            // Kiểm tra nhanh dung lượng file phía Client (2MB)
            if (file.size > 2 * 1024 * 1024) {
                alert(
                    "Cảnh báo: File ảnh này lớn hơn 2MB. Có thể sẽ không upload được tùy theo cấu hình server.");
            } else {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    });
</script>
