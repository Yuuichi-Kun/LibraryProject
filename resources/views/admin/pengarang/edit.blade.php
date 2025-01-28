@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Edit Pengarang</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Edit Pengarang</h5>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pengarang.update', $pengarang->id_pengarang) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kode Pengarang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kode_pengarang" value="{{ $pengarang->kode_pengarang }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Gelar Depan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="gelar_depan" value="{{ $pengarang->gelar_depan }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Pengarang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_pengarang" value="{{ $pengarang->nama_pengarang }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Gelar Belakang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="gelar_belakang" value="{{ $pengarang->gelar_belakang }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">No. Telp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="no_telp" value="{{ $pengarang->no_telp }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" value="{{ $pengarang->email }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Website</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="website" value="{{ $pengarang->website }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Biografi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="biografi" rows="4">{{ $pengarang->biografi }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="keterangan">{{ $pengarang->keterangan }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('pengarang.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 