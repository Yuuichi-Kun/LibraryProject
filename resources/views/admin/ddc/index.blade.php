@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Manajemen DDC</h1>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar DDC</h5>
                    <a href="{{ route('ddc.create') }}" class="btn btn-primary mb-3">Tambah DDC</a>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>Kode DDC</th>
                                <th>DDC</th>
                                <th>Rak</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ddcs as $ddc)
                            <tr>
                                <td>{{ $ddc->kode_ddc }}</td>
                                <td>{{ $ddc->ddc }}</td>
                                <td>{{ $ddc->rak->rak }}</td>
                                <td>{{ $ddc->keterangan }}</td>
                                <td>
                                    <a href="{{ route('ddc.edit', $ddc->id_ddc) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('ddc.destroy', $ddc->id_ddc) }}" method="POST" class="d-inline">
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