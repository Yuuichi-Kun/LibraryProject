@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Tambah Pustaka</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Form Tambah Pustaka</h5>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pustaka.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">DDC</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="id_ddc" required>
                                    <option value="">Pilih DDC</option>
                                    @foreach($ddcs as $ddc)
                                        <option value="{{ $ddc->id_ddc }}">{{ $ddc->ddc }}</option>
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
                                        <option value="{{ $format->id_format }}">{{ $format->format }}</option>
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
                                        <option value="{{ $penerbit->id_penerbit }}">{{ $penerbit->nama_penerbit }}</option>
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
                                        <option value="{{ $pengarang->id_pengarang }}">{{ $pengarang->nama_pengarang }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">ISBN</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="isbn" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Judul Pustaka</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="judul_pustaka" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Tahun Terbit</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tahun_terbit" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Keyword</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="keyword" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Keterangan Fisik</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="keterangan_fisik">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Keterangan Tambahan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="keterangan_tambahan">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Abstraksi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="abstraksi" rows="4"></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Gambar</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="gambar">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Harga Buku</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="harga_buku" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Kondisi Buku</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="kondisi_buku" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Full Paper</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="fp" required>
                                    <option value="0">Tidak</option>
                                    <option value="1">Ya</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Jumlah Pinjam</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="jml_pinjam" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Denda Terlambat</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="denda_terlambat" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Denda Hilang</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="denda_hilang" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan</button>
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