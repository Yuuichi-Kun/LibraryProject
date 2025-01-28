@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Manajemen Jenis Anggota</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Jenis Anggota</h5>
                    <a href="{{ route('jenis-anggota.create') }}" class="btn btn-primary mb-3">Tambah Jenis Anggota</a>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Jenis Anggota</th>
                                <th>Maksimal Pinjam</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jenisAnggota as $jenis)
                            <tr>
                                <td>{{ $jenis->kode_jenis_anggota }}</td>
                                <td>{{ $jenis->jenis_anggota }}</td>
                                <td>{{ $jenis->max_pinjam }}</td>
                                <td>{{ $jenis->keterangan }}</td>
                                <td>
                                    <a href="{{ route('jenis-anggota.edit', $jenis->id_jenis_anggota) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('jenis-anggota.destroy', $jenis->id_jenis_anggota) }}" method="POST" class="d-inline">
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
</section>
@endsection 