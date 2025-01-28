@extends('layouts.admin')

@section('content')
<div class="pagetitle">
    <h1>Manajemen Anggota</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
            <li class="breadcrumb-item active">Manajemen Anggota</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Anggota</h5>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Jenis Anggota</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($anggota as $index => $a)
                                    <tr>
                                        <td>{{ $anggota->firstItem() + $index }}</td>
                                        <td>{{ $a->kode_anggota }}</td>
                                        <td>{{ $a->nama_anggota }}</td>
                                        <td>{{ $a->jenisAnggota->jenis_anggota }}</td>
                                        <td>{{ $a->email }}</td>
                                        <td>
                                            @if($a->fa == 'Y')
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-warning">Belum Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($a->fa != 'Y')
                                                <form action="{{ route('admin.anggota.activate', $a->id_anggota) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-success"
                                                            onclick="return confirm('Aktivasi anggota ini?')">
                                                        <i class="bi bi-check-circle"></i> Aktivasi
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data anggota</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $anggota->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 