@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Manajemen Pengarang</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Pengarang</h5>
                    <a href="{{ route('pengarang.create') }}" class="btn btn-primary mb-3">Tambah Pengarang</a>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Kode Pengarang</th>
                                <th>Nama Lengkap</th>
                                <th>No. Telp</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pengarangs as $pengarang)
                            <tr>
                                <td>{{ $pengarang->kode_pengarang }}</td>
                                <td>
                                    {{ $pengarang->gelar_depan ? $pengarang->gelar_depan . ' ' : '' }}
                                    {{ $pengarang->nama_pengarang }}
                                    {{ $pengarang->gelar_belakang ? ', ' . $pengarang->gelar_belakang : '' }}
                                </td>
                                <td>{{ $pengarang->no_telp }}</td>
                                <td>{{ $pengarang->email }}</td>
                                <td>{{ $pengarang->website }}</td>
                                <td>
                                    <a href="{{ route('pengarang.edit', $pengarang->id_pengarang) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('pengarang.destroy', $pengarang->id_pengarang) }}" method="POST" class="d-inline">
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