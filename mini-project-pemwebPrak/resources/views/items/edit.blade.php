@extends('layouts.app')

@section('content')
<div class="card p-4">
    <h4 class="fw-bold mb-3">Edit Barang</h4>

    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Nama Barang</label>
                <input type="text" name="name" value="{{ $item->name }}" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label fw-semibold">Kategori</label>
                <input type="text" name="category" value="{{ $item->category }}" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Jumlah</label>
                <input type="number" name="quantity" value="{{ $item->quantity }}" class="form-control" min="1" required>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Kondisi</label>
                <select name="condition" class="form-select" required>
                    <option value="Baru" {{ $item->condition == 'Baru' ? 'selected' : '' }}>Baru</option>
                    <option value="Bekas" {{ $item->condition == 'Bekas' ? 'selected' : '' }}>Bekas</option>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label fw-semibold">Deskripsi</label>
                <input type="text" name="description" value="{{ $item->description }}" class="form-control">
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('items.index') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>
@endsection