@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Edit Jenis Anggota</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Edit Jenis Anggota</h5>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('jenis-anggota.update', $jenisAnggota->id_jenis_anggota) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kode Jenis Anggota</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kode_jenis_anggota" value="{{ $jenisAnggota->kode_jenis_anggota }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Jenis Anggota</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="jenis_anggota" value="{{ $jenisAnggota->jenis_anggota }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Maksimal Pinjam</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="max_pinjam" value="{{ $jenisAnggota->max_pinjam }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="keterangan">{{ $jenisAnggota->keterangan }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('jenis-anggota.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 