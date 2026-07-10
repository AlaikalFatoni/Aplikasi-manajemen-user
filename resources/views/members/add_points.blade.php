@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Tambah Poin (Transaksi)</h4>
                </div>
                <div class="card-body">
                    <p class="mb-4">
                        Tambahkan poin untuk **{{ $member->nama_pelanggan }}**. 
                        Saat ini memiliki **{{ $member->poin_member }}** poin.
                        <br>
                        <small class="text-muted">Aturan: Setiap Rp 10.000 Belanja = 1 Poin</small>
                    </p>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('members.store_points', $member) }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="nominal_belanja" class="form-label fw-bold">Nominal Belanja (Rp):</label>
                            <input type="number" id="nominal_belanja" name="nominal_belanja" value="{{ old('nominal_belanja') }}" required class="form-control form-control-lg @error('nominal_belanja') is-invalid @enderror" min="10000">
                            <div class="form-text">Masukkan total belanja pelanggan (minimal Rp 10.000).</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-success btn-lg">Hitung & Tambahkan Poin</button>
                            <a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection