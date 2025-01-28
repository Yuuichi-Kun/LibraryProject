@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Manajemen Rak</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Rak</h5>
                    <a href="{{ route('rak.create') }}" class="btn btn-primary mb-3">Tambah Rak</a>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Kode Rak</th>
                                <th>Nama Rak</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($raks as $rak)
                            <tr>
                                <td>{{ $rak->kode_rak }}</td>
                                <td>{{ $rak->rak }}</td>
                                <td>{{ $rak->keterangan }}</td>
                                <td>
                                    <a href="{{ route('rak.edit', $rak->id_rak) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('rak.destroy', $rak->id_rak) }}" method="POST" class="d-inline">
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