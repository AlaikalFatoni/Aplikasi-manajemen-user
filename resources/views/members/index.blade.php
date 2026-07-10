@extends('layouts.app') 
{{-- Pastikan layouts/app.blade.php memuat Bootstrap 5 --}}

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Daftar Member</h2>
        <a href="{{ route('members.create') }}" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-circle"></i> Tambah Member Baru
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-lg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nama Pelanggan</th>
                            <th scope="col">Username</th>
                            <th scope="col">WhatsApp</th>
                            <th scope="col" class="text-center">Poin Member</th>
                            <th scope="col" class="text-center">Kategori</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($members as $member)
                        <tr>
                            <td>{{ $member->nama_pelanggan }}</td>
                            <td>{{ $member->username }}</td>
                            <td>{{ $member->whatsapp ?? '-' }}</td>
                            <td class="text-center fw-bold text-primary">{{ $member->poin_member }}</td>
                            <td class="text-center">
                                @php
                                    $badgeClass = match ($member->kategori_member) {
                                        'Gold' => 'bg-warning text-dark',
                                        'Silver' => 'bg-secondary',
                                    default => 'bg-info', // Bronze
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $member->kategori_member }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex item-center justify-content-center space-x-2">
                                    {{-- Tombol Baru: Tambah Poin --}}
                                    <a href="{{ route('members.add_points', $member) }}" class="btn btn-sm btn-success me-2">
                                        + Poin
                                    </a>
                                    <a href="{{ route('members.claim_points', $member) }}" class="btn btn-sm btn-danger me-2">
                                        Klaim
                                    </a>

                                    <a href="{{ route('members.edit', $member) }}" class="btn btn-sm btn-info text-white me-2">
                                        Edit
                                    </a>
                                    
                                    <form action="{{ route('members.destroy', $member) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus member ini?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                Belum ada data member yang tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $members->links() }}
    </div>
</div>
@endsection