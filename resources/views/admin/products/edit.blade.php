<x-admin>
    <div class="p-4 sm:p-8 max-w-5xl mx-auto">
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-black text-ef-fg tracking-tight uppercase">CHỈNH SỬA SẢN PHẨM</h1>
                <p class="text-ef-grey-1 text-[10px] font-bold mt-1 uppercase tracking-widest opacity-70 italic">
                    ID Sản phẩm: #{{ $product->id }}
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.products.index') }}"
                    class="px-6 py-3 bg-ef-bg-2 text-ef-red rounded-xl font-bold text-xs tracking-widest hover:bg-ef-bg-3 border border-ef-bg-4 transition-all uppercase">
                    HỦY BỎ
                </a>
                <button type="submit" form="product-form" id="btn-submit-top"
                    class="px-8 py-3 bg-ef-green text-white rounded-xl font-black text-xs tracking-widest hover:brightness-110 shadow-lg shadow-ef-blue/20 transition-all uppercase">
                    LƯU THAY ĐỔI
                </button>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-ef-red/10 border border-ef-red/20 rounded-xl flex items-start shadow-sm">
                <svg class="w-5 h-5 text-ef-red shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <div class="ml-3">
                    <p class="text-sm font-bold text-ef-red uppercase tracking-wide">Lỗi nhập liệu!</p>
                    <ul class="list-disc list-inside text-xs text-ef-red/80 mt-1 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form id="product-form" action="{{ route('admin.products.update', $product->id) }}" method="POST"
            enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-4">
            @csrf
            @method('PUT')

            <div class="lg:col-span-8 space-y-4">
                <div class="bg-ef-bg-1 p-4 rounded-2xl border border-ef-bg-4 shadow-sm">
                    <h2 class="text-sm font-black text-ef-fg mb-6 uppercase tracking-widest flex items-center gap-2">
                        <span class="p-1.5 bg-ef-blue/10 text-ef-blue rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </span>
                        Thông tin chi tiết
                    </h2>

                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-1">
                                <label class="block text-[10px] font-black text-ef-fg mb-2 uppercase tracking-wider">Tên
                                    sản phẩm <span class="text-ef-red">*</span></label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $product->name) }}" required
                                    class="w-full px-4 py-3 bg-ef-bg-0 border {{ $errors->has('name') ? 'border-ef-red' : 'border-ef-bg-4' }} rounded-xl focus:border-ef-blue focus:ring-4 focus:ring-ef-blue/5 outline-none transition-all text-ef-fg font-medium">
                            </div>

                            <div class="md:col-span-1">
                                <label
                                    class="block text-[10px] font-black text-ef-fg mb-2 uppercase tracking-wider opacity-50">Slug
                                    (Tự động)</label>
                                <input type="text" name="slug" id="slug"
                                    value="{{ old('slug', $product->slug) }}"
                                    class="w-full px-4 py-3 bg-ef-bg-2 border border-ef-bg-4 rounded-xl outline-none text-ef-grey-1 font-mono text-xs"
                                    readonly>
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black text-ef-fg mb-2 uppercase tracking-wider">Mô tả
                                sản phẩm</label>
                            <textarea name="description" rows="8"
                                class="w-full px-4 py-3 bg-ef-bg-0 border border-ef-bg-4 rounded-xl focus:border-ef-blue outline-none transition-all text-ef-fg text-sm leading-relaxed">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="bg-ef-bg-1 p-4 rounded-2xl border border-ef-bg-4 shadow-sm">
                    <h2 class="text-sm font-black text-ef-fg mb-6 uppercase tracking-widest flex items-center gap-2">
                        <span class="p-1.5 bg-ef-green/10 text-ef-green rounded-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                        Giá cả & Tồn kho
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-[10px] font-black text-ef-fg mb-2 uppercase tracking-wider">Giá bán
                                niêm yết</label>
                            <div class="relative group">
                                <input type="number" name="price" value="{{ old('price', $product->price) }}"
                                    required
                                    class="w-full pl-5 pr-16 py-4 bg-ef-bg-0 border border-ef-bg-4 rounded-xl outline-none focus:border-ef-orange focus:ring-4 focus:ring-ef-orange/5 font-black text-xl text-ef-orange transition-all">
                                <span
                                    class="absolute right-5 top-1/2 -translate-y-1/2 text-[10px] font-black text-ef-grey-1 tracking-widest">VNĐ</span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-ef-fg mb-2 uppercase tracking-wider">Tình
                                trạng hàng</label>
                            <div class="relative">
                                <select name="stock_status"
                                    class="w-full px-5 py-4 bg-ef-bg-0 border border-ef-bg-4 rounded-xl outline-none cursor-pointer focus:border-ef-blue font-bold appearance-none transition-all uppercase text-xs">
                                    <option value="AVAILABLE"
                                        {{ old('stock_status', $product->stock_status) == 'AVAILABLE' ? 'selected' : '' }}
                                        class="text-ef-green">CÒN HÀNG</option>
                                    <option value="OUT_OF_STOCK"
                                        {{ old('stock_status', $product->stock_status) == 'OUT_OF_STOCK' ? 'selected' : '' }}
                                        class="text-ef-red">HẾT HÀNG</option>/
                                </select>
                                <div
                                    class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-ef-grey-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-6">
                <div class="bg-ef-bg-1 p-4 rounded-2xl border border-ef-bg-4 shadow-sm">
                    <label class="block text-[10px] font-black text-ef-fg mb-4 uppercase tracking-widest">Danh
                        mục</label>
                    <select name="category_id" required
                        class="w-full px-4 py-3 bg-ef-bg-0 border border-ef-bg-4 rounded-xl outline-none focus:border-ef-blue font-bold text-xs transition-all appearance-none tracking-widest">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="bg-ef-bg-1 p-4 rounded-2xl border border-ef-bg-4 shadow-sm">
                    <label class="block text-[10px] font-black text-ef-fg mb-4 uppercase tracking-widest">Ảnh sản
                        phẩm</label>

                    <div id="drop-zone" class="relative group">
                        <div id="preview-wrapper"
                            class="relative w-full aspect-square bg-ef-bg-2 rounded-2xl border-2 {{ $product->image_url ? 'border-solid border-ef-blue/20' : 'border-dashed border-ef-bg-4' }} overflow-hidden flex flex-col items-center justify-center transition-all group-hover:border-ef-blue/50">

                            <img id="image-preview" src="{{ $product->image_url ?? '#' }}"
                                class="{{ $product->image_url ? '' : 'hidden' }} w-full h-full object-cover">

                            <div id="placeholder-info"
                                class="{{ $product->image_url ? 'hidden' : '' }} text-center p-6 transition-transform group-hover:scale-105">
                                <div
                                    class="w-16 h-16 bg-ef-bg-1 rounded-2xl flex items-center justify-center mx-auto mb-4 border border-ef-bg-4 shadow-sm text-ef-grey-1">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <p class="text-[10px] font-black text-ef-fg uppercase tracking-widest">Click thay đổi
                                    ảnh</p>
                            </div>

                            <div id="image-overlay"
                                class="absolute inset-0 bg-ef-fg/60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all backdrop-blur-[2px]">
                                <div
                                    class="bg-white text-ef-fg px-4 py-2 rounded-full text-[10px] font-black tracking-widest uppercase shadow-xl">
                                    Chọn ảnh mới</div>
                            </div>

                            <input type="file" name="image" id="input-image"
                                class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">
                        </div>
                    </div>
                    <p
                        class="text-center text-[9px] text-ef-grey-1 mt-4 font-bold uppercase tracking-widest opacity-60 italic">
                        Để trống nếu không muốn đổi ảnh</p>
                </div>

                <div class="lg:hidden">
                    <button type="submit" form="product-form"
                        class="w-full py-4 bg-ef-green text-white rounded-xl font-black text-xs tracking-widest shadow-lg shadow-ef-green/20 uppercase">
                        CẬP NHẬT NGAY
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin>

<script>
    // 1. Tự động tạo slug
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');
    nameInput.addEventListener('input', function() {
        let name = this.value;
        let slug = name.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '').replace(/[đĐ]/g, 'd')
            .replace(/([^0-9a-z-\s])/g, '').replace(/(\s+)/g, '-').replace(/-+/g, '-').replace(/^-+|-+$/g, '');
        slugInput.value = slug;
    });

    // 2. Preview ảnh
    const inputImage = document.getElementById('input-image');
    const imagePreview = document.getElementById('image-preview');
    const placeholderInfo = document.getElementById('placeholder-info');
    const wrapper = document.getElementById('preview-wrapper');

    inputImage.addEventListener('change', function() {
        const file = this.files[0];
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
                placeholderInfo.classList.add('hidden');
                wrapper.classList.remove('border-dashed');
                wrapper.classList.add('border-solid', 'border-ef-blue/20');
            };
            reader.readAsDataURL(file);
        }
    });

    // 3. Loading Button
    document.getElementById('product-form').addEventListener('submit', function() {
        const btn = document.getElementById('btn-submit-top');
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="animate-spin h-4 w-4 text-white mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="tracking-widest">ĐANG LƯU...</span>
        `;
        btn.classList.add('flex', 'items-center', 'justify-center');
    });
</script>
