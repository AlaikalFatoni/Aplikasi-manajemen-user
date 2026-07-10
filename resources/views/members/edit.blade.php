@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Edit Data Member: <span class="fw-bold">{{ $member->nama_pelanggan }}</span></h4>
                </div>
                <div class="card-body">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('members.update', $member) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan:</label>
                            <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan', $member->nama_pelanggan) }}" required class="form-control @error('nama_pelanggan') is-invalid @enderror">
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" id="username" name="username" value="{{ old('username', $member->username) }}" required class="form-control @error('username') is-invalid @enderror">
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat:</label>
                            <textarea id="alamat" name="alamat" required class="form-control @error('alamat') is-invalid @enderror" rows="3">{{ old('alamat', $member->alamat) }}</textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email (Opsional):</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $member->email) }}" class="form-control @error('email') is-invalid @enderror">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="whatsapp" class="form-label">WhatsApp (Opsional):</label>
                                <input type="text" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $member->whatsapp) }}" class="form-control @error('whatsapp') is-invalid @enderror">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="poin_member" class="form-label">Poin Member:</label>
                            <input type="number" id="poin_member" name="poin_member" value="{{ old('poin_member', $member->poin_member) }}" min="0" class="form-control @error('poin_member') is-invalid @enderror">
                        </div>

                        <hr class="my-4">
                        <h5 class="mb-3 text-secondary">Ganti Password (Isi jika ingin mengubah)</h5>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password Baru:</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru:</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-warning text-dark">Update Data Member</button>
                            <a href="{{ route('members.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection