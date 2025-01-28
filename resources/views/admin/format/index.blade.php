@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Manajemen Format</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Format</h5>
                    <a href="{{ route('format.create') }}" class="btn btn-primary mb-3">Tambah Format</a>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Kode Format</th>
                                <th>Format</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($formats as $format)
                            <tr>
                                <td>{{ $format->kode_format }}</td>
                                <td>{{ $format->format }}</td>
                                <td>{{ $format->keterangan }}</td>
                                <td>
                                    <a href="{{ route('format.edit', $format->id_format) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('format.destroy', $format->id_format) }}" method="POST" class="d-inline">
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