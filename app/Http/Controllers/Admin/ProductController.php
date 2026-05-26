<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'brand' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_2' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_3' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'manual_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products/images', 'public');
        }
        if ($request->hasFile('image_2')) {
            $validated['image_2'] = $request->file('image_2')->store('products/images', 'public');
        }
        if ($request->hasFile('image_3')) {
            $validated['image_3'] = $request->file('image_3')->store('products/images', 'public');
        }

        if ($request->hasFile('manual_pdf')) {
            $validated['manual_pdf'] = $request->file('manual_pdf')->store('products/manuals', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produto cadastrado com sucesso.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'brand' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_2' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'image_3' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'manual_pdf' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products/images', 'public');
        }
        if ($request->hasFile('image_2')) {
            $validated['image_2'] = $request->file('image_2')->store('products/images', 'public');
        }
        if ($request->hasFile('image_3')) {
            $validated['image_3'] = $request->file('image_3')->store('products/images', 'public');
        }

        if ($request->hasFile('manual_pdf')) {
            $validated['manual_pdf'] = $request->file('manual_pdf')->store('products/manuals', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Produto atualizado com sucesso.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produto removido com sucesso.');
    }
}
