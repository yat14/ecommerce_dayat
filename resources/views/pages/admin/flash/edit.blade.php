@extends('layouts.admin.main')
@section('title', 'Admin Edit Flash Sale')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Flash Sale</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.flash') }}">Flash Sale</a>
                </div>
                <div class="breadcrumb-item">Edit Flash Sale</div>
            </div>
        </div>

        <a href="{{ route('admin.flash') }}" class="btn btn-icon icon-left btn-warning">Kembali</a>

        <div class="card mt-4">
            <form action="{{ route('flash.update', $flash->id) }}" class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Nama Flash Sale</label>
                                <input id="name" type="text" class="form-control" name="name" required="" value="{{ $flash->name }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="diskon_price">Harga Diskon (Point)</label>
                                <input id="diskon_price" type="number" class="form-control" name="diskon_price" required="" value="{{ $flash->diskon_price }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="original_price">Harga Asli (Point)</label>
                                <input id="original_price" type="number" class="form-control" name="original_price" required="" value="{{ $flash->original_price }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="category">Kategori Flash Sale</label>
                                <input id="category" type="text" class="form-control" name="category" required="" value="{{ $flash->category }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi!
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="description">Deskripsi Flash Sale</label>
                                <textarea class="form-control" name="description" id="description" cols="30" rows="4" required="">{{ $flash->description }}</textarea>
                                <div class="invalid-feedback">
                                    Deskripsi harus di isi!
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="custom-file">
                                    <input class="custom-file-input" name="image" id="customFile" type="file">
                                    <label class="custom-file-label" for="customFile">Pilih Gambar</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
