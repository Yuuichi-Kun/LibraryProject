@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Manajemen Pustaka</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Pustaka</h5>
                    <a href="{{ route('pustaka.create') }}" class="btn btn-primary mb-3">Tambah Pustaka</a>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ISBN</th>
                                    <th>Judul</th>
                                    <th>DDC</th>
                                    <th>Format</th>
                                    <th>Penerbit</th>
                                    <th>Pengarang</th>
                                    <th>Tahun</th>
                                    <th>Kondisi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pustaka as $buku)
                                <tr>
                                    <td>{{ $buku->isbn }}</td>
                                    <td>{{ $buku->judul_pustaka }}</td>
                                    <td>{{ $buku->ddc->ddc }}</td>
                                    <td>{{ $buku->format->format }}</td>
                                    <td>{{ $buku->penerbit->nama_penerbit }}</td>
                                    <td>{{ $buku->pengarang->nama_pengarang }}</td>
                                    <td>{{ $buku->tahun_terbit }}</td>
                                    <td>{{ $buku->kondisi_buku }}</td>
                                    <td>
                                        <a href="{{ route('pustaka.edit', $buku->id_pustaka) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('pustaka.destroy', $buku->id_pustaka) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 