<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // TODO: Add admin middleware
    }

    public function dashboard()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.dashboard', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
            'is_active' => 'boolean'
        ]);

        Product::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Prodotto creato con successo!');
    }

    public function editProduct(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|url',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
            'is_active' => 'boolean'
        ]);

        $product->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Prodotto aggiornato con successo!');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Prodotto eliminato con successo!');
    }
}
