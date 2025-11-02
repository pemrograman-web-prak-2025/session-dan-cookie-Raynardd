@extends('layouts.app')

@section('content')
<div class="card p-5 text-center">
    <h3 class="fw-bold mb-2">Selamat Datang, {{ $user->name }}</h3>
    <p class="text-muted mb-4">Email: {{ $user->email }}</p>

    <div class="mb-3">
        <h5 class="fw-semibold">Total Barang yang Kamu Miliki:</h5>
        <h2 class="display-5 text-primary fw-bold">{{ $totalItems }}</h2>
    </div>

    <div class="d-flex justify-content-center gap-3 mt-3">
        <a href="{{ route('items.index') }}" class="btn btn-primary">
            <i class="bi bi-box-seam"></i> Kelola Inventaris
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">
                <i class="bi bi-door-open"></i> Logout
            </button>
        </form>
    </div>
</div>
@endsection

{{-- JS Auto Logout --}}
@push('scripts')
<script src="{{ asset('js/auto-logout.js') }}"></script>
@endpush