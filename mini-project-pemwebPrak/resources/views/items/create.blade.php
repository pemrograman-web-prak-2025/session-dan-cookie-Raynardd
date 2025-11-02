@extends('layouts.app')

@section('content')
<div class="card p-4">
    <h4 class="fw-bold mb-3">Tambah Barang Baru</h4>

    <form action="{{ route('items.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Nama Barang</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Kategori</label>
                <input type="text" name="category" class="form-control" value="{{ old('category') }}" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Jumlah</label>
                <input type="number" name="quantity" class="form-control" min="1" value="{{ old('quantity') }}" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Kondisi</label>
                <select name="condition" class="form-select" required>
                    <option value="Baru" {{ old('condition') == 'Baru' ? 'selected' : '' }}>Baru</option>
                    <option value="Bekas" {{ old('condition') == 'Bekas' ? 'selected' : '' }}>Bekas</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Deskripsi</label>
                <input type="text" name="description" class="form-control" value="{{ old('description') }}">
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('items.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">Simpan</button>
        </div>
    </form>
</div>
@endsection