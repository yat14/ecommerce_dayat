<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flash;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use DB;

class FlashController extends Controller
{
    public function index()
    {
        $dataFlash = Flash::with('product')->get(); // Menggunakan relasi Eloquent
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?');
        return view('pages.admin.flash.index', compact('dataFlash'));
    }

    public function create()
    {
        $product = Product::all();
        return view('pages.admin.flash.create', compact('product'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_product' => 'required|exists:products,id', // Memastikan produk valid
            'diskon_price' => 'required|numeric|min:0', // Diskon tidak boleh negatif
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::find($request->id_product);
        if ($request->diskon_price >= $product->price) {
            Alert::error('Gagal!', 'Diskon harus lebih kecil dari harga produk!');
            return redirect()->back()->withInput();
        }

        Flash::create([
            'id_product' => $request->id_product,
            'diskon_price' => $request->diskon_price,
        ]);

        Alert::success('Berhasil!', 'Flash Sale berhasil ditambahkan!');
        return redirect()->route('admin.flash');
    }

    public function edit($id)
    {
        $dataFlash = Flash::findOrFail($id);
        $product = Product::all();
        return view('pages.admin.flash.edit', compact('dataFlash', 'product'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_product' => 'required|exists:products,id',
            'diskon_price' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $product = Product::find($request->id_product);
        if ($request->diskon_price >= $product->price) {
            Alert::error('Gagal!', 'Diskon harus lebih kecil dari harga produk!');
            return redirect()->back()->withInput();
        }

        $dataFlash = Flash::findOrFail($id);

        $dataFlash->update([
            'id_product' => $request->id_product,
            'diskon_price' => $request->diskon_price,
        ]);

        Alert::success('Berhasil!', 'Flash Sale berhasil diperbarui!');
        return redirect()->route('admin.flash');
    }

    public function delete($id)
    {
        $dataFlash = Flash::findOrFail($id);
        $dataFlash->delete();

        Alert::success('Berhasil!', 'Flash Sale berhasil dihapus');
        return redirect()->route('admin.flash');
    }

}