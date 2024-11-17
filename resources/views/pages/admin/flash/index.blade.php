@extends('layouts.admin.main')
@section('title', 'Admin Flash Sale')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Flash Sale</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Flash Sale</div>
            </div>
        </div>
        <a href="{{ route('flash.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i> Flash Sale</a>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th>#</th>
                        <th>Nama Produk</th>
                        <th>Harga Produk Diskon</th>
                        <th>Harga Produk Asli</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Action</th>
                    </tr>
                    @php
                        $no = 0
                    @endphp
                    @forelse ($dataFlash as $item)
                    <tr>
                        <td>{{ $no += 1 }}</td>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->diskon_price }} Points</td>
                        <td>{{ $item->product->price }} Points</td>
                        <td>{{ $item->product->category }} Points</td>
                        <td>{{ $item->product->description }}</td>
                        <td>
                            <img src="{{ asset('images/' . $item->product->image) }}" alt="{{ $item->product->name }}" width="100" height="100">
                        </td>
                        <td>
                        <a href="{{ route('flash.edit', $item->id)}}" class="badge badge-warning"> Edit </a>
                        <a href="{{ route('flash.delete', $item->id)}}" class="badge badge-danger" data-confirm-delete="true">Hapus</a>
                        </td>
                    </tr>
                    @empty
                    <td colspan="5" class="text-center">Data Flash Sale Kosong</td>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>
@endsection