@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Manajemen Penerbit</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Penerbit</h5>
                    <a href="{{ route('penerbit.create') }}" class="btn btn-primary mb-3">Tambah Penerbit</a>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Kode Penerbit</th>
                                <th>Nama Penerbit</th>
                                <th>Alamat</th>
                                <th>No. Telp</th>
                                <th>Email</th>
                                <th>Kontak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($penerbits as $penerbit)
                            <tr>
                                <td>{{ $penerbit->kode_penerbit }}</td>
                                <td>{{ $penerbit->nama_penerbit }}</td>
                                <td>{{ $penerbit->alamat_penerbit }}</td>
                                <td>{{ $penerbit->no_telp }}</td>
                                <td>{{ $penerbit->email }}</td>
                                <td>{{ $penerbit->kontak }}</td>
                                <td>
                                    <a href="{{ route('penerbit.edit', $penerbit->id_penerbit) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('penerbit.destroy', $penerbit->id_penerbit) }}" method="POST" class="d-inline">
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