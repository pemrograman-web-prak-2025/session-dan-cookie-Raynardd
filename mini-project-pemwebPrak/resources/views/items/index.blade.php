@extends('layouts.app')

@section('content')
<div class="card p-4">
    {{-- Header & Search Bar --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        <h4 class="fw-bold mb-0">Daftar Barang</h4>

        <form action="{{ route('items.index') }}" method="GET" class="d-flex gap-2">
                <input 
                type="text" 
                name="search" 
                value="{{ $search }}" 
                class="form-control max-w-250" 
                placeholder="Cari nama / kategori..."
            >
            <button type="submit" class="btn btn-outline-primary">Cari</button>
            <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">Reset</a>
        </form>

        <a href="{{ route('items.create') }}" class="btn btn-primary">+ Tambah Barang</a>
    </div>

    {{-- Alert Hasil Pencarian --}}
    @if ($search)
        <div class="alert alert-info">
            Menampilkan hasil pencarian untuk: <strong>{{ $search }}</strong>
        </div>
    @endif

    {{-- Tabel Data --}}
    @if ($items->isEmpty())
        <div class="alert alert-warning text-center">
            Belum ada data barang nihhh
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $item->name }}</td>
                            <td>{{ $item->category }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>
                                <span class="badge 
                                    {{ $item->condition == 'Baru' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $item->condition }}
                                </span>
                            </td>
                            <td>{{ $item->description ?: '-' }}</td>
                            <td>
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Yakin mau hapus barang ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection