<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class FlashController extends Controller
{
    public function index()
    {
        $flashes = Flash::all();
        
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?');
        
        return view('pages.admin.flash.index', compact('flashes'));
    }

    public function create()
    {
        return view('pages.admin.flash.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'diskon_price' => 'numeric',
            'original_price' => 'numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images/', $imageName);
        }

        $flash = Flash::create([
            'name' => $request->name,
            'diskon_price' => $request->diskon_price,
            'original_price' => $request->original_price,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        if ($flash) {
            Alert::success('Berhasil!', 'Flash Sale berhasil ditambahkan!');
            return redirect()->route('admin.flash');
        } else {
            Alert::error('Gagal!', 'Flash Sale gagal ditambahkan!');
            return redirect()->back();
        }
    }

    public function detail($id)
    {
        $flash = Flash::findOrFail($id);
        return view('pages.admin.flash.detail', compact('flash'));
    }

    public function edit($id)
    {
        $flash = Flash::findOrFail($id);
        return view('pages.admin.flash.edit', compact('flash'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'diskon_price' => 'numeric',
            'original_price' => 'numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpeg,jpg',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back();
        }

        $flash = Flash::findOrFail($id);

        if ($request->hasFile('image')) {
            $oldPath = public_path('images/' . $flash->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images/', $imageName);
        } else {
            $imageName = $flash->image;
        }

        $flash->update([
            'name' => $request->name,
            'diskon_price' => $request->diskon_price,
            'original_price' => $request->original_price,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        if ($flash) {
            Alert::success('Berhasil!', 'Flash Sale berhasil diperbarui');
            return redirect()->route('admin.product');
        } else {
            Alert::error('Gagal!', 'Flash Sale gagal diperbarui');
            return redirect()->back();        
        }
    }

    
    public function delete($id)
    {
        $flash = Flash::findOrFail($id);
        $oldPath = public_path('images/' . $flash->image);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }
        
        $flash->delete();

        if ($flash) {
            Alert::success('Berhasil!', 'Flash Sale berhasil dihapus');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Flash Sale gagal dihapus');
            return redirect()->back();
        }
    }

}