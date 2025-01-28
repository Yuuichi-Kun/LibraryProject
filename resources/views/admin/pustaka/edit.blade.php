@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Edit Pustaka</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Edit Pustaka</h5>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pustaka.update', $pustaka->id_pustaka) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">DDC</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="id_ddc" required>
                                    <option value="">Pilih DDC</option>
                                    @foreach($ddcs as $ddc)
                                        <option value="{{ $ddc->id_ddc }}" {{ $pustaka->id_ddc == $ddc->id_ddc ? 'selected' : '' }}>
                                            {{ $ddc->ddc }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Format</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="id_format" required>
                                    <option value="">Pilih Format</option>
                                    @foreach($formats as $format)
                                        <option value="{{ $format->id_format }}" {{ $pustaka->id_format == $format->id_format ? 'selected' : '' }}>
                                            {{ $format->format }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Penerbit</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="id_penerbit" required>
                                    <option value="">Pilih Penerbit</option>
                                    @foreach($penerbits as $penerbit)
                                        <option value="{{ $penerbit->id_penerbit }}" {{ $pustaka->id_penerbit == $penerbit->id_penerbit ? 'selected' : '' }}>
                                            {{ $penerbit->nama_penerbit }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Pengarang</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="id_pengarang" required>
                                    <option value="">Pilih Pengarang</option>
                                    @foreach($pengarangs as $pengarang)
                                        <option value="{{ $pengarang->id_pengarang }}" {{ $pustaka->id_pengarang == $pengarang->id_pengarang ? 'selected' : '' }}>
                                            {{ $pengarang->nama_pengarang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">ISBN</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="isbn" value="{{ $pustaka->isbn }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Judul Pustaka</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="judul_pustaka" value="{{ $pustaka->judul_pustaka }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Tahun Terbit</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tahun_terbit" value="{{ $pustaka->tahun_terbit }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Keyword</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="keyword" value="{{ $pustaka->keyword }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Keterangan Fisik</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="keterangan_fisik" value="{{ $pustaka->keterangan_fisik }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Keterangan Tambahan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="keterangan_tambahan" value="{{ $pustaka->keterangan_tambahan }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Abstraksi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="abstraksi" rows="4">{{ $pustaka->abstraksi }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Gambar</label>
                            <div class="col-sm-10">
                                @if($pustaka->gambar)
                                    <img src="{{ asset($pustaka->gambar) }}" alt="Gambar Pustaka" class="img-thumbnail mb-2" style="max-height: 200px">
                                @endif
                                <input type="file" class="form-control" name="gambar">
                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Harga Buku</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="harga_buku" value="{{ $pustaka->harga_buku }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kondisi Buku</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kondisi_buku" value="{{ $pustaka->kondisi_buku }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Full Paper</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="fp" required>
                                    <option value="0" {{ $pustaka->fp == '0' ? 'selected' : '' }}>Tidak</option>
                                    <option value="1" {{ $pustaka->fp == '1' ? 'selected' : '' }}>Ya</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Jumlah Pinjam</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="jml_pinjam" value="{{ $pustaka->jml_pinjam }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Denda Terlambat</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="denda_terlambat" value="{{ $pustaka->denda_terlambat }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Denda Hilang</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="denda_hilang" value="{{ $pustaka->denda_hilang }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('pustaka.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 