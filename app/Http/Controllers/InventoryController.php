<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::with('product')->paginate(10);
        return view('inventory.index', compact('inventory'));
    }

    public function create()
    {
        $products = Product::all();
        return view('inventory.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id|unique:inventory',
            'quantity' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:1',
            'location' => 'nullable|string|max:255',
        ]);

        Inventory::create($validated);

        return redirect()->route('inventory.index')->with('success', 'Inventory record created!');
    }

    public function show(Inventory $inventory)
    {
        return view('inventory.show', compact('inventory'));
    }

    public function edit(Inventory $inventory)
    {
        $products = Product::all();
        return view('inventory.edit', compact('inventory', 'products'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:1',
            'location' => 'nullable|string|max:255',
        ]);

        $inventory->update($validated);

        return redirect()->route('inventory.index')->with('success', 'Inventory updated!');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();

        return redirect()->route('inventory.index')->with('success', 'Inventory record deleted!');
    }
}
