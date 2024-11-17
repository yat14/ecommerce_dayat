@extends('layouts.admin.main')
@section('title', 'Admin Edit ')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Admin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Admin</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.admin') }}">Admin</a>
                </div>
                <div class="breadcrumb-item">Edit Admin</div>
            </div>
        </div>

        <a href="{{ route('admin.admin') }}" class="btn btn-icon icon-left btn-warning">Kembali</a>

        <div class="card mt-4">
            <form action="{{ route('admin.update', $admins->id) }}" class="needs-validation" novalidate="" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Nama Admin</label>
                                <input id="name" type="text" class="form-control" name="name" required="" value="{{ $admins->name }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control" name="username" required="" value="{{ $admins->username }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="text" class="form-control" name="email" required="" value="{{ $admins->email }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi!
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input id="password" type="password" class="form-control" name="password" required="" value="{{ $admins->password }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus di isi!
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
