@extends('layouts.admin.main')
@section('title', 'Admin Detail Distributor')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Distributor</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.distributor') }}">Distributor</a></div>
                <div class="breadcrumb-item">Detail Distributor</div>
            </div>
        </div>
        
        <!-- Tombol Kembali -->
        <a href="{{ route('admin.distributor') }}" class="btn btn-icon icon-left btn-warning">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        
        <!-- Detail Distributor -->
            <div class="card mt-4">
                <form class="needs-validation" novalidate="" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nama_distributor">Nama Distributor</label>
                                    <input id="nama_distributor" type="text" class="form-control" name="nama_distributor" required="" value="{{ $distributors->nama_distributor }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input id="lokasi" type="text" class="form-control" name="lokasi" required="" value="{{ $distributors->lokasi }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="kontak">Kontak</label>
                                    <input id="kontak" type="text" class="form-control" name="kontak" required="" value="{{ $distributors->kontak }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="text" class="form-control" name="email" required="" value="{{ $distributors->email }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </section>
</div>
@endsection
