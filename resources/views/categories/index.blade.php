@extends('layouts.app')

@section('title', 'Daftar Kategori - Toko Sembako Online')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">📁 Daftar Kategori</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
    </div>

    @if($categories->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Produk</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $index => $category)
                <tr>
                    <td>{{ $categories->firstItem() + $index }}</td>
                    <td><strong>{{ $category->nama }}</strong></td>
                    <td>{{ Str::limit($category->deskripsi, 50) ?: '-' }}</td>
                    <td>
                        <span class="badge badge-info">{{ $category->products_count }} produk</span>
                    </td>
                    <td>
                        @if($category->aktif)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Nonaktif</span>
                        @endif
                    </td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('categories.show', $category) }}" class="btn btn-secondary btn-sm">Detail</a>
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination">
            {{ $categories->links() }}
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">📁</div>
            <h3>Belum Ada Kategori</h3>
            <p>Silakan tambahkan kategori terlebih dahulu.</p>
            <a href="{{ route('categories.create') }}" class="btn btn-primary" style="margin-top: 1rem;">+ Tambah Kategori</a>
        </div>
    @endif
</div>
@endsection
