@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Profil Perpustakaan</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Profil Perpustakaan</h5>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('perpustakaan.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Perpustakaan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_perpustakaan" value="{{ $perpustakaan->nama_perpustakaan ?? old('nama_perpustakaan') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Pustakawan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_pustakawan" value="{{ $perpustakaan->nama_pustakawan ?? old('nama_pustakawan') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="alamat" value="{{ $perpustakaan->alamat ?? old('alamat') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" value="{{ $perpustakaan->email ?? old('email') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Website</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="website" value="{{ $perpustakaan->website ?? old('website') }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">No. Telepon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="no_telp" value="{{ $perpustakaan->no_telp ?? old('no_telp') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="keterangan">{{ $perpustakaan->keterangan ?? old('keterangan') }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 