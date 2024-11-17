@extends('layouts.admin.main')
@section('title', 'Admin')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Admin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Admin</div>
            </div>
        </div>
        <a href="{{ route('admin.create') }}" class="btn btn-icon icon-left btn-primary"><i class="fas fa-plus"></i>Admin</a>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    @php
                        $no = 0
                    @endphp
                    @forelse ($admins as $item)
                    <tr>
                        <td>{{ $no += 1 }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                        <a href="{{ route('admin.edit', $item->id) }}" class="badge badge-warning"> Edit </a>
                        <a href="{{ route('admin.delete', $item->id) }}" class="badge badge-danger" data-confirm-delete="true">Hapus</a>
                        </td>
                    </tr>
                    @empty
                    <td colspan="5" class="text-center">Data Admin Kosong</td>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
</div>
@endsection