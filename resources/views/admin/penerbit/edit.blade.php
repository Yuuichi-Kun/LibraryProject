@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Edit Penerbit</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Edit Penerbit</h5>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('penerbit.update', $penerbit->id_penerbit) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kode Penerbit</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kode_penerbit" value="{{ $penerbit->kode_penerbit }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Nama Penerbit</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_penerbit" value="{{ $penerbit->nama_penerbit }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="alamat_penerbit" value="{{ $penerbit->alamat_penerbit }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">No. Telp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="no_telp" value="{{ $penerbit->no_telp }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" value="{{ $penerbit->email }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Fax</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="fax" value="{{ $penerbit->fax }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Website</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="website" value="{{ $penerbit->website }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kontak</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kontak" value="{{ $penerbit->kontak }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('penerbit.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 