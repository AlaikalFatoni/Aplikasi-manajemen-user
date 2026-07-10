@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-danger text-white">
                    <h4 class="mb-0">Klaim Penukaran Poin</h4>
                </div>
                <div class="card-body">
                    <div class="alert alert-info text-center">
                        Member: **{{ $member->nama_pelanggan }}** | 
                        Poin Tersedia: **{{ $member->poin_member }} Poin**
                        <br>
                        <small class="text-muted">Contoh Reward: 100 Poin = Rp 10.000 Diskon</small>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('members.redeem_points', $member) }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="poin_to_redeem" class="form-label fw-bold">Jumlah Poin yang Ditukar:</label>
                            <input type="number" id="poin_to_redeem" name="poin_to_redeem" value="{{ old('poin_to_redeem') }}" required class="form-control form-control-lg @error('poin_to_redeem') is-invalid @enderror" min="100" max="{{ $member->poin_member }}">
                            <div class="form-text">Masukkan jumlah poin yang akan diklaim (minimal 100 poin).</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-danger btn-lg">Tukar & Kurangi Poin</button>
                            <a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection