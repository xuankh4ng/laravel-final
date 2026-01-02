<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Categories::orderBy('name', 'asc')->get();
        $products = Products::query()
            ->when($request->search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->when($request->category, function($query, $category) {
                return $query->where('category_id', $category);
            })
            ->when($request->stock_status, function ($query, $status) {
                return $query->where('stock_status', $status);
            })
            ->latest()->paginate(12)->withQueryString();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'stock_status' => 'required|in:AVAILABLE,OUT_OF_STOCK',
            'stock_quantity' => 'required|numeric|min:0',
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        Products::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Đã thêm sản phẩm mới!');
    }

    public function edit(Products $product)
    {
        $categories = Categories::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Products $product)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'stock_status' => 'required|in:AVAILABLE,OUT_OF_STOCK',
        ]);

        $data = $request->all();

        if ($product->name !== $request->name) {
            $data['slug'] = Str::slug($request->name);
        }

        if ($request->hasFile('image')) {
            try {
                if ($product->image_url) {
                    $relativeRawPath = parse_url($product->image_url, PHP_URL_PATH);
                    $cleanPath = str_replace('/storage/', '', $relativeRawPath);

                    if (Storage::disk('public')->exists($cleanPath)) {
                        Storage::disk('public')->delete($cleanPath);
                    }
                }

                $path = $request->file('image')->store('products', 'public');
                $data['image_url'] = '/storage/' . $path;
            } catch (\Exception $e) {
                return back()->withErrors(['image' => 'Lỗi upload: ' . $e->getMessage()]);
            }
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Products $product)
    {
        // 1. Xóa file ảnh vật lý nếu tồn tại
        if ($product->image_url) {
            // Chuyển URL "/storage/products/abc.jpg" thành "products/abc.jpg" để xóa
            $filePath = str_replace('/storage/', '', $product->image_url);

            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
        }

        // 2. Xóa sản phẩm khỏi Database
        $product->delete();

        // 3. Quay lại trang danh sách với thông báo
        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm thành công!');
    }
}
