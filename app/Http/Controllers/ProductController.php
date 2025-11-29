<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // 1. Display List
    public function index(): View
    {
        // Get products with category (Eager Loading)
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    // 2. Show Create Form
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    // 3. Store Logic (With Image Upload)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        $data = $request->all();

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Save to 'storage/app/public/products'
            $path = $request->file('image')->store('products', 'public');
            $data['image_path'] = $path;
        }

        Product::create($data);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Created Product',
            'details' => 'Added product: ' . $request->name
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    // 4. Show Edit Form
    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // 5. Update Logic
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Handle Image Update
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }
            // Upload new
            $path = $request->file('image')->store('products', 'public');
            $data['image_path'] = $path;
        }

        $product->update($data);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Updated Product',
            'details' => 'Updated product: ' . $request->name
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    // 6. Delete Product
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // FIX: I-save muna ang pangalan bago i-delete para magamit sa logs
        $name = $product->name; 

        // Delete image file
        if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        // Log Activity (Gamitin ang $name variable na sinave natin)
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Deleted Product',
            'details' => 'Deleted product: ' . $name
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}