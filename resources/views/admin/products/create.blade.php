<x-admin>
    <div class="p-8 max-w-4xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-ef-fg">Thêm sản phẩm mới</h1>
            <p class="text-ef-grey-1 text-sm">Điền thông tin chi tiết để niêm yết sản phẩm lên cửa hàng.</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-ef-red rounded-r-lg flex items-center shadow-sm">
                <svg class="w-5 h-5 text-ef-red shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <p class="ml-3 text-sm font-bold text-ef-red">Vui lòng kiểm tra lại dữ liệu nhập vào!</p>
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            @csrf

            <div class="lg:col-span-2 space-y-6">
                <div class="bg-ef-bg-1 p-6 rounded-xl border border-ef-bg-4 shadow-sm">
                    <div class="space-y-5">
                        <div>
                            <label class="text-sm font-bold text-ef-fg mb-1.5 flex items-center">
                                Tên sản phẩm <span class="text-ef-red ml-1">*</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-2 bg-ef-bg-0 border {{ $errors->has('name') ? 'border-ef-red ring-1 ring-ef-red/20' : 'border-ef-bg-4' }} rounded-lg focus:border-ef-blue outline-none transition-all text-ef-fg"
                                placeholder="Nhập tên sản phẩm...">
                            @error('name')
                                <p class="text-ef-red text-[11px] mt-1.5 font-medium">× {{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-ef-fg mb-1.5">Mô tả chi tiết</label>
                            <textarea name="description" rows="6"
                                class="w-full px-4 py-2 bg-ef-bg-0 border {{ $errors->has('description') ? 'border-ef-red' : 'border-ef-bg-4' }} rounded-lg focus:border-ef-blue outline-none transition-all text-ef-fg text-sm"
                                placeholder="Viết mô tả về tính năng, công dụng...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-ef-red text-[11px] mt-1.5 font-medium">× {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="bg-ef-bg-1 p-6 rounded-xl border border-ef-bg-4 shadow-sm">
                    <h3 class="font-bold text-ef-fg mb-4 text-xs uppercase tracking-widest flex items-center">
                        <span class="w-1.5 h-1.5 bg-ef-green rounded-full mr-2"></span>
                        Thông tin kinh doanh
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-bold text-ef-fg mb-1.5">Giá bán (VNĐ) <span
                                    class="text-ef-red">*</span></label>
                            <div class="relative">
                                <input type="number" name="price" value="{{ old('price', 0) }}" required
                                    class="w-full pl-4 pr-12 py-2 bg-ef-bg-0 border {{ $errors->has('price') ? 'border-ef-red' : 'border-ef-bg-4' }} rounded-lg outline-none focus:border-ef-blue font-bold text-ef-orange">
                                <span class="absolute right-4 top-2 text-[10px] text-ef-grey-1 font-bold">VNĐ</span>
                            </div>
                            @error('price')
                                <p class="text-ef-red text-[11px] mt-1.5 font-medium">× {{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-ef-fg mb-1.5">Trạng thái kho <span
                                    class="text-ef-red">*</span></label>
                            <select name="stock_status"
                                class="w-full px-4 py-2 bg-ef-bg-0 border border-ef-bg-4 rounded-lg outline-none cursor-pointer focus:border-ef-blue">
                                <option value="AVAILABLE" {{ old('stock_status') == 'AVAILABLE' ? 'selected' : '' }}>
                                    CÒN HÀNG</option>
                                <option value="OUT_OF_STOCK"
                                    {{ old('stock_status') == 'OUT_OF_STOCK' ? 'selected' : '' }}>HẾT HÀNG</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-ef-bg-1 p-6 rounded-xl border border-ef-bg-4 shadow-sm">
                    <label class="block text-sm font-bold text-ef-fg mb-3 uppercase tracking-wider text-[11px]">Phân
                        loại sản phẩm</label>
                    <select name="category_id" required
                        class="w-full px-4 py-2 bg-ef-bg-0 border {{ $errors->has('category_id') ? 'border-ef-red' : 'border-ef-bg-4' }} rounded-lg outline-none mb-2 text-sm focus:border-ef-blue">
                        <option value="">-- Chọn danh mục --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-ef-red text-[11px] font-medium">× {{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-ef-bg-1 p-6 rounded-xl border border-ef-bg-4 shadow-sm" id="image-container">
                    <label class="block text-sm font-bold text-ef-fg mb-3 uppercase tracking-wider text-[11px]">Hình ảnh
                        sản phẩm</label>

                    <div class="mb-4">
                        <div id="preview-wrapper"
                            class="relative w-full h-48 bg-ef-bg-2 rounded-lg border-2 border-dashed border-ef-bg-4 overflow-hidden flex items-center justify-center transition-all group hover:border-ef-blue/50">
                            <img id="image-preview" src="#" class="hidden w-full h-full object-cover">

                            <div id="placeholder-info" class="text-center p-4">
                                <svg class="w-10 h-10 mx-auto text-ef-bg-4 group-hover:text-ef-blue/40 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="mt-2 text-[10px] font-bold text-ef-grey-1 uppercase tracking-tight">Click để
                                    chọn ảnh</p>
                            </div>

                            <div id="image-overlay"
                                class="hidden absolute inset-0 bg-black/40 items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <p class="text-white text-[10px] font-bold">THAY ĐỔI ẢNH</p>
                            </div>

                            <input type="file" name="image" id="input-image"
                                class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">
                        </div>
                    </div>

                    @error('image')
                        <div class="p-2 bg-red-50 rounded border border-ef-red/10 mb-2">
                            <p class="text-ef-red text-[11px] font-medium leading-tight">{{ $message }}</p>
                        </div>
                    @enderror
                    <p class="text-[10px] text-ef-grey-1 text-center italic leading-tight">Định dạng hỗ trợ: JPG, PNG,
                        WEBP (Tối đa 2MB)</p>
                </div>

                <div class="flex flex-col gap-3 pt-2">
                    <button type="submit" id="btn-submit"
                        class="w-full py-3.5 bg-ef-green text-ef-bg-0 rounded-xl font-black text-xs tracking-widest hover:brightness-110 shadow-lg shadow-ef-green/20 transition-all flex items-center justify-center group">
                        <span class="group-hover:scale-110 transition-transform">XÁC NHẬN LƯU</span>
                    </button>
                    <a href="{{ route('admin.products.index') }}"
                        class="w-full py-3.5 bg-ef-bg-2 text-ef-grey-1 text-center rounded-xl font-bold text-xs tracking-widest hover:bg-ef-bg-3 border border-ef-bg-4 transition-all">
                        QUAY LẠI
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-admin>

<script>
    const inputImage = document.getElementById('input-image');
    const imagePreview = document.getElementById('image-preview');
    const placeholderInfo = document.getElementById('placeholder-info');
    const overlay = document.getElementById('image-overlay');
    const wrapper = document.getElementById('preview-wrapper');

    inputImage.addEventListener('change', function() {
        const file = this.files[0];

        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert('Cảnh báo: File ảnh này lớn hơn 2MB, có thể gây lỗi khi upload.');
            } else {
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    placeholderInfo.classList.add('hidden');
                    overlay.classList.remove('hidden');
                    overlay.classList.add('flex');
                    wrapper.classList.remove('border-dashed');
                    wrapper.classList.add('border-solid', 'border-ef-blue/30');
                }

                reader.readAsDataURL(file);
            }

        }
    });

    document.querySelector('form').addEventListener('submit', function() {
        const btn = document.getElementById('btn-submit');
        btn.innerHTML = 'ĐANG XỬ LÝ...';
        btn.classList.add('opacity-75', 'cursor-not-allowed');
    });
</script>
