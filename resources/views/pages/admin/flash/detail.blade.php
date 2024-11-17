@extends('layouts.admin.main')
@section('title', 'Admin Detail Flash Sale')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Flash Sale</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.flash') }}">Flash Sale</a></div>
                <div class="breadcrumb-item">Detail Flash Sale</div>
            </div>
        </div>
        <a href="{{ route('admin.flash') }}" class="btn btn-icon icon-left btn-warning"><i class="fas faarrow-left"></i> Kembali</a>
        <div class="row mt-4">
            <div class="col-12 col-md-4 col-lg-12 m-auto">
                <article class="article article-style-c">
                    <div class="article-header">
                        <div class="article-image" data-background="{{ asset('images/' . $data->image) }}">
                        </div>
                    </div>
                    <div class="article-details">
                        <div class="article-category"><a href="#">{{ $data->name }}</a></div>
                        <div class="bullet">
                        </div> <a href="#">{{ $dataFlash->category }}</a></div>
                        <div class="article-title">
                            <h2><a href="#">Harga Diskon: {{ $data->diskon_price }} Points</a></h2>
                        </div>
                        <div class="article-title">
                            <h2><a href="#">Harga Asli: {{ $data->price }} Points</a></h2>
                        </div>
                        <hr>
                        <div class="article-category"><a href="#">{{ $data->category }}</a></div>
                        <p>
                            {{ $data->description }}
                        </p>
                    </div>
                </article>
            </div>
        </div>
    </section>
</div>
@endsection