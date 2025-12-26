<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index () {
        $categories = Categories::orderBy('name', 'asc')->get();
        $products = Products::latest()->paginate(8);

        return view('admin.products', compact('products', 'categories'));
    }
}
