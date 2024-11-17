<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Distributor;
use App\Models\Flash;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;


class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::count();
        $users = User::count();
        $distributors = Distributor::count();
        $flashes = Flash::count();

        return view('pages.admin.index', compact('products','flashes', 'users', 'distributors'));
    }

    public function index()
    {
        $admins = Admin::all();
        
        confirmDelete('Hapus Data!', 'Apakah anda yakin ingin menghapus data ini?');

        return view('pages.admin.admin.index', compact('admins'));

    }
    
    public function create()
    {
        return view('pages.admin.admin.create');
    }

    public function kirim(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back();
        }

        $admins = Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),  
        ]);

        if ($admins) {
            Alert::success('Berhasil!', 'Admin berhasil ditambahkan!');
            return redirect()->route('admin.admin');
        } else {
            Alert::error('Gagal!', 'Admin gagal ditambahkan!');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $admins = Admin::findOrFail($id);
        return view('pages.admin.admin.edit', compact('admins'));
    }

    public function update(Request $request, $id)
    {
        $admins = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $admins->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $admins->password,
        ]);

        if ($admins) {
            Alert::success('Berhasil!', 'Admin berhasil dirubah!');
            return redirect()->route('admin.admin');
        } else {
            Alert::error('Gagal!', 'Admin gagal dirubah!');
            return redirect()->back();
        }
    }

    public function delete($id)
    {
        $admins = Admin::findOrFail($id);
        
        $admins->delete();

        if ($admins) {
            Alert::success('Berhasil!', 'Admin berhasil dihapus');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Admin gagal dihapus');
            return redirect()->back();
        }
    }
}
