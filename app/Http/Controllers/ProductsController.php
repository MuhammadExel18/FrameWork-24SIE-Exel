<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Menampilkan daftar produk.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Menampilkan form tambah produk.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Menyimpan produk baru ke database.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);


        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);


        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk <b>'.$request->name.'</b> berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit produk.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update produk yang sudah ada.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ]);


        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ]);


        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk <b>'.$request->name.'</b> berhasil diperbarui!');
    }

    /**
     * Hapus produk.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();


        return redirect()->route('admin.products.index')
                         ->with('success', 'Produk <b>'.$product->name.'</b> berhasil dihapus!');
    }
}
