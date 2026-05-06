<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // LIST ALL PRODUCTS
    public function index()
    {
        $products = Product::with(['category', 'supplier', 'inventory'])->orderBy('created_at', 'desc')->paginate(10);
        return view('products.index', compact('products'));
    }

    // SHOW CREATE FORM
    public function create()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Access denied. Only admins can create products.');
        }

        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.create', compact('categories', 'suppliers'));
    }

    // SAVE NEW PRODUCT
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'sku'           => 'nullable|unique:products,sku|max:100',
            'category_id'   => 'required|exists:categories,id',
            'supplier_id'   => 'required|exists:suppliers,id',
            'price'         => 'required|numeric|min:0',
            'description'   => 'nullable|string',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'quantity'      => 'nullable|integer|min:0',
            'reorder_level' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // Extract inventory fields
        $quantity = $validated['quantity'] ?? 0;
        $reorderLevel = $validated['reorder_level'] ?? 10;

        // Remove inventory fields from product data
        unset($validated['quantity'], $validated['reorder_level']);

        $product = Product::create($validated);

        // Create inventory record for the product
        Inventory::create([
            'product_id' => $product->id,
            'quantity' => $quantity,
            'reorder_level' => $reorderLevel,
        ]);

        // Create initial stock transaction if quantity > 0
        if ($quantity > 0) {
            Transaction::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'type' => 'in',
                'quantity' => $quantity,
                'notes' => 'Initial stock',
                'transaction_date' => now(),
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    // SHOW SINGLE PRODUCT
    public function show(Product $product)
    {
        $product->load(['category', 'supplier', 'inventory', 'transactions']);
        return view('products.show', compact('product'));
    }

    // SHOW EDIT FORM
    public function edit(Product $product)
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('products.edit', compact('product', 'categories', 'suppliers'));
    }

    // UPDATE PRODUCT
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'sku'         => 'nullable|unique:products,sku,' . $product->id . '|max:100',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'price'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Handle image removal
        if ($request->has('remove_image') && $product->image) {
            Storage::disk('public')->delete($product->image);
            $validated['image'] = null;
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            if ($product->image) Storage::disk('public')->delete($product->image);
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated!');
    }

    // DELETE PRODUCT
    public function destroy(Product $product)
    {
        if ($product->image) Storage::disk('public')->delete($product->image);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted!');
    }
}
