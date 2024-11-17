<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Flash;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index()
    {
        $flashes = Flash::with('product')->get(); // Load relasi product dalam flash sale
        $products = Product::all(); // Produk biasa
        
        return view('pages.user.index', compact('products', 'flashes'));
    }

    public function detail_product($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.user.detail', compact('product'));
    }

    public function detail_flash($id)
    {
        $flash = Flash::with('product')->findOrFail($id);
        return view('pages.user.detailFlash', compact('flash'));
    }

    public function purchase($productId, $userId)
    {
        $product = Product::findOrFail($productId);
        $user = User::findOrFail($userId);

        if ($user->point >= $product->price) {
            $user->update([
                'point' => $user->point - $product->price,
            ]);

            Alert::success('Berhasil!', 'Produk Berhasil dibeli!');
        } else {
            Alert::error('Gagal!', 'Point anda tidak cukup!');
        }

        return redirect()->back();
    }

    public function purchaseFlash($flashId, $userId)
    {
        $flash = Flash::with('product')->findOrFail($flashId);
        $user = User::findOrFail($userId);

        if ($user->point >= $flash->diskon_price) {
            $user->update([
                'point' => $user->point - $flash->diskon_price,
            ]);

            Alert::success('Berhasil!', 'Flash Sale Berhasil dibeli!');
        } else {
            Alert::error('Gagal!', 'Point anda tidak cukup!');
        }

        return redirect()->back();
    }
}
